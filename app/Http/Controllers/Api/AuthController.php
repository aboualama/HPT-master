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
      $loginData = $request->validate([
          'email' => 'email|required',
          'password' => 'required'
      ]);

      if (!auth()->attempt($loginData)) {
          return response(['message' => 'Invalid Credentials']);
      }

      $accessToken = auth()->user()->createToken('authToken')->accessToken;

      return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }





}
