<?php



namespace App\Http\Controllers\Api;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use function PHPSTORM_META\type;

class QuestionController extends Controller
{

    public function getquestions($type)
    {
     $record = Question::where('type' , $type)->with('answers')->get()->toArray();
      // $record = Question::where('type' , $type)->withTranslation()->with('answers')->get()->toArray();
        // dd($record);
      return response($record, 200);
      //return response($record, 200);
      // dd($right_answer);
      // $right_answer = $p[2]['translations'] ;
      // dd(Question::withTranslation()->get()->toArray());
      // dd(Question::listsTranslations('id')->get()->toArray());
    }
}
