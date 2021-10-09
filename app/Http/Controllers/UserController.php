<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userform;

class UserController extends Controller
{
    public function index(){
        return view('index');
    }

    public function getUser(){
        $users = Userform::all();
        //dd($users);
        return response()->json([
            'code'=>200, 
            'message'=>'Get data successfully',
            'userdata' => $users]);
    }
    
    public function addUser(Request $request){
            //dd($request);
            $request->validate([
                'username' => 'required|min:2|max:255',
                'password' => 'required|min:2|max:255',
                'email' => 'required|email|min:2|max:255',
                'phone' => 'required|string|min:8|max:11',
                'dateofbirth' => 'required|before:today',
                'gender' => 'required',
                'address' => 'required|min:2|max:255',
                'declaration' => 'required',
              ]);
            if(!is_null($request->operation) && $request->operation=="save"){
                $userData = new Userform;
                $userData->username = $request->username;
                $userData->password = $request->password;
                $userData->email = $request->email;
                $userData->phone = $request->phone;
                $userData->dateofbirth = $request->dateofbirth;
                $userData->gender = $request->gender;
                $userData->address = $request->address;
                $userData->declaration = $request->declaration;
                $userData->save();
                if($userData){
                    return response()->json([
                        'code'=>200, 
                        'message'=>'User Created successfully', 
                        'lastId' => $userData->id]);
                }else{
                    return ["Result" => "Save operation failed!!"];
                }
            }else if(!is_null($request->operation) && $request->operation=="update"){
                $userData = Userform::find($request->userId);
                // dd($userData);
                $userData->username = $request->username;
                $userData->password = $request->password;
                $userData->email = $request->email;
                $userData->phone = $request->phone;
                $userData->dateofbirth = $request->dateofbirth;
                $userData->gender = $request->gender;
                $userData->address = $request->address;
                $userData->declaration = $request->declaration;
                $userData->save();
                if($userData){
                    return response()->json([
                        'code'=>200, 
                        'message'=>'User Updated successfully']);
                }else{
                    return ["Result" => "Update operation failed!!"];
                }   
            }
    }
    public function deleteUser(Request $request){
        //dd($request);
        if(!is_null($request->operation) && $request->operation=='delete'){
            $userData = Userform::find($request->userId);
            $userData->delete();
            if($userData){
                return response()->json([
                    'code'=>200, 
                    'message'=>'User deleted successfully']);
            }else{
                return ["Result" => "Delete operation failed!!"];
            }
        }
    }

}
