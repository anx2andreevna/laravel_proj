<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create(){
        //return view('auth/signup');
    }

    public function signUp(Request $request){
        
        $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:App\Models\User',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name, 
            'email'=> $request->email,
            'password' => Hash::make($request->password),

        ]);

        $token = $user ->createToken('myAppToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response()->json($response, 201);


        //return redirect()->route('login');
    }
    //открытие поля для аунтификации
    public function login(){
       // return view('auth.login');
    }

    //обработка отправки формы (подтверждение аутентификации)
    public function customLogin(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($credentials)){
            $token = auth()->user()->createToken('myAppToken');
            return response($token, 201);
        }
        return response('Bad login', 401);
    }

     //разлогиниться
     public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response('logout');
    }
}
