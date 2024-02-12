<?php

namespace App\Http\Controllers\Vue\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $password =  $data['password'];
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $token = auth()->attempt(['email' => $user->email, 'password' => $password]);
       // $token = (new JWTAuth)->fromUser($auth);
       //
        //$token = auth()->attempt($user);
        return $token;
       // return (new AuthController)->logout();
    }
}
