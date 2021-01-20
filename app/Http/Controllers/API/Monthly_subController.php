<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Monthly_sub;
use Illuminate\Http\Request;

class Monthly_subController extends Controller
{
    public function index(){
        return Monthly_sub::join('clients',function($join){
            $join->on('clients.id','monthly_subs.client_id');
        })->select('monthly_subs.*','clients.name','clients.address','clients.phone')->paginate(5);
    }

    public function get_clients(){
        return Client::all();
    }

    public function store(Request $request){
        date_default_timezone_set("Africa/Cairo");
        $sub=new Monthly_sub;
        $sub->subscription=$request->subscription;
        $sub->client_id=$request->client_id;
        $sub->price=$request->price;
        $sub->period=$request->period;
        $sub->supplier_name=$request->supplier_name;
        $sub->notes=$request->notes;
        $sub->save();
    }

    public function update(Request $request,$id){
        date_default_timezone_set("Africa/Cairo");
        $sub=Monthly_sub::find($id);
        $sub->subscription=$request->subscription;
        $sub->client_id=$request->client_id;
        $sub->price=$request->price;
        $sub->period=$request->period;
        $sub->supplier_name=$request->supplier_name;
        $sub->notes=$request->notes;
        $sub->save();
    }
    
    public function destroy($id){
        Monthly_sub::find($id)->delete();
    }
}
