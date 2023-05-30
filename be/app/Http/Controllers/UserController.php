<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        
        $validator=Validator::make($request->all(),[
            'username'=>'required',
            'password'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 409);
        }

        $user = User::where('username', $request->username)->first();

        if ($user && password_verify($request->password,$user->password)) {
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['error' => ["Wrong username or password"]], 409);
        }


    }


    public function register(Request $request){
        
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'lastname'=>'required',
            'username'=>'required|unique:users',
            'email'=>'required|unique:users',
            'password'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 409);
        }

        $user = new User();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json(['message'=>["User created successfully"]]);
    }
}
