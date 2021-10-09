<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class PassportAuthController extends Controller
{
    //Registration
    public function register(Request $request){
        // dd($request);
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $token = $user->createToken('Laravel8PassportAuth')->accessToken;
        // return response()->json(['token' => $token], 200);
        return view('login');
    }

    //Login
    public function login(Request $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
  
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel8PassportAuth')->accessToken;
            return view('index');
            // return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    //User information
    public function userInfo(){
        $user = auth()->user();
        return response()->json(['user' => $user], 200);
    }

}
