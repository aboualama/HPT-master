<?php


namespace App\Http\Controllers\Dashboard;

use App\Exports\ResultExport;
use App\Exports\resultSheets;
use App\Question;
use App\Result;
use App\ResultEvalutation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Resultmail;
use App\Useranswer;
use File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;
use Mail;
use phpDocumentor\Reflection\Types\Collection;
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


  public function edit($id)
  {
    $record = Useranswer::find($id);
    $breadcrumbs = [
      ['link' => "dashboard-analytics", 'name' => "Home"], ['link' => "dashboard-analytics", 'name' => "Pages"], ['name' => "Edit Result "]
    ];
    return view('result.edit', [
      'breadcrumbs' => $breadcrumbs,
      'record' => $record,
    ]);
  }


  public function update(Request $request, $id)
  {
    $record = Useranswer::find($id)->answer;
    $record = json_decode($record, true);
    $record2 = $record;

    $result = array_merge($record, ["NEW" => $record2]);
    dd($result);

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

    $public_path = 'uploads/image/';
    $file_name = 'Result_' . $id . '.xml';
    File::put($public_path . $file_name, $result);
    $file_path = public_path('uploads/image/' . $file_name);
    return Response::download($file_path, $file_name);

  }

  public function config()
  {
    $records = ResultEvalutation::all();
    $records->map(function ($record) {
      if ($record->type != "Hazard-Perception")
        return $record;
      $videos = Question::with("answers")->where('type', '=', 'Hazard-Perception')->get();
      $record->videQuestions = $videos;
    });
    // return dd($records->toArray());
    $breadcrumbs = [
      //    ['link' => "dashboard-analytics", 'name' => "Home"], ['link' => "dashboard-analytics", 'name' => "Pages"], ['name' => "Licensecode "]
    ];
    return view('result.config', [
      'breadcrumbs' => $breadcrumbs,
      'records' => $records
    ]);
  }

  public function export($id)
  {

    $result = Useranswer::find($id);
    $result = json_decode($result->answer, true);
    $evaluation = ResultEvalutation::all();

    /*  dd($result);*/
    foreach ($result as $key => $res) {
      switch ($key) {
        case
        "Recognation":
          $excel["Recognation"]["heading"] = ["Domanda", "Punteggio"];
          foreach ($res as $reco) {
            $evaluation = ResultEvalutation::where('type', '=', 'Recognation')->first();

            $excel["Recognation"]["data"][] = [$reco["question"]['question'], $reco['correct']['correct'] ? 1 * $evaluation->point : '0'];

          }
          break;
        case "Hazard-Perception":
          //dd(json_encode($res));
          $info = [];
          foreach ($res as $index => $reco) {
            $info[$index] = [];
            $question = Question::find($reco['questionId'])->toArray();
            $evaluation = ResultEvalutation::where('type', '=', 'Hazard-Perception')->first();
            $excel["Hazard-Perception" . ($index + 1)]["heading"] = ["Pericolo", "Secondo", "Risposta", "Punteggio"];

            $rightMoments = [];
            $points = 0;
            $info[$index]["answers"] = $question;
            // dump($question['right_answers']);
            if (isset($reco['correct'])) {
              $info[$index]["correct"] = $reco['correct'];
              // dump($reco['correct']);
              $pericolo = json_decode($question['wrong_answers']);
              foreach (json_decode($question['right_answers']) as $key_right => $right) {
                $m = [];
                $m[] = $pericolo[$key_right];
                $m[] = $right;
                $risposta = "Miss";
                foreach ($reco['correct'] as $k => $pressed) {
                  sscanf($pressed, "%d:%d", $minutes, $seconds);
                  $time_seconds = $minutes * 60 + $seconds;
                  if ($time_seconds >= $right && $time_seconds <= $right + 2 && $right != null) {
                    $points = $points + $evaluation->point - round($right + 2 - $time_seconds);
                    // dump($points,$right);
                    $risposta = $pressed;
                    unset($reco['right_answers'][$k]);
                  }
                }
                $m[] = $risposta;
                $m[] = $points ? $points : "0";
                $points = 0;
                $excel["Hazard-Perception" . ($index + 1)]["data"][] = [$m];
              }
            }
            //  dump($points, $reco);
            // $evaluation = ResultEvalutation::where('type', '=', 'Reaction-SMC')->first();


          }
        //  dd($excel);
          break;

        case "Reaction-SMC":
          $excel["Reaction-SMC"]["heading"] = ["Domanda", "Punteggio"];
          foreach ($res as $reco) {
            $l = collect($reco['correct']);
            $total = $l->count();
            $correctAnswers = $l->filter(function ($f) {
              return $f['correct'] == true;
            })->count();
            $punteggio = ($correctAnswers / $total * $evaluation->point);
            //      dump("punteggio", $punteggio);
            $evaluation = ResultEvalutation::where('type', '=', 'Reaction-SMC')->first();
            $excel["Reaction-SMC"]["data"][] = [$reco["question"]['question'], $punteggio ? $punteggio : "0"];
          }
          break;

        case "Reaction-simple":
          $excel["Reaction-simple"]["heading"] = ["Domanda", "Punteggio"];
          foreach ($res as $index => $reco) {
            $excel["Reaction-simple"]["data"][] = [$index + 1, isset($reco["result"]) ? $reco["result"] : "Miss"];
          }
          break;

        case "Reaction-complex":
          $excel["Reaction-complex"]["heading"] = ["Domanda", "Punteggio"];
          foreach ($res["correct"] as $index => $reco) {
            $excel["Reaction-complex"]["data"][] = [$index + 1, isset($reco["result"]) ? $reco["result"] : ""];
          }
          $excel["Reaction-complex"]["data"][] = ["Sbagliato", $res["wrong"]];
          break;
      }
    }


    return \Maatwebsite\Excel\Facades\Excel::download(new resultSheets($excel), $id . ".xlsx");
    dd(json_decode($result->answer, true));
    //

    header('Content-type: text/xml');
    // $headers = ['Content-Type' => 'application/pdf',];
    $data = Useranswer::find($id)->toArray();
    $result = ArrayToXml::convert(json_decode($data['answer'], true));

    $public_path = 'uploads/image/';
    $file_name = 'Result_' . $id . '.xml';
    File::put($public_path . $file_name, $result);
    $file_path = public_path('uploads/image/' . $file_name);
    return Response::download($file_path, $file_name);

  }
}
