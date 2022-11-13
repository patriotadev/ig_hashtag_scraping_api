<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function register(Request $request)
    {

        try {
            Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email:rfc,dns|unique:users,email',
                'password' => 'required'
            ]);

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            User::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'User successfully added.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => $th
            ]);
        }
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 'success',
                    'data' => $user,
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'email or password not correct.'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'email not found'
            ]);
        }
    }
}
