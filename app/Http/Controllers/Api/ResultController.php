<?php


namespace App\Http\Controllers\Dashboard;

use App\Exports\ResultExport;
use App\Exports\resultSheets;
use App\Licensecode;
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
    $records = Useranswer::whereHas('licensecode', function ($query) {
      return $query->where('active', '=', 0);
    })->get();
    //  dd($records->toArray());
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

  public function getResultByLicenceCode(Request $request)
  {

    $answer = Useranswer::where('License_id', '=', $request->get('lisenceId'))->get();

    if ($answer)
      return $this->generateResult($answer[0]->id);

    return $answer->toArray();
    $license = $request->get('lisenceId');
    if (!$license)
      return null;
    //  $lisenceRow= Licensecode::find($license)->first();
    $answer = Useranswer::where('License_id', '=', $license)->first();
    return $answer;

  }

  public function getResultByLicenceCodeId($id)
  {


    $answer = Useranswer::where('License_id', '=', $id)->get();

    if ($answer)
      return $this->generateResult($answer[0]->id);

    return $answer->toArray();
    $license = $id;
    if (!$license)
      return null;
    //  $lisenceRow= Licensecode::find($license)->first();
    $answer = Useranswer::where('License_id', '=', $license)->first();
    return $answer;

  }

  public function generateResult($id)
  {

    $result = Useranswer::find($id);
    $user = $result->user;
    // dd($user->toArray());
    $excel["user"] = [];
    $excel["user"]["data"][] = ["Nome", $user->name];
    $excel["user"]["data"][] = ["Cognome", $user->lastName];
    $excel["user"]["data"][] = ["Sesso", $user->gender];
  //  $excel["user"]["data"][] = ["CF/P.Iva", $user->cf];
   // $excel["user"]["data"][] = ["Cell", $user->cell];
   // $excel["user"]["data"][] = ["Indirizzo", $user->tipoPatente];
    //$excel["user"]["data"][] = ["Tipo Patente", $user->tipoPatente];
    $excel["user"]["data"][] = ["Data di nascità", $user->birthDate];
    $excel["user"]["data"][] = ["Anni di guida", $user->driveYear];
    $result = json_decode($result->answer, true);
    $evaluation = ResultEvalutation::all();

    /*  dd($result);*/
    foreach ($result as $key => $res) {
      switch ($key) {
        case "Recognation":
          $total = 0;
          $excel["Recognation"]["heading"] = ["Domanda", "Punteggio"];
          foreach ($res as $reco) {
            $evaluation = ResultEvalutation::where('type', '=', 'Recognation')->first();
            $poi = $reco['correct']['correct'] ? 1 * $evaluation->point : 0;
            $excel["Recognation"]["data"][] = [$reco["question"]['question'], $poi ? $poi : '0'];
            $total = $total + $poi;
          }
          $excel["Recognation"]["data"][] = ["TOTALE", $total ? $total : '0'];
          break;
        case "Risk-Responsibilty":
          $total = 0;
          $excel["Risk-Responsibilty"]["heading"] = ["Domanda", "Punteggio"];
          foreach ($res as $reco) {
            $evaluation = ResultEvalutation::where('type', '=', 'Risk-Responsibilty')->first();
            $poi = $reco['correct']['correct'] ? 1 * $evaluation->point : 0;
            $excel["Risk-Responsibilty"]["data"][] = [$reco["question"]['question'], $poi ? $poi : '0'];
            $total = $total + $poi;
          }
          $excel["Risk-Responsibilty"]["data"][] = ["TOTALE", $total ? $total : '0'];
          break;
        case "Hazard-Perception":
          // dd($res);
          $info = [];

          foreach ($res as $index => $reco) {
            $total = 0;
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
              $pericoli = [];
              $pericoli = json_decode($question['wrong_answers']);
              // $pericoli = json_decode($question['right_answers']);

              foreach ($pericoli as $key_right => $right) {
                try {
                  $points = 0;
                  $m = [];
                  $m[] = $right->answer;
                  $m[] = $right->val;
                  $rightVal = $right->val;
                  $risposta = "Miss";
                }catch (\Exception $e) {
               //   dd($right);
                  throw $e;
                  // return $right;
                }
                foreach ($reco['correct'] as $k => $pressed) {
                  sscanf($pressed, "%d:%d", $minutes, $seconds);
                  $time_seconds = $minutes * 60 + $seconds;
                  try {

                    if ($rightVal)
                      $rightVal = str_replace(",", ".", $rightVal);

                    if ($time_seconds >= $rightVal && $time_seconds <= number_format($rightVal + 2) && $rightVal != null) {
                      $points = $points + $evaluation->point - round($rightVal + 2 - $time_seconds, 2);
                      //  dump([$right,$index,$points,round($right + 2 - $time_seconds, 2)]);
                      $risposta = $pressed;
                      unset($reco['right_answers'][$k]);
                      continue;
                    }
                  } catch (\Exception $e) {
                    dump($right);
                    throw $e;
                    // return $right;
                  }
                }
                $m[] = $risposta;
                $m[] = $points ? $points : "0";
                $total = $total + $points;
                $points = 0;
                $excel["Hazard-Perception" . ($index + 1)]["data"][] = [$m];

              }
              $excel["Hazard-Perception" . ($index + 1)]["data"][] = ["TOTALE", "", "", $total ? $total : "0"];
            }
            //  dump($points, $reco);
            // $evaluation = ResultEvalutation::where('type', '=', 'Reaction-SMC')->first();


          }
          //  dd($excel);
          break;

        case "Reaction-SMC":
          $excel["Reaction-SMC"]["heading"] = ["Domanda", "Punteggio"];
          $totale = 0;
          foreach ($res as $reco) {
            $l = collect($reco['correct']);
            $total = $l->count();
            $correctAnswers = $l->filter(function ($f) {
              return $f['correct'] == true;
            })->count();
            $punteggio = ($correctAnswers / $total * $evaluation->point);
            $totale = $totale + $punteggio;
            //      dump("punteggio", $punteggio);
            $evaluation = ResultEvalutation::where('type', '=', 'Reaction-SMC')->first();
            $excel["Reaction-SMC"]["data"][] = [$reco["question"]['question'], $punteggio ? $punteggio : "0"];

          }
          $excel["Reaction-SMC"]["data"][] = ["TOTALE", $totale ? $totale : "0"];
          break;

        case "Reaction-simple":
          $excel["Reaction-simple"]["heading"] = ["Domanda", "Punteggio"];
          $media = 0;
          $mediacount = 0;
          foreach ($res as $index => $reco) {
            if (isset($reco["result"])) {

              $d = explode(':', $reco["result"]);

              $seconds = ($d[0] * 60) + $d[1];
              $mediacount = $mediacount + 1;
            } else {
              $seconds = 0;
            }
            $media = $media + $seconds;
            $excel["Reaction-simple"]["data"][] = [$index + 1, isset($reco["result"]) ? $reco["result"] : "Miss"];
          }
          if ($media) {
            $media = ($media / $mediacount);
            $media = explode('.', $media);

          } else {
            $media = [];
            $media[0] = 0;
            $media[1] = 0;
          }
          $excel["Reaction-simple"]["data"][] = ["MEDIA", $media[0] ? gmdate("i:s", $media[0]) : gmdate("i:s", $media[0]) . "." . $media[1]];
          break;

        case "Reaction-complex":
          $excel["Reaction-complex"]["heading"] = ["Domanda", "Punteggio"];
          $media = 0;
          $mediacount = 0;
          foreach ($res["correct"] as $index => $reco) {
            if (isset($reco["result"])) {

              $d = explode(':', $reco["result"]);

              $seconds = ($d[0] * 60) + $d[1];
              $mediacount = $mediacount + 1;
            } else {
              $seconds = 0;
            }
            $media = $media + $seconds;

            $excel["Reaction-complex"]["data"][] = [$index + 1, isset($reco["result"]) ? $reco["result"] : "MISS"];
          }
          if ($media) {
            $media = ($media / $mediacount);
            $media = explode('.', $media);

          } else {
            $media = [];
            $media[0] = 0;
            $media[1] = 0;

          }
          $excel["Reaction-complex"]["data"][] = ["MEDIA", $media[0] ? gmdate("i:s", $media[0]) : gmdate("i:s", $media[0]) . "." . $media[1]];
          $excel["Reaction-complex"]["data"][] = ["Sbagliato", $res["wrong"]];
          break;
      }
    }
    return $excel;
  }

  public function export($id)
  {
    $excel = $this->generateResult($id);
  //  var_dump($excel);
   // die();
    return \Maatwebsite\Excel\Facades\Excel::download(new resultSheets($excel), $id . ".xlsx");
    //   dd(json_decode($result->answer, true));
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