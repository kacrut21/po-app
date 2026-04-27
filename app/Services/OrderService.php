<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function generateOrderNumber()
    {
        // Format: PO-[USER_ID]-[YYYYMMDD]-[URUTAN]
        // Contoh: PO-001-20260424-001
        $userIdStr = sprintf('%03d', Auth::id());
        $prefix = 'PO-' . $userIdStr . '-' . date('Ymd') . '-';
        
        $lastOrder = Order::where('user_id', Auth::id())
            ->where('order_number', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        if (!$lastOrder) {
            return $prefix . '001';
        }

        $lastNumber = (int) substr($lastOrder->order_number, -3);
        return $prefix . sprintf('%03d', $lastNumber + 1);
    }

    public function createOrder(array $data)
    {
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => $this->generateOrderNumber(),
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'] ?? '',
            'order_date' => now(),
            'delivery_date' => $data['delivery_date'] . ' ' . ($data['delivery_time'] ?? '00:00:00'),
            'event_type' => $data['event_type'] ?? null,
            'pickup_method' => $data['pickup_method'] ?? 'Dikirim',
            'delivery_address' => $data['delivery_address'] ?? null,
            'subtotal' => 0,
            'shipping_fee' => $data['shipping_fee'] ?? 0,
            'total_amount' => 0,
            'down_payment' => $data['down_payment'] ?? 0,
            'payment_status' => 'Belum Lunas',
            'payment_method' => $data['payment_method'] ?? 'Cash',
            'order_status' => 'masuk',
            'notes' => $data['notes'] ?? null,
        ]);

        $subtotal = 0;

        if (!empty($data['items'])) {
            foreach ($data['items'] as $item) {
                // Determine menu ID. The frontend might send name or ID. Let's find by ID.
                if (isset($item['menu_id']) && $item['menu_id']) {
                    $menu = Menu::where('user_id', Auth::id())->find($item['menu_id']);
                } else {
                    $menu = Menu::where('user_id', Auth::id())->where('name', $item['menu'])->first();
                }

                if ($menu) {
                    $qty = (int) ($item['qty'] ?? 1);
                    $price = $menu->selling_price;
                    
                    // Calculate addons
                    $addonsPrice = 0;
                    $selectedAddons = [];
                    if (!empty($item['addons'])) {
                        foreach ($item['addons'] as $adData) {
                            $mAddon = \App\Models\MenuAddon::where('user_id', Auth::id())->find($adData['id']);
                            if ($mAddon) {
                                $addonsPrice += $mAddon->price;
                                $selectedAddons[] = $mAddon;
                            }
                        }
                    }

                    $itemSubtotal = $qty * ($price + $addonsPrice);
                    $subtotal += $itemSubtotal;

                    $orderItem = OrderItem::create([
                        'order_id' => $order->id,
                        'menu_id' => $menu->id,
                        'quantity' => $qty,
                        'price' => $price,
                        'subtotal' => $itemSubtotal,
                    ]);

                    foreach ($selectedAddons as $mAddon) {
                        $orderItem->addons()->create([
                            'menu_addon_id' => $mAddon->id,
                            'price' => $mAddon->price,
                        ]);
                    }
                }
            }
        }

        $totalAmount = $subtotal + $order->shipping_fee;

        $paymentStatus = 'Belum Lunas';
        if ($order->down_payment > 0 && $order->down_payment < $totalAmount) {
            $paymentStatus = 'DP';
        } elseif ($order->down_payment >= $totalAmount) {
            $paymentStatus = 'Lunas';
        }

        $order->update([
            'subtotal' => $subtotal,
            'total_amount' => $totalAmount,
            'payment_status' => $paymentStatus,
        ]);

        return $order;
    }

    public function getAllOrders()
    {
        return Order::where('user_id', Auth::id())
            ->with(['items.menu', 'items.addons.menuAddon'])
            ->latest()
            ->get();
    }

    public function updateOrderStatus($id, $status)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $order->update(['order_status' => $status]);
        return $order;
    }

    public function getOrderById($id)
    {
        return Order::where('user_id', Auth::id())
            ->with(['items.menu', 'items.addons.menuAddon'])
            ->findOrFail($id);
    }

    public function updateOrder($id, array $data)
    {
        $order = $this->getOrderById($id);

        // Recalculate subtotal from new items
        $subtotal = 0;
        $newItems = [];

        if (!empty($data['items'])) {
            foreach ($data['items'] as $item) {
                $menu = \App\Models\Menu::where('user_id', Auth::id())->where('name', $item['menu'])->first();
                if ($menu) {
                    $qty = (int) ($item['qty'] ?? 1);
                    $price = $menu->selling_price;
                    
                    // Calculate addons
                    $addonsPrice = 0;
                    $selectedAddons = [];
                    if (!empty($item['addons'])) {
                        foreach ($item['addons'] as $adData) {
                            $mAddon = \App\Models\MenuAddon::where('user_id', Auth::id())->find($adData['id']);
                            if ($mAddon) {
                                $addonsPrice += $mAddon->price;
                                $selectedAddons[] = $mAddon;
                            }
                        }
                    }

                    $itemSubtotal = $qty * ($price + $addonsPrice);
                    $subtotal += $itemSubtotal;
                    $newItems[] = [
                        'order_id' => $order->id,
                        'menu_id' => $menu->id,
                        'quantity' => $qty,
                        'price' => $price,
                        'subtotal' => $itemSubtotal,
                        'addons' => $selectedAddons
                    ];
                }
            }
        }

        $shippingFee = $data['shipping_fee'] ?? 0;
        $totalAmount = $subtotal + $shippingFee;
        $downPayment = $data['down_payment'] ?? 0;

        $paymentStatus = 'Belum Lunas';
        if ($downPayment > 0 && $downPayment < $totalAmount) {
            $paymentStatus = 'DP';
        } elseif ($downPayment >= $totalAmount) {
            $paymentStatus = 'Lunas';
        }

        $order->update([
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'] ?? '',
            'delivery_date' => $data['delivery_date'] . ' ' . ($data['delivery_time'] ?? '00:00:00'),
            'event_type' => $data['event_type'] ?? null,
            'delivery_address' => $data['delivery_address'] ?? null,
            'subtotal' => $subtotal,
            'shipping_fee' => $shippingFee,
            'total_amount' => $totalAmount,
            'down_payment' => $downPayment,
            'payment_status' => $paymentStatus,
            'payment_method' => $data['payment_method'],
            'notes' => $data['notes'] ?? null,
        ]);

        // Replace items
        $order->items()->delete();
        foreach ($newItems as $itemData) {
            $addons = $itemData['addons'] ?? [];
            unset($itemData['addons']);
            
            $orderItem = \App\Models\OrderItem::create($itemData);
            
            foreach ($addons as $mAddon) {
                $orderItem->addons()->create([
                    'menu_addon_id' => $mAddon->id,
                    'price' => $mAddon->price,
                ]);
            }
        }

        return $order;
    }

    public function deleteOrder($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $order->items()->delete();
        $order->delete();
        return true;
    }

    public function updateOrderPayment($id, $amount)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $newDp = $order->down_payment + $amount;

        $paymentStatus = 'Belum Lunas';
        if ($newDp > 0 && $newDp < $order->total_amount) {
            $paymentStatus = 'DP';
        } elseif ($newDp >= $order->total_amount) {
            $paymentStatus = 'Lunas';
            $newDp = $order->total_amount; // Cap at total amount
        }

        $order->update([
            'down_payment' => $newDp,
            'payment_status' => $paymentStatus
        ]);

        return $order;
    }
}
