<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        try {
            $userValidation = Validator::make($request->all(),[
                'name'     => ['required', 'string', 'max:255'],
                'password' => ['required', 'min:8','max:255'],
            ]);

            if ($userValidation->fails()){
                return response()->json([
                    'message' => 'Validation error.',
                    'status' => false,
                    'code' => 401,
                    'errors'=>$userValidation->errors(),
                ], 401);
            }

            $count = User::where('name', $request->name)->first();
            if(!$count){
                $id = User::orderBy('id', 'desc')->first()->id + 1;
                $user = User::create([
                    'id'=>$id,
                    'name' => $request->name,
                    'password' => bcrypt($request->password),
                ]);
                $user->roles()->sync(3);

                $authToken = $user->createToken('auth-token')->plainTextToken;
                event(new Registered($user));

                return response()->json([
                    'data' => [
                        'id' => $user->id,
                        'access_token' => $authToken,
                    ],
                    'message' => 'Sucsessfully',
                    'status' => true,
                    'code' => 200,
                ]);
            }else{
                return response()->json([
                    'message' => 'Name already exists.',
                    'status' => false,
                    'code' => 401,
                ], 401);
            }
        }catch (\Throwable $throwable){
            return response()->json([
                'message' => $throwable->getMessage(),
                'status' => false,
                'code' => 500,
            ], 500);
        }

    }


    public function login(Request $request)
    {

        try {

            $userValidation = Validator::make($request->all(), [
                'name'     => ['required', 'string', 'max:255'],
                'password' => ['required', 'min:8','max:255'],
            ]);

            if ($userValidation->fails()){
                return response()->json([
                    'message' => 'Validation error.',
                    'status' => false,
                    'code' => 401,
                    'errors'=>$userValidation->errors(),
                ], 401);
            }

            if (!Auth::attempt($request->only(['name', 'password']))){
                return response()->json([
                    'message' => 'Name or Password does not match with our record.',
                    'status' => false,
                    'code'=>401
                ], 401);
            }

            $user = User::where('name', $request->name)->first();
            $authToken = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'data' => [
                    'access_token' => $authToken,
                ],
                'message' => 'User Logged In Successfully',
                'status' => true,
                'code'=>200,
            ]);

        }catch (\Throwable $throwable){
            return response()->json([
                'message' => $throwable->getMessage(),
                'status' => false,
                'code' => 500,
            ], 500);
        }

    }

    public function logout(Request $request)
    {
        try {

            auth()->user()->tokens()->delete();

            return [
                'message'=>'User Logged out',
            ];
        }catch (\Throwable $throwable){
            return response()->json([
                'message' => $throwable->getMessage(),
                'status' => false,
                'code' => 500,
            ], 500);
        }

    }
}
