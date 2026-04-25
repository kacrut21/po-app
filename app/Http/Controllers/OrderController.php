<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\MenuService;

class OrderController extends Controller
{
    protected $orderService;
    protected $menuService;

    public function __construct(OrderService $orderService, MenuService $menuService)
    {
        $this->orderService = $orderService;
        $this->menuService = $menuService;
    }

    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        
        // Map data to match the Alpine frontend format precisely
        $statusMap = ['masuk' => 0, 'konfirmasi' => 1, 'produksi' => 2, 'siap' => 3, 'selesai' => 4];
        
        $formattedOrders = $orders->map(function ($order) use ($statusMap) {
            return [
                'id' => $order->id,
                'poNumber' => $order->order_number,
                'name' => $order->customer_name,
                'wa' => $order->customer_phone,
                'event' => $order->event_type,
                'address' => $order->delivery_address,
                'notes' => $order->notes,
                'status' => $order->order_status,
                'statusIdx' => $statusMap[$order->order_status] ?? 0,
                'date' => $order->delivery_date,
                'dp' => $order->down_payment,
                'shipping_fee' => $order->shipping_fee,
                'payment_method' => $order->payment_method,
                'total' => $order->total_amount,
                'items' => $order->items->map(function ($item) {
                    return [
                        'menu' => $item->menu ? $item->menu->name : 'Menu Terhapus',
                        'qty' => $item->quantity,
                        'price' => $item->price
                    ];
                })
            ];
        });

        return view('pages.pesanan', ['orders' => $formattedOrders]);
    }

    public function create()
    {
        $menus = $this->menuService->getAllMenus(true); // active menus only
        return view('pages.form-po', compact('menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:50',
            'delivery_address' => 'nullable|string',
            'event_type' => 'nullable|string|max:255',
            'delivery_date' => 'required|date',
            'delivery_time' => 'required|string',
            'shipping_fee' => 'nullable|numeric|min:0',
            'down_payment' => 'nullable|numeric|min:0',
            'payment_method' => 'required|string|in:Cash,Transfer,QRIS',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.menu' => 'required|string',
            'items.*.qty' => 'required|numeric|min:1',
        ]);

        $this->orderService->createOrder($validated);

        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function edit($id)
    {
        $order = $this->orderService->getOrderById($id);
        $menus = $this->menuService->getAllMenus(true);
        return view('pages.form-po', compact('menus', 'order'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:50',
            'delivery_address' => 'nullable|string',
            'event_type' => 'nullable|string|max:255',
            'delivery_date' => 'required|date',
            'delivery_time' => 'required|string',
            'shipping_fee' => 'nullable|numeric|min:0',
            'down_payment' => 'nullable|numeric|min:0',
            'payment_method' => 'required|string|in:Cash,Transfer,QRIS',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.menu' => 'required|string',
            'items.*.qty' => 'required|numeric|min:1',
        ]);

        $this->orderService->updateOrder($id, $validated);

        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil diperbarui!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string|in:masuk,konfirmasi,produksi,siap,selesai']);
        $order = $this->orderService->updateOrderStatus($id, $request->status);
        return response()->json(['success' => true, 'order' => $order]);
    }

    public function destroy($id)
    {
        $this->orderService->deleteOrder($id);
        return response()->json(['success' => true]);
    }

    public function updatePayment(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);
        $order = $this->orderService->updateOrderPayment($id, $request->amount);
        return response()->json(['success' => true, 'order' => $order]);
    }
}
