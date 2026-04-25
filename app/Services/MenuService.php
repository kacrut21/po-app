<?php

namespace App\Services;

use App\Models\Menu;

use Illuminate\Support\Facades\Auth;

class MenuService
{
    /**
     * Get all active menus or all menus
     */
    public function getAllMenus($activeOnly = false)
    {
        $query = Menu::where('user_id', Auth::id())->with('ingredients');
        
        if ($activeOnly) {
            $query->where('is_active', true);
        }

        return $query->latest()->get();
    }

    /**
     * Create a new menu
     */
    public function createMenu(array $data)
    {
        // Handle image upload if exists
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['image']->store('menus', 'public');
            $data['image'] = $path;
        }

        $data['user_id'] = Auth::id();

        return Menu::create($data);
    }

    /**
     * Get a menu by ID
     */
    public function getMenuById($id)
    {
        return Menu::where('user_id', Auth::id())->findOrFail($id);
    }

    /**
     * Update an existing menu
     */
    public function updateMenu($id, array $data)
    {
        $menu = $this->getMenuById($id);

        // Handle image upload if exists
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['image']->store('menus', 'public');
            $data['image'] = $path;
            
            // Note: Should ideally delete the old image here
        }

        $menu->update($data);

        return $menu;
    }

    /**
     * Delete a menu
     */
    public function deleteMenu($id)
    {
        $menu = $this->getMenuById($id);
        // Note: Should ideally delete the associated image here
        return $menu->delete();
    }

    /**
     * Sync HPP ingredients for a menu
     */
    public function syncHpp($id, array $data)
    {
        $menu = $this->getMenuById($id);
        
        // Update menu fields
        $menu->update([
            'hpp' => $data['hppPortion'] ?? 1,
            'selling_price' => $data['hppSellPrice'] ?? $menu->selling_price,
            'margin' => $data['hppMargin'] ?? 0,
        ]);

        $pivotData = [];

        if (!empty($data['ingredients'])) {
            foreach ($data['ingredients'] as $ing) {
                // Ignore empty rows
                if (empty($ing['name'])) continue;

                $qty = (float) ($ing['qty'] ?? 1);
                $totalPrice = (float) ($ing['price'] ?? 0);
                $pricePerUnit = $qty > 0 ? ($totalPrice / $qty) : 0;

                // Find or create ingredient for this user by name
                $ingredient = \App\Models\Ingredient::firstOrCreate(
                    [
                        'user_id' => Auth::id(),
                        'name' => trim($ing['name'])
                    ],
                    [
                        'unit' => $ing['unit'] ?? 'pcs',
                        'price_per_unit' => $pricePerUnit
                    ]
                );

                // Always update the price_per_unit to the latest calculated one
                if ($ingredient->price_per_unit != $pricePerUnit || $ingredient->unit != ($ing['unit'] ?? 'pcs')) {
                    $ingredient->update([
                        'price_per_unit' => $pricePerUnit,
                        'unit' => $ing['unit'] ?? 'pcs'
                    ]);
                }

                // Add to pivot data array
                $pivotData[$ingredient->id] = ['quantity' => $qty];
            }
        }

        // Sync ingredients to pivot table
        $menu->ingredients()->sync($pivotData);

        return $menu;
    }
}
