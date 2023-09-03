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
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','max:255'],
        ]);

        $id = User::orderBy('id', 'desc')->first()->id;

        $user = User::create([
            'id'=>$id+1,
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
        ]);

        $user->roles()->sync(3);

        if ($user){
            Auth::login($user);
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('login');
        }
    }
}
