<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductAdminService;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductAdminService $productService){
        $this->productService = $productService;
    }
    /** 
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products.list',[
            'title' => 'Danh sach san pham',
            'products' => $this->productService->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.add', [
            'title' => 'Thêm Sản Phẩm Mới',
            'menus' => $this->productService->getMenu()
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->productService->insert($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)  // Ý nghĩa của việc truyền Model Product: Khoa Phạm bài 23 phút 1:02
    // biến $product trùng với tham số product bên Route thì nó tự đọng kiểm tra product này có trong data hay chưa 
    {
        return view('admin.products.edit',[
            'title' => 'Sua san pham',
            'menus' => $this->productService->getMenu(),
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductRequest $request)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $rs = $this->productService->update($request, $product);
        if($rs){
            return redirect()->route('dsSP');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) // Khoa Phạm bài 24  phần xóa
    {
        $rs = $this->productService->delete($request);
        if($rs){
            return response()->json([
                'error' => false,
                'message' => 'xoa thanh cong'

            ]);
        }
        return response()->json(['error' => true]);
    }
}
