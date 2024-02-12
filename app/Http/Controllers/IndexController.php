<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke()
    {
        $user = false;
        if(strpos(url()->current(), 'login') || strpos(url()->current(), 'registration')){
            $layout = 'layouts.app';
            } elseif (strpos(url()->current(), 'admin') || strpos(url()->current(), 'personal')) {
            $layout = 'Admin.layouts.theme';
        } else {
            $layout = 'layouts.theme';
            $user = Auth::guard('api')->user();
        }

        return view('Vue.Admin.Main.index',compact('layout','user'));
    }

}
