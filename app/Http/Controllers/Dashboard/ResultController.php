<?php



namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Resultmail;
use App\Useranswer;
use Mail;

class ResultController extends Controller
{
  public function index()
  {
    $records = Useranswer::all();
    $breadcrumbs = [
      ['link'=>"/",'name'=>__('locale.home')], ['name'=>__('locale.result')]
    ];
    return view('result.result', [
      'breadcrumbs' => $breadcrumbs,
      'records' => $records
    ]);
  }

  public function send(Request $request)
  {

    $data = $request->all();
    Mail::to($request->email)->send(new Resultmail($data));

  }
}
