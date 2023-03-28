<?php

namespace App\Http\Controllers;

use App\Http\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    public function index($id = '', $slug = ''){
        $product = $this->productService->show($id);
        $relatedProduct = $this->productService->relatedProducts($id, $product->menu_id);

        //dd($relatedProduct);
        return view('products.productDetail',[
            'title' => $product->name,
            'productDetail' => $product,
            'relatedProduct' => $relatedProduct
        ]);
    }
}
