<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function loginView(){
        return view('Pages.Login');
    }

    public function login(Request $request){

        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $credentials = $request->only('email','password');

        if($this->authRepository->login($credentials)){
            $user = $this->authRepository->getAuthenticatedUser();
            if($user['rol_id'] == 1){
                return redirect('/books')->with('msg','Bienvenido');
            }
            return redirect('/loans')->with('msg','Bienvenido');
        }

        return redirect('/login')->with('msg','credenciales invalidas');

    }

    public function logout()
    {
        $this->authRepository->logout();
        return redirect('/login')->with('msg','logout');
    }
}
