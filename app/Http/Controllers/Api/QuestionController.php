<?php



namespace App\Http\Controllers\Api;

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


  public function getquestions($type , $locale = 'it')
  {
    \App::setLocale($locale);

    $record = Question::where('type' , $type)->with('answers')->get()->toArray();
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
    // dd($request->all());
    $record = new Useranswer;
    $record->user_id = $request->get('user_id');
    $record->License_id = $request->get('licens_id');
    $record->question_id = 256;
    $record->isRight = true;
    $record->answer = json_encode($request->answer);
    $record->point = 0;
    $record->save();
    return response($record, 200);
  }



}
