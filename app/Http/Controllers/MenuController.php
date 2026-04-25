<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $menus = $this->menuService->getAllMenus();
        return view('pages.menu', compact('menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'selling_price' => 'required|integer',
            'hpp' => 'nullable|integer',
            'margin' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $this->menuService->createMenu($validated);

        return redirect()->route('menu')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $this->menuService->deleteMenu($id);
        
        return redirect()->route('menu')->with('success', 'Menu berhasil dihapus!');
    }

    public function updateHpp(Request $request, $id)
    {
        $validated = $request->validate([
            'hppPortion' => 'required|numeric|min:1',
            'hppSellPrice' => 'required|numeric|min:0',
            'hppMargin' => 'required|numeric',
            'ingredients' => 'nullable|array',
            'ingredients.*.name' => 'nullable|string',
            'ingredients.*.qty' => 'nullable|numeric|min:0',
            'ingredients.*.unit' => 'nullable|string',
            'ingredients.*.price' => 'nullable|numeric|min:0',
        ]);

        $this->menuService->syncHpp($id, $validated);

        return redirect()->route('menu')->with('success', 'Setup HPP berhasil disimpan!');
    }
}
