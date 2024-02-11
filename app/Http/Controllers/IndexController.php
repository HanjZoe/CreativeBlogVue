<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {

        if(strpos(url()->current(), 'login') || strpos(url()->current(), 'registration')){
            $layout = 'layouts.app';
            } elseif (strpos(url()->current(), 'admin') || strpos(url()->current(), 'admin')) {
            $layout = 'Admin.layouts.theme';
        } else {
            $layout = 'layouts.theme';
        }

        return view('Vue.Admin.Main.index',compact('layout'));
    }

}
