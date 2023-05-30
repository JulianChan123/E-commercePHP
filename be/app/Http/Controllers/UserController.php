<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Add CORS headers
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 409);
        }

        $user = new User();
        $user->name = $request->name;
        $user->lastName = $request->lastName;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = encrypt($request->password);
        $user->save();
        return response()->json(['message' => ["User created successfully"]]);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'userName' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 409);
        }

        $user = User::where('userName', $request->email)->get()->first();
        $password = decrypt($user->password);

        if ($user && $password == $request->password) {
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['error' => ["Wrong email or password"]], 409);
        }
    }
}
