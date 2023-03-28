<?php 

namespace App\Helpers;
use Illuminate\Support\Str;

class Helper
{
    public static function menu($menus, $parent_id = 0, $char = ''){
        $html = '';
        foreach ( $menus as $key => $menu ){
            if($menu->parent_id == $parent_id){
                $html .= '
                <tr>
                <td>'.$menu->id.'</td>
                <td>'.$char .$menu->name.'</td>
                <td>'. self::active($menu->active).'</td>
                <td>'.$menu->updated_at.'</td>
                <td>
                    <a class="btn btn-primary" href="/admin/menus/edit/'.$menu->id.'">Edit</a>
                    <a class="btn btn-danger"  onclick="removeRow('.$menu->id.',\'/admin/menus/destroy\')">Delete</a>
                </td>
                </tr>
                ';

                //unset($menus[$key]);
                $html .= self::menu($menus,$menu->id,$char .'--');
            }
        }
        return $html;
    }

    public static function active ($active = 0){
        return $active == 0 ? '<span class="btn btn-danger btn-xs">No</span>' :'<span class="btn btn-success btn-xs">Yes</span>'  ;
    }

    public static function menuClient($menus, $parent_id = 0) : string {
        $html = '';
        foreach($menus as $key => $menu){
            if($menu->parent_id == $parent_id){
                $html .= '
                    <li>
                        <a href="/danh-muc/'.$menu->id.'-'.Str::slug($menu->name,'-').'.html">'.$menu->name.' </a>';
                unset($menus[$key]); // unset cho nó nhẹ hơn 1 tí, cái nào lấy ra rồi thì xóa đi, cho nó nhẹ cái mãng của chúng ta 
                if(self::checkMenuCap2($menus,$menu->id)){
                    $html .= '<ul class="sub-menu">';
                    $html .= self::menuClient($menus,$menu->id);
                    $html .= '</ul>';
                }
                $html .='</li>';
            }    
        }

        return $html;
    }

    public static function checkMenuCap2($menus,$id) :bool {
        foreach( $menus as $menu){
            if($menu->parent_id == $id){
                return true;
            }
        }
        return false;
    }

    public static function price($price = 0, $priceSale = 0){
        if($priceSale != 0) return number_format($priceSale);
        if($price != 0) return number_format($price);
        return '<a href="/lien-he.html">Lien he</a>';
    }
}