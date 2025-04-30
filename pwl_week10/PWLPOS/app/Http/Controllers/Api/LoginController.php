<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
          //set validation

          $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
          ]);

          //if validator fails
          if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
          }

          //get credentials from request
          $credential = $request->only('username','password');

          //if auth failed
          if (!$token = auth()->guard('api')->attempt($credential)) {
            return response()->json([
                'succes' => false,
                'message' => 'Username atau password Anda salah'
            ],401);
          }

          //if auth succes
          return response()->json([
            'succes' => true,
            'user'  => auth()->guard('api')->user(),
            'token' => $token
          ], 200);            
    }
}
