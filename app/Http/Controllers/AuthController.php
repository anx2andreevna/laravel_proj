<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create(){
        return view('auth/signup');
    }

    public function signUp(Request $request){
        
        $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:App\Models\User',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),

        ]);

        $user ->createToken('myAppToken');
        return redirect()->route('login');
    }
    //открытие поля для аунтификации
    public function login(){
        return view('auth.login');
    }

    //обработка отправки формы (подтверждение аутентификации)
    public function customLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        //массив с параметрами необходимыми для авторизации
        $credentials = [
            'email'=>request('email'), //получаем с пользоват ввода
            'password'=>request('password'),
        ];

        //передаем массив в фасад Auth (отвечает за авторизацию польз)
        if (Auth::attempt($credentials)){
            //обновляем тек сессию
            $request->session()->regenerate(); //если авторизаия пройдена, сравниваем введенные значения с данными в бд
            return redirect('/');
        }

        return back()->withErrors([
            'email'=> 'The provided credentials do not match out records'
        ]);
    }

     //разлогиниться
     public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
