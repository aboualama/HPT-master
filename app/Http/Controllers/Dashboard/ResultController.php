<?php



namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Result;

class ResultController extends Controller
{
  public function index()
  {
    // $records = Result::all();
    $breadcrumbs = [
      ['link'=>"/",'name'=>__('locale.home')], ['name'=>__('locale.result')]
    ];
    return view('result.result', [
      'breadcrumbs' => $breadcrumbs,
      // 'records' => $records
    ]);
  }

  public function send($id)
  {
    dd($id);

  }
}
