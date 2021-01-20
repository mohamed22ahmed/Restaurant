<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(){
        return Expense::paginate(5);
    }

    public function store(Request $request){
        $res=new Expense;
        $res->name=$request->name;
        $res->price=$request->price;
        $res->save();
    }

    public function update(Request $request,$id){
        $res=Expense::find($id);
        $res->name=$request->name;
        $res->price=$request->price;
        $res->save();
    }
    
    public function destroy($id){
        Expense::find($id)->delete();
    }
}
