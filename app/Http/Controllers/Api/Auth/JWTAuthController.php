<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTAuthController extends Controller
{
        public function login(Request $request)
        {
            $credentials = $request->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'Invalid credentials'], 401);
                }

                $user = JWTAuth::user();
                return response()->json([
                    'message' => 'success',
                    'data' => $user,
                    'token' => $token
                ]);

            } catch (JWTException $e) {
                return response()->json(['error' => 'Could not create token'], 500);
            }
        }

        public function getUser()
        {
            try {
                if (! $user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['error' => 'User not found'], 404);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'Invalid token'], 400);
            }

            return response()->json(compact('user'));
        }

        public function logout()
        {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['message' => 'Successfully logged out']);
        }
}
