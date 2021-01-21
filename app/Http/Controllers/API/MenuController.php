<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function get_restaurants(){
        return Restaurant::all();
    }

    public function index(){
        return Menu::join('restaurants',function($join){
            $join->on('restaurants.id','menus.restaurant_id');
        })->select('menus.*','restaurants.name')->paginate(5);
    }

    public function store(Request $request){
        $menu=new Menu;
        $menu->restaurant_id=$request->restaurant_id;
        $menu->price=$request->price;
        $menu->food=$request->food;
        $menu->save();
    }

    public function update(Request $request,$id){
        $menu=Menu::find($id);
        $menu->restaurant_id=$request->restaurant_id;
        $menu->price=$request->price;
        $menu->food=$request->food;
        $menu->save();
    }

    public function destroy($id){
        Menu::find($id)->delete();
    }
}
