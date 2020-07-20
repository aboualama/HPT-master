<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(Request $request)
    {
      // dd($request->all());
    	$data = $request->all();
    	$validator = validator()->make($data, [
            'name'               => 'required|min:6',
			      'email'              => 'required|email|unique:users',
            'password'           => 'required|confirmed|min:6|max:60|alpha_num',
    	]);
    	if ($validator->fails())
    	{
        	return response(['message' => 'Invalid Credentials', 'errors' => $validator->errors()]);
    	}
      $request->merge(['password' => bcrypt($request->password)]);
      $record = User::create($request->all());

    	$accessToken = $record->createToken('authToken')->accessToken;

    	$record->save();
      return response([ 'user' => $record, 'access_token' => $accessToken]);
    }





    public function login(Request $request)
    {
      $loginData = validator()->make($request->all(), [
          'email' => 'email|required',
          'password' => 'required'
      ]);

      // $loginData = $request->validate([
      //   'email' => 'email|required',
      //   'password' => 'required'
      // ]);
      // if (!auth()->attempt($loginData)) {
      //     return response(['message' => 'Invalid Credentials']);
      // }

      if ($loginData->fails())
    	{
        	return response(['status' => '440' , 'message' => $loginData->errors()->first() , 'errors' => $loginData->errors()] );
    	}
      $user = User::where('email' , $request->email)->first();
    	if($user)
    	{
    		if(Hash::check($request->password , $user->password))
    			{
            $accessToken = $user->createToken('authToken')->accessToken;
            return response(['status' => '200' , 'message' => 'OK' , 'user' => $user, 'access_token' => $accessToken]);
    			}
    		else
          		{
    				return response(['status' => '440' , 'message' => 'password is wrong'] );
    			}
    	}


    }


    public function logout(Request $request)
    {
        $request->user()->logout();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);

      }




}
