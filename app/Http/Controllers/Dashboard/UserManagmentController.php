<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\newPassword;
use App\User;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use phpseclib\Crypt\Hash;

class UserManagmentController
{

    // User List Page
    public function index()
    {

      $record = User::all();
      $breadcrumbs = [
        ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"User List"]
      ];
      return view('/usermangment/app-user-list', [
        'breadcrumbs' => $breadcrumbs,
        'record' => $record
      ]);
    }

    // User Show Page
    public function show($id)
    {
      $record = User::find($id);
      $breadcrumbs = [
        ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"User Show"]
      ];
      return view('/usermangment/app-user-view', [
        'breadcrumbs' => $breadcrumbs,
        'user' => $record
      ]);
    }

    // User Edit Page
    public function edit($id)
    {
      $record = User::find($id);
      $breadcrumbs = [
        ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"User Edit"]
      ];
      return view('/usermangment/app-user-edit', [
        'breadcrumbs' => $breadcrumbs,
        'record' => $record
      ]);
    }

    // User Create Page
    // public function create(){
    //   $breadcrumbs = [
    //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"User Create"]
    //   ];
    //   return view('/usermangment/app-user-create', [
    //     'breadcrumbs' => $breadcrumbs
    //   ]);
    // }


  // User Create Page
    public function UpdateOrCreate(Request $request) {
        // dd($request);
        $new = false;
        if ($request->get('id') == null || $request->get('id') == -1 || $request->get('id') == '-1')
        {
            $record = new User();
            $new = true;
        }else
        {
            $record = User::find($request->get('id'));
        }
        $record->userName = $request->get('name');
        $record->name = $request->get('name');
        $record->lastName = $request->get('lastName');
        $record->displayName = $request->get('name');
        $record->referentName = $request->get('name');
        $record->cell = $request->get('cell');
        $record->cf = $request->get('cf');
        $record->address = $request->get('address');
        $record->role = $request->get('role');
        $record->email = $request->get('email');

        if ($new == true){
            $pas =Str::random(8);
            $record->password = bcrypt($pas);
            $record->save();

            // $record->sendEmailVerificationNotification();
            // Mail::to($record)->send(new newPassword($pas));
        }
        $record->save();

        // $record->attachRole('admin');
        $record->syncPermissions($request->permissions);

        // return response($record, 200);
        return response()->json($record);
        // return $record;
    }


    public function delete($id){
        $record = User::find($id);
        $record->delete();


    }
}
