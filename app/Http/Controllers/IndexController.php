<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke()
    {
        $personal = false;
        if(strpos(url()->current(), 'login') || strpos(url()->current(), 'registration')){
            $layout = 'layouts.app';
            } elseif (strpos(url()->current(), 'admin')){
            $layout = 'Admin.layouts.theme';

        } elseif (strpos(url()->current(), 'personal')) {
            $layout = 'Admin.layouts.theme';
            $personal = true;
        } else {
            $layout = 'layouts.theme';

        }

        return view('Vue.Admin.Main.index',compact('layout','personal'));
    }

}
