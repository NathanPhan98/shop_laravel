<?php

namespace App\Http\Controllers;

use App\Http\Services\Slider\SliderService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use Illuminate\Http\Request;

class MainClientController extends Controller
{

    protected $slider;
    protected $menu;
    protected $product;

    public function __construct(MenuService $menu, SliderService $slider, ProductService $product){
        $this->menu = $menu;
        $this->slider = $slider;
        $this->product = $product;
    }


    public function index(){
        return view('home',[
            'title' => 'Shop Quan Ao Tan',
            'menus' => $this->menu->show(), 
            'sliders' =>$this->slider->show(),
            'products' =>$this->product->get()
        ]);
    }

    public function LoadMoreProduct(Request $request){
        $page = $request->input('page',0);
        $rs = $this->product->get($page);
        
        if(count($rs)!= 0){
           $html = view('products.list',['products'=>$rs])->render();
           return response()->json(['html' => $html]);
        }
       return response()->json(['html' => '']);
    }
}
