<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\LicenseRequest;
use App\Mail\Resultmail;
use App\User;
use Carbon\Carbon;
use App\Licensecode;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
  use VerifiesEmails;

  public function register(Request $request)
  {
    //  dd($request->all());
    $data = $request->all();
    $validator = validator()->make($data, [
      'name' => 'required|min:3',
      'email' => 'required|email|unique:users',
      'password' => 'required|confirmed|min:6|max:60|alpha_num',
      'lastName' => 'required|string', // dah na2s mesh beyegy fel request
   //   'cell' => 'required', //tmam ?
    //  'cf' => 'required|string',
      'role' => 'required|string',
    ]);
    if ($validator->fails()) {
      return response(['message' => 'Invalid Credentials', 'errors' => $validator->errors(), 'status' => "440"], 200);
    }
    $request->merge(['password' => bcrypt($request->password)]);
    $record = User::create($request->all());
    $accessToken = $record->createToken('authToken')->accessToken;
    $record->save();
    $record->sendApiEmailVerificationNotification();
    return response(['user' => $record, 'access_token' => $accessToken]);
  }


  public function login(Request $request)
  {
    $loginData = validator()->make($request->all(), [
      'email' => 'email|required',
      'password' => 'required'
    ]);

    if ($loginData->fails()) {
      return response(['status' => '440', 'message' => $loginData->errors()->first(), 'errors' => $loginData->errors()]);
    }

    $user = User::where('email', $request->email)->first();

    if ($user && $user->email_verified_at !== NULL) {
      if (Hash::check($request->password, $user->password)) {
        return response(['status' => '200', 'message' => 'OK', 'user' => $user]);
      } else {
        return response(['status' => '440', 'message' => 'password is wrong']);
      }
    } else {
      return response()->json(['status' => '401', 'message' => 'Unauthorised']);
    }


  }


  public function logout(Request $request)
  {
    $request->user()->logout();
    return response()->json([
      'message' => 'Successfully logged out'
    ]);

  }

  public function requestLicense(Request $request)
  {

    $user = User::find($request->user_id);
    $user->number = $request->number;
    $users = User::where('role', '=', 'admin')->get();
    $user->to = User::all();
    foreach ($users as $us){
      Mail::to($us->email)->send(new LicenseRequest($user));
    }



  }

  public function checklicens(Request $request)
  {
    $data = validator()->make($request->all(), [
      'user_id' => 'required',
      'code' => 'required'
    ]);

    $user = User::find($request->user_id);
    if ($data->fails()) {
      return response(['status' => '440', 'message' => $data->errors()->first(), 'errors' => $data->errors()]);
    }
    $licens = Licensecode::where('user_id', $request->user_id)->pluck('code')->toArray();
    $licens_id = Licensecode::where('code', $request->code)->pluck('id');
    // dd($licens);
    if ($licens) {
      if (in_array($request->code, $licens)) {
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['status' => '200', 'message' => 'OK', 'licens_id' => $licens_id, 'access_token' => $accessToken]);
      } else {
        return response(['status' => '440', 'message' => 'licens code is wrong']);
      }
    }
  }


}
