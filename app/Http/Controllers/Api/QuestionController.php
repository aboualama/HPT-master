<?php


namespace App\Http\Controllers\Api;

use App;
use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Useranswer;

use function PHPSTORM_META\type;

class QuestionController extends Controller
{

  public function getAllQuestions()
  {
    $record = Question::with('answers')->get()->toArray();
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


    $record = Useranswer::where('License_id','=',$request->get('licens_id'))->first();



    $ansers = json_decode($record->answer,true);
    $answerToattach = $request->get('answer');


    $ansers['Reaction-simple'] = $answerToattach["Reaction-simple"];
 //   return dd($ansers);

    $record->answer = json_encode($ansers);
    $record->user_id = $request->get('user_id');
    $record->License_id = $request->get('licens_id');
    $record->question_id = 1;
    $record->isRight = true;
    $record->point = 0;

    //return dd($record);
    $record->save();
 return   dd($record);
    return response($record, 200);
  }


}
