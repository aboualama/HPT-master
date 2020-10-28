<?php


namespace App\Http\Controllers\Api;

use App;
use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Qtype;
use App\Useranswer;

use function PHPSTORM_META\type;

class QuestionController extends Controller
{

  public function getAllQuestions()
  {
    $record = Question::with('answers')->get()->toArray();
    return response($record, 200);
  }


  public function getQuestionEntro($type, Request $request)
  {
    // App::setLocale($request->get("lang"));
    $record = Qtype::where('type', $type)->listsTranslations('entro')->get();
    dd($record);
    return response($record, 200);
  }





  public function getquestions($type, Request $request)
  {
    // return  dd($request);
    App::setLocale($request->get("lang"));


    $record = Question::where('type', $type)->with('answers')->get()->toArray();
    // $record = Question::where('type' , $type)->withTranslation()->with('answers')->get()->toArray();
    // dd(Question::listsTranslations('id')->get()->toArray());
    return response($record, 200);
  }

  public function getanswers()
  {
    $record = Answer::listsTranslations('answer')->select('question_id', 'value_1', 'answer')->get();
    return response($record, 200);
  }


  public function storanswers(Request $request)
  {
    //return dd($request->all());
    $record = new Useranswer();

    $record->user_id = $request->get('user_id');
    $record->License_id = $request->get('licens_id');
    $record->question_id = 1;
    $record->isRight = true;
    $record->answer = json_encode($request->answer);
    $record->point = 0;

    //return dd($record);
    $record->save();
    return response($record, 200);
  }

  public function updateanswers(Request $request)
  {
    //dump($request->get('answer'));


    $record = Useranswer::where('License_id', '=', $request->get('licens_id'))->first();

    $answerToattach = $request->get('answer');
    if ($record) {
      $ansers = json_decode($record->answer, true);
      if (isset($answerToattach["Recognation"]))
        $ansers['Recognation'] = $answerToattach["Recognation"];
      if (isset($answerToattach['Reaction-simple']))
        $ansers['Reaction-simple'] = $answerToattach["Reaction-simple"];
      if (isset($answerToattach["Reaction-complex"]))
        $ansers['Reaction-complex'] = $answerToattach["Reaction-complex"];
      if (isset($answerToattach["Reaction-SMC"]))
        $ansers['Reaction-SMC'] = $answerToattach["Reaction-SMC"];
      if (isset($answerToattach["Hazard-Perception"]))
        $ansers['Hazard-Perception'] = $answerToattach["Hazard-Perception"];
      if (isset($answerToattach["Risk-Responsibilty"])) {
        $ansers['Risk-Responsibilty'] = $answerToattach["Risk-Responsibilty"];
        $lisence = App\Licensecode::find($request->get('licens_id'));
      //  dump($lisence);
        $lisence->active = 0;
        $lisence->save();
      }

    } else {
      $record = new Useranswer();
      $ansers = $answerToattach;
    }
    //   return dd($ansers);

    $record->answer = json_encode($ansers);
    $record->user_id = $request->get('user_id');
    $record->License_id = $request->get('licens_id');
    $record->question_id = 1;
    $record->isRight = true;
    $record->point = 0;

    //return dd($record);
    $record->save();
    //return   dd($record);
    return response($record, 200);
  }


  function getResultByLisence(Request $request)
  {
    $id = $request->get('id');

    $record = Useranswer::firstWhere("License_id", '=', $id);

    $ret = null;
    if ($record && $record->answer)
    {
      $ansers = json_decode($record->answer, true);
      if (isset($ansers["Hazard-Perception"]) && count($ansers["Hazard-Perception"])>0)
        $ret = 'Hazard-Perception';
      else if (isset($ansers["Reaction-SMC"]) && count($ansers["Reaction-SMC"])>0)
        $ret = 'Reaction-SMC';
      else if (isset($ansers["Reaction-complex"]) && count($ansers["Reaction-complex"])>0)
        $ret = 'Reaction-complex';
      else if (isset($ansers['Reaction-simple']) && count($ansers['Reaction-simple'])>0)
        $ret = 'Reaction-simple';
      else if (isset($ansers["Recognation"]) && count($ansers["Recognation"])>0)
        $ret = "Recognation";
    }



    //$answer = json_decode($record->answer);
    return response(\GuzzleHttp\json_encode(["question" => $ret]), 200);
  }

}
