<?php


namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Resultmail;
use App\Useranswer;
use File;
use Illuminate\Support\Facades\Storage;
use Mail;
use Response;
use Spatie\ArrayToXml\ArrayToXml;
use View;

class ResultController extends Controller
{
  public function index()
  {
    $records = Useranswer::all();
    $breadcrumbs = [
      ['link' => "/", 'name' => __('locale.home')], ['name' => __('locale.result')]
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

  public function convert($id)
  {
    header('Content-type: text/xml');
   // $headers = ['Content-Type' => 'application/pdf',];
    $data = Useranswer::find($id)->toArray();
    $result = ArrayToXml::convert(json_decode($data['answer'], true));

    $public_path = 'uploads/file/';
    $file_name = 'Result_' . $id . '.xml';
    File::put($public_path . $file_name, $result);
    $file_path = public_path('uploads/file/' . $file_name);
    return Response::download($file_path, $file_name);

  }
}
