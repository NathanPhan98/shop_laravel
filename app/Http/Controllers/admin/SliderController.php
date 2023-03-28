<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;

class SliderController extends Controller
{
    protected $slider;
    public function __construct(SliderService $slider){
        $this->slider = $slider;
    }
    public function create(){
        return view('admin.slider.add',[
            'title' => 'Them slider'    
        ]);
    }

    public function store(Request $request){ // cach validate o controller
        $this->validate($request,[
            'name' => 'required',
            'thumbnail' => 'required',
            'url' => 'required'
        ]);

        $this->slider->insert($request);

        return redirect()->back();
    }

    public function index(){
        return view('admin.slider.list',[
            'title' => 'Danh sach slider',
            'sliders' => $this->slider->get()
        ]);
    }

    public function show(Slider $slider){
        return view('admin.slider.edit',[
            'title' => ' chinh sua slider',
            'slider' => $slider
        ]);
    }

    public function update(Slider $slider, Request $request){
        $this->validate($request,[
            'name' => 'required',
            'thumbnail' => 'required',
            'url' => 'required'
        ]);

        $rs = $this->slider->update($slider, $request);

        if($rs){
            return redirect('/admin/sliders/list');
        }
        return redirect()->back();
    }

    public function destroy(Request $request){
        $rs = $this->slider->destroy($request);
        if($rs){
            return response()->json([
                'error' => false,
                'message' => 'Xoa thanh cong'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
}
