<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        return Client::paginate(5);
    }

    public function store(Request $request){
        $client=new Client;
        $client->name=$request->name;
        $client->phone=$request->phone;
        $client->address=$request->address;
        $client->save();
    }

    public function update(Request $request,$id){
        $client=Client::find($id);
        $client->name=$request->name;
        $client->phone=$request->phone;
        $client->address=$request->address;
        $client->save();
    }
    
    public function destroy($id){
        Client::find($id)->delete();
    }
}
