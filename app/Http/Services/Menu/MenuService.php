<?php 

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuService
{
    public function getParent(){
        return Menu::where('parent_id',0)->get();
    }

    public function getAll(){
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function create($request){
        try{
        Menu::create([
            'name' => (string) $request->input('name'),
            'parent_id' => (int) $request->input('parent_id'),
            'discription' => (string) $request->input('discription'),
            'content' => (string) $request->input('content'),

            //'slug' => Str::slug($request->input('name'),'-'),
            
            'active' => (string) $request->input('active')
        ]);
        Session::flash('success','Tao danh muc thanh cong'); 

        }catch(\Exception $err){
            Session::flash('error',$err->getMessage()); 
            return false;
        }
        return true;
    }

    public function update($request, $menu) : bool {
        if($request->input('parent_id') != $menu->id){
            $menu->parent_id = (int)$request->input('parent_id');
        }
        $menu->name = (string)$request->input('name');
        $menu->discription = (string)$request->input('discription');
        $menu->content = (string)$request->input('content');
        $menu->active = (string)$request->input('active');

        $menu->save();

        Session::flash('success','Cap nhat thanh cong danh muc');
        return true;
    }

    public function destroy($request){
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $id)->first();
        if($menu){
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    //client
    public function show(){
        return Menu::select('id','name')->where('parent_id',0)->orderbyDesc('id')->get();
    }

    public function getId($id){
        return Menu::where('id',$id)->where('active',1)->firstOrFail(); 
    }

    public function getProduct($menu){
        return $menu->products()->select('id','name','price','price_sale','thumbnail')
                ->where('active',1)
                ->orderByDesc('id')
                ->paginate(12); 
    }
}