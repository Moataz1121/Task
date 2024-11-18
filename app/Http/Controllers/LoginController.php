<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    //
    public function store (Request $request) {
        $validator = Validator::make($request->all(), ([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
    
        ]), [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ]);
        if ($validator->fails()) {
            return ApiResponse::sendResponse(200, 'Failed', $validator->messages()->all());
        }
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $data['token'] = $user->createToken('auth_token')->plainTextToken;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['id'] = $user->id;
            return ApiResponse::sendResponse(200, 'Success Login', $data);
        } else {
            return ApiResponse::sendResponse(401, 'user credentials not match', null);
        }
    }
    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful']);
    }
}
