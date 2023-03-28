<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;

class MenuClientController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }
    public function index(Request $request, $id, $slug){
        $menu = $this->menuService->getId($id);
        $products = $this->menuService->getProduct($menu);
        //dd($products);

        return view('menu',[
            'title' => 'Danh sach san pham loai: '. $menu->name,
            'products' => $products,
            'menu' => $menu
        ]);


    }
}
