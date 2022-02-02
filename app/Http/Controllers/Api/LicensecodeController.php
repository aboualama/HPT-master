<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Licensecode;
use Illuminate\Http\Request;


class LicensecodeController extends Controller
{


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
    $licens = Licensecode::where('user_id' , $request->user_id)->pluck('code')->toArray();
    $licens_id = Licensecode::where('code' , $request->code)->pluck('id');
    if($licens)
    {
      if(in_array($request->code , $licens))
      {
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['status' => '200' , 'message' => 'OK' , 'licens_id' => $licens_id , 'access_token' => $accessToken]);
      }
      else
      {
        return response(['status' => '440' , 'message' => 'licens code is wrong']);
      }
    }
  }



  public function LicenseInactive($id)
  {
    $record = Licensecode::find($id)->update(['active' => '0']);
    return response()->json($record);
  }

}
