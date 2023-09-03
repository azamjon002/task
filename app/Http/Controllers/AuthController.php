<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'password'=>'required|min:8',
        ]);

        $user = User::where('name', $request->name)->first();

        if ($user){
            if (Hash::check($request->password, $user->password)){
                Auth::login($user);
                return redirect()->route('admin.dashboard');
            }else{
                return back()->with('additionalErrors', 'Parol xato kiritildi');
            }
        }else{
            return back()->with('additionalErrors', 'Ushbu nomdagi user mavjud emas');
        }

    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
