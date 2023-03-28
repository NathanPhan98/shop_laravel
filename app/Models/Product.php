<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [	'name',	'thumbnail'	  , 'description'	,'content'	,'menu_id',	'price'	,'price_sale'	,'active'];

    public function menu(){
        return $this->hasOne(Menu::class, 'id','menu_id')
        ->withDefault(['name'=>'']);  
        // trong trường hợp chúng ta lỡ xóa Menu của sản phẩm, thì thêm withDefault() vào để nó có thể lấy ra sản phẩm trong dssp mà
        // không cần có menu sản phẩm (loại sản phẩm)
    }
}
