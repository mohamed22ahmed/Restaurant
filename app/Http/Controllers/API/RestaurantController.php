<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(){
        return Restaurant::paginate(5);
    }

    public function store(Request $request){
        $res=new Restaurant;
        $res->name=$request->name;
        $res->phone=$request->phone;
        $res->address=$request->address;
        $res->save();
    }

    public function update(Request $request,$id){
        $res=Restaurant::find($id);
        $res->name=$request->name;
        $res->phone=$request->phone;
        $res->address=$request->address;
        $res->save();
    }
    
    public function destroy($id){
        Restaurant::find($id)->delete();
    }
}
