<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Order;
use DB;

class SalesController extends Controller
{
    public function get_sales($date){
        $orders=Order::join('restaurants',function($join){
            $join->on('orders.restaurant_id','restaurants.id');
        })
        ->join('deliveries',function($join){
            $join->on('orders.delivery_id','deliveries.id');
        })->select('deliveries.address as addr','restaurants.name as restaurant','orders.*')
        ->where(DB::raw('date(orders.created_at)'),date("Y-m-d",strtotime($date)))
        ->get();

        foreach($orders as $ord){
            $ord->food_list=count(explode(',',$ord->food_list));
        }
        return $orders;
    }

    public function destroy($id){
        Order::find($id)->delete();
    }
}
