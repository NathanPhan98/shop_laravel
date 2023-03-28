<?php


namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class SliderService 
{
    public function insert($request){
        try{
            Slider::create($request->input());
            Session::flash('success','Them slider thanh cong');
        }catch(\Exception $error){
            Session::flash('error','Them slider ko duoc');
            Log::info($error->getMessage());
            return false;
        }
        return true;
    }

    public function get(){
        return Slider::OrderByDesc('id')->paginate(15);
    }

    public function update($slider , $request){
        try{
            $slider->fill($request->input());
            $slider->save();
        Session::flash('success', 'Cap nhat slider thanh cong ');
        }catch(\Exception $error ){
            Session::flash('error', 'Cap nhat slider that bai ');
            Log::info($error->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($request){
        $slider = Slider::Where('id',$request->input('id'))->first();
        if($slider){

            // Xóa ảnh trong thư mục luôn nè:           Bài 29 Khoa Phạm 
            File::delete(substr($slider->thumbnail, 1));
            //Dùng Storage::delete gióng KP ko được nên chơi kiểu này, do khúc đầu nó cần xóa 1 dấu / nên sài substr()
            $slider->delete();
            return true;
        }
        return false;
    }
    
    public function show(){
        return Slider::where('active',1)->orderByDesc('sort_by')->get();
    }

    
}