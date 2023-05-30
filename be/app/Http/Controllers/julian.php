<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class julian extends Controller
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

        if ($user && $user->password == $request->password) {
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['error' => ["Wrong username or password"]], 409);
        }


    }

}
