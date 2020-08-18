<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use App\Licensecode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LicensecodeController extends Controller
{
  public function index()
  {
    $records['users'] = User::all();
    $records['licenses'] = Licensecode::with('user')->get();
   // dd($records['licenses']);
    $breadcrumbs = [
      ['link' => "dashboard-analytics", 'name' => "Home"], ['link' => "dashboard-analytics", 'name' => "Pages"], ['name' => "Licensecode "]
    ];
    return view('/Licensecode/app-licensecode-list', [
      'breadcrumbs' => $breadcrumbs,
      'records' => $records
    ]);
  }

  public function updateOrCreate(Request $request)
  {
    $record = Licensecode::create(
      ['user_id' => $request->get('user_id'),'code' => Str::random(5)]
    );

    return response()->json($record);
  }

  public function store(Request $request)
  {
    $data = $this->validate(request(), [
      'user_id' => 'required',
    ]);

    for($i = 0 ; $i < $request->number ; $i++){
      $data['code'] = Str::random(5);
      $record = Licensecode::create($data);
    }
    return response()->json($record);
  }


  public function delete($id){
    $record = Licensecode::find($id);
    $record->delete();

  }

}
