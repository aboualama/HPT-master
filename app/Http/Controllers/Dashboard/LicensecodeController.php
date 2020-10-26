<?php

namespace App\Http\Controllers\Dashboard;

use App\Group;
use App\Http\Controllers\Controller;
use App\User;
use App\Licensecode;
use App\Mail\License;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;

class LicensecodeController extends Controller
{
  public function index()
  {
    $records['users'] = User::all();

    // $records['licenses'] = Licensecode::all();
    $records['group'] = Group::where('type', 'licensecode')->get();




   // dd($records['licenses']);
    $breadcrumbs = [
      ['link' => "dashboard-analytics", 'name' => "Home"], ['link' => "dashboard-analytics", 'name' => "Pages"], ['name' => "Licensecode "]
    ];
    return view('/licensecode/app-licensecode-list', [
      'breadcrumbs' => $breadcrumbs,
      'records' => $records
    ]);
  }


  public function show($id)
  {
    $records = licensecode::where('group_id', $id)->get();

    return view('licensecode.show', ['records' => $records]);
  }



  public function store(Request $request)
  {
    $user = User::find($request->user_id);

    $group = new Group;
    $group->type = 'licensecode';
    $group->save();

    $data = $this->validate(request(), [
      'user_id' => 'required',
    ]);

    for($i = 0 ; $i < $request->number ; $i++){
      $data['code'] = Str::random(5);
      $data['group_id'] = $group->id;
      $record = Licensecode::create($data);
    }

    $License = Licensecode::where('group_id' , $group->id)->pluck('code');

   // Mail::to($user->email)->send(new License($License, $user));

    return response()->json($record);

  }



  public function sendLicense(Request $request)
  {
    $user = User::find($request->user_id);

    $License = Licensecode::where('group_id' , $request->id)->pluck('code');

    Mail::to($user->email)->send(new License($License, $user));

    return response()->json($License);

  }


  public function delete($id){
    $record = Group::find($id);
    $record->delete();

  }


















  // public function updateOrCreate(Request $request)
  // {
  //   $record = Licensecode::create(
  //     ['user_id' => $request->get('user_id'),'code' => Str::random(5)]
  //   );

  //   return response()->json($record);
  // }

}
