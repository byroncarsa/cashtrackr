<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(SignupRequest $request){

        //Forma menos util
        // $name = $request->input('name');
        // $email = $request->input('email');

        //Mejor forma pero carga mucho el controlador
        // $data = $request->validate([
        //     'name' => ['required', 'string'],
        //     'email' => ['required', 'email']
        // ],[
        //     'name.required' => 'El nombre es obligaotio',
        //     'email.required' => 'El email es obligaotio',
        //     'email.email' => 'El email no es valido'
        // ]);

        $data = $request->validated();

        //Mostrar datos
        // dd($data);

        User::create($data);
    }
}
