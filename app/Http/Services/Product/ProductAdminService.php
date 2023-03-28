<?php


namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    public function getMenu(){
        return Menu::where('active',1)->get();
    }

    // public function getProductQuantity(){
    //     return Product::count(*)->get();
    // }

    public function get(){
        return Product::with('menu')
        ->orderByDesc('id')->paginate(15);
    }

    protected function isValidPrice($request){
        if($request->input('price')!=0 && $request->input('price_sale')!=0 && $request->input('price_sale') >= $request->input('price')){
            Session::flash('error','Gia giam phai nho hon gia goc');
            return false;
        }

        if((int)$request->input('price')==0 && $request->input('price_sale')!=0){
            Session::flash('error','Vui long nhap gia goc');
            return false;
        }

        return true;
    }

    public function insert($request){
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice === false){
            return false;
        }
        // xác thực những thông tin cần thiết rồi thì truyền tất cả trong request vào (all())

        //dd($request->all());

        try{
            $request->except('_token');
            Product::create($request->all());

            Session::flash('success', 'Them san pham thanh cong');
        } catch (\Exception $error){
            Session::flash('error', 'Them san pham loi');
            Log::info($error->getMessage());
            return false;
        }
        
        return true;      
    }

    public function update($request, $product){
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice === false){
            return false;
        }
            $product->fill($request->input());
            $product->save();
            Session::flash('success','Cap nhat san pham thanh cong');
        try {
        } catch (\Exception $error) {
            Session::flash('error', 'Co loi vui long thu lai');
            Log::info($error->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request){
        $product = Product::where('id',$request->input('id'))->first(); 
        if($product){
            $product->delete();
            return true;
        }
        return false;
    }
}