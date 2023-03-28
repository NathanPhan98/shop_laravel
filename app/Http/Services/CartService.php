<?php 

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CartService {
    public function create($request){
        $qty = (int)$request->input('quantity');
        $product_id = (int)$request->input('product_id');

        if($qty <= 0 || $product_id <= 0){
            Session::flush('error','So luong hoac san pham khong hop le');
            return false;
        }

        $carts = Session::get('carts'); // lấy toàn bộ thông tin của carts và $carts sẽ là 1 array 
        if(is_null($carts)){
            // tạo carts mới với key là $product_id và $qty là value 
            Session::put('carts',[
                $product_id => $qty
            ]);
            return true;
        } 
        $exists = Arr::exists($carts, $product_id);
        if($exists){
            // nếu có product id trong cart rồi thì Update vào $product_id
            $carts[$product_id] = $carts[$product_id] + $qty;
            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $qty;
        Session::put('carts', $carts);
        return true;
    }

    public function getProduct(){
        $carts = Session::get('carts');
        if(is_null($carts)) return [];

        $productId = array_keys($carts); 
        return Product::select('id','name','price','price_sale','thumbnail')
        ->where('active',1)
        ->whereIn('id',$productId)
        ->get();
    }

    public function update($request){
        Session::put('carts', $request->input('num_product'));
        return true;
    }

    public function remove($id){
        $carts = Session::get('carts');
        //dd($carts);
        unset($carts[$id]);
        Session::put('carts', $carts);
        return true;
    }
}