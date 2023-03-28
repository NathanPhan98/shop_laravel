<?php


namespace App\Http\Services\Product;

use App\Models\Product;

class ProductService
{
    const LIMIT = 16;

    public function get($page = null){
        return Product::select('id','name','price','price_sale','thumbnail')

 
        ->when($page != null, function($query) use ($page){
            $query->offset($page * self::LIMIT);
        })

        ->limit(self::LIMIT)
        ->where('active',1)
        ->orderByDesc('id')
        ->get();
    }

    public function show($id){

        return Product::where('id',$id)
        ->with('menu') 
        ->where('active',1)->firstOrFail();
        
    }

    public function relatedProducts($id,$menu_id){
        return Product::select('id','name','price','price_sale','thumbnail')
        ->where('menu_id', $menu_id)
        ->where('active',1)->get();
    }
}