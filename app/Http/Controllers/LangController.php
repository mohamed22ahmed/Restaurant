<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LangController
{
    public function print(Request $request)
    {
        $order = Order::find($request->id);
        $foods = Menu::whereIn('id', explode(',', $order->food_list))->get();
        $delivery = Delivery::find($order->delivery_id);
        $order_numbers_array = array_map('intval', explode(',', $order->ordernum_list));
        return view('printing', compact('order', 'foods', 'delivery', 'order_numbers_array'));
    }

    public function index($lang)
    {
        app()->setLocale($lang);
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function login()
    {
        return view('login');
    }

    public function loged(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                session()->put('user', $user);
                session()->put('lang', 'en');
                return redirect('/order');
            }
        }
        return redirect('/');
    }

    public function logout()
    {
        session()->forget('user');
        session()->forget('lang');
        return redirect('/');
    }

    public function reg()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/');
    }

    public function home()
    {
        return view('home');
    }
}
