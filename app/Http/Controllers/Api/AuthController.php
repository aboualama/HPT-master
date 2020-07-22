<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use App\Licensecode;
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

      if ($loginData->fails())
    	{
        	return response(['status' => '440' , 'message' => $loginData->errors()->first() , 'errors' => $loginData->errors()] );
    	}
      $user = User::where('email' , $request->email)->first();
    	if($user)
    	{
    		if(Hash::check($request->password , $user->password))
    			{
            return response(['status' => '200' , 'message' => 'OK' , 'user' => $user]);
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



  public function checklicens(Request $request)
  {
    $data = validator()->make($request->all(), [
      'user_id'   => 'required',
      'code'      => 'required'
    ]);

    $user = User::find($request->user_id);
    if ($data->fails())
    {
      return response(['status' => '440' , 'message' => $data->errors()->first() , 'errors' => $data->errors()] );
    }
    $licens = Licensecode::where('user_id' , $request->user_id)->first();

    if($licens)
    {
      if($licens->code == $request->code)
      {
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['status' => '200' , 'message' => 'OK' , 'access_token' => $accessToken]);
      }
      else
      {
        return response(['status' => '440' , 'message' => 'licens code is wrong']);
      }
    }
  }


}
