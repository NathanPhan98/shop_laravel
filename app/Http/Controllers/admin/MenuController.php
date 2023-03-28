<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu;

class MenuController extends Controller
{

    protected $menuService;

    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }

    public function create(){
        return view('admin.menu.add',[
            'title' => 'Add new Menu',
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request){
        $this->menuService->create($request);

        return redirect()->back();
    }

    public function index(){
        // echo "<pre>";
        // var_dump($this->menuService->getAll());
        // echo "</pre>";
        // exit;
        return view('admin.menu.list',[
            'title' => 'Danh sach danh muc',
            'menus' =>$this->menuService->getAll() 
        ]);
    }

    public function destroy(Request $request){


        $result = $this->menuService->destroy($request);

        

        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xoa thanh cong danh muc'
            ]);
        }
        
        return response()->json([
            'error' => true
        ]);
    }

    public function show(Menu $menu){

        return view('admin.menu.edit',[
            'title' => 'chinh sua danh muc: ' . $menu->name,
            'menus' =>$this->menuService->getAll(),
            'menu' =>$menu
        ]);
    }

    public function update(Menu $menu, CreateFormRequest $request) {
        $this->menuService->update($request , $menu);

        return redirect('/admin/menus/list');
    }
}
