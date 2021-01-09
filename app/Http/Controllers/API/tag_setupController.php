<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
class tag_setupController
{
    public function index(){
        return User::all();
    }
}
