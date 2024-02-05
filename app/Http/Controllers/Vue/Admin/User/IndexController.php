<?php

namespace App\Http\Controllers\Vue\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $users = User::all();
        $roles = User::getRoles();
//        return response()->json($users,$roles);
//        //return compact('users')->toJson();
        return compact('users','roles');
    }
}
