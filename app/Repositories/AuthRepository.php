<?php

    namespace App\Repositories;
    use App\Repositories\Interfaces\AuthRepositoryInterface;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;
    class AuthRepository implements AuthRepositoryInterface {

        public function login(array $credentials){
            if (Auth::attempt($credentials)) {
                return Auth::user();
            }

            return null;
        }

        public function logout()
        {
            Auth::logout();
        }

        public function getAuthenticatedUser()
        {
            return Auth::user();
        }

    }
