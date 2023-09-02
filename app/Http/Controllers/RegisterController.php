<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function store(StoreUserRequest $request)
    {
//        abort_if(Gate::denies('profile_password_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
        ]);

        if ($user){
            Auth::login($user);
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('login');
        }
    }
}
