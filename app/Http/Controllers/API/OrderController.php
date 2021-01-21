<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $id=Order::max('id');
        return Order::join('deliveries',function($join){
            $join->on('orders.delivery_id','deliveries.id');
        })->select('deliveries.delivery_price as delivery','orders.*')->where('orders.id',$id)->get();
    }

    public function get_menus($id){
        return Menu::join('restaurants',function($join){
            $join->on('restaurants.id','menus.restaurant_id');
        })
        ->select('menus.*','restaurants.name')
        ->where('restaurant_id',$id)
        ->get();
    }

    public function get_delivery(){
        return Delivery::all();
    }

    public function get_foods($ids){
        $foods=explode(',',$ids);
        return Menu::whereIn('id',$foods)->get();
    }

    public function store(Request $request){
        $total=0;
        foreach($request->userIds as $id){
            $menu=Menu::find($id);
            $total+=(int)$menu->price;
        }
        $food_list=implode(',',$request->userIds);
        $order=new Order;
        $order->name=$request->name;
        $order->phone=$request->phone;
        $order->address=$request->address;
        $order->restaurant_id=$request->restaurant_id;
        $order->delivery_id=$request->delivery_id;
        $order->food_list=$food_list;
        $order->total_price=$total;
        $order->user_name=session('user')->name;
        $order->save();
    }
}
