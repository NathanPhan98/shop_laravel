<?php 

namespace App\Http\Services;

use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function addCart($request){
        try{
            DB::beginTransaction(); // chạy trong try lỗi 1 cái sẽ rollback lại
            $carts = Session::get('carts');
            if(is_null($carts)) return false;

            $customer = Customer::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'content' => $request->input('content')
            ]);

            // get product information
            $this->infoProductCart($carts,$customer->id);

            DB::commit(); // không lỗi thì commit 
            Session::flash('success','Dat hang thanh cong'); 
            
            #Queue
            SendMail::dispatch($request->input('email'))->delay(now()->addSecond(3));
            // Sau ghi dac hang thanh cong thi 3s sau moi gui mail 

            Session::forget('carts'); // xong thì xóa session 
            
        } catch (\Exception $err){
            DB::rollback(); // lỗi thì khôi phục lại ban đầu 
            Session::flash('error','Dat hang that bai, vui long dat lai');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    
    protected function infoProductCart($carts,$customer_id){
        $productId = array_keys($carts); 
        $products = Product::select('id','name','price','price_sale','thumbnail')
        ->where('active',1)
        ->whereIn('id',$productId)
        ->get();
        
        $data = [];
        foreach($products as $product){
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'quantity'	=> $carts[$product->id],
                'price' => $product->price_sale != 0? $product->price_sale: $product->price
            ];
        }

        return Cart::insert($data);
    }
}