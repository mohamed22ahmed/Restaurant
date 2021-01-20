<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(){
        return Delivery::paginate(5);
    }

    public function store(Request $request){
        $res=new Delivery;
        $res->address=$request->address;
        $res->delivery_price=$request->delivery_price;
        $res->save();
    }

    public function update(Request $request,$id){
        $res=Delivery::find($id);
        $res->address=$request->address;
        $res->delivery_price=$request->delivery_price;
        $res->save();
    }
    
    public function destroy($id){
        Delivery::find($id)->delete();
    }
}
