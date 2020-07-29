<?php



namespace App\Http\Controllers\Dashboard;

use App\Answer;
use App\Http\Controllers\Controller;

use App\Question;
use App\QuestionTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class RSMCQuestionController extends Controller
{

    public function store(Request $request)
    {
      //  dd($request->all());
      $rules = $this->rules();
      $rules = $rules + ['img_answers.*' => 'required|mimes:jpg,jpeg,png|max:20000',];
      $messages = $this->messages();
      $validator = Validator::make($request->all(), $rules, $messages);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors(), 'status' => 442]);
      }

      $record = new Question();
      $record['type'] = $request->type;
      $record->save();

      foreach(config('translatable.locales') as $lang){
        $data = $request->get($lang);
              $recordQ = new QuestionTranslation();
              $recordQ['locale'] = $lang;
              $recordQ['question'] = $data['question'];
              $recordQ['question_id'] = $record['id'];
              $recordQ->right_answers = json_encode($data['right_answers']);
              $recordQ->wrong_answers = json_encode($data['wrong_answers']);
              $recordQ->save();
      }

      if (request()->hasFile('img_answers'))
      {
        foreach($request->file('img_answers') as $i => $image)
          {
              $public_path = 'uploads/img_answers';
              $img_name = $i . time() . '.' . $image->getClientOriginalExtension();
              $image->move($public_path , $img_name);
              $img[] = $img_name;
          }
      }
      else
      {
        $img[] = 'default.jpg';
      }

      $record['image'] = json_encode($img);
      $record->update();
      return response()->json(['status' => 200]);

    }




    public function update(Request $request,  $id)
    {
      // dd($request->all());
      $rules = $this->rules();
      if (request()->hasFile('img_answers')) {
        $rules = $rules + ['img_answers'   => 'required|array',
                           'img_answers.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                          ];
      }
      $messages = $this->messages();
      $validator = Validator::make($request->all(), $rules, $messages);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors(), 'status' => 442]);
      }
      $old = Question::find($id);
      $old->delete();
      $record = new Question();
      $record['type'] = $request->type;
      $record->save();

      foreach(config('translatable.locales') as $lang){
        $data = $request->get($lang);
            $recordQ = new QuestionTranslation();
            $recordQ['locale'] = $lang;
            $recordQ['question'] = $data['question'];
            $recordQ['question_id'] = $record['id'];
            $recordQ->right_answers = json_encode($data['right_answers']);
            $recordQ->wrong_answers = json_encode($data['wrong_answers']);
            $recordQ->save();
      }

      $img = [];
      $index = count($request->en['right_answers']);

      for($i = 0 ; $i < $index ; $i++)
      {
        if (isset($request->file('img_answers')[$i])) {
            $image = $request->file('img_answers')[$i];
            $public_path = 'uploads/img_answers';
            $img_name = $i . time() . '.' . $image->getClientOriginalExtension();
            $image->move($public_path , $img_name);
            $img[] = $img_name;
        }
        else {
            $img[] = json_decode($old->image)[$i];
        }
      }
      $record['image'] = json_encode($img);
      $record->update();
      return response()->json($record);
    }



    public function destroy($id)
    {
      $record = Question::find($id);
      $record->delete();
    }




  // Validation Handle Rules and Messages

  public function rules()
  {
    $basicRule = [
      'type'     => 'required|string',
    ];
    $transRule = [];
    foreach (config('translatable.locales') as $locale) {
      $transRule = $transRule + [
        $locale . '.question'  => 'required|string|min:3|max:260',
        $locale . '.right_answers.*'  => 'required|string',
        $locale . '.wrong_answers.*'  => 'required|string',
      ];
    }
    return $basicRule + $transRule;
  }

  public function messages()
  {
    $basicMessage =  [
      'type.required' => __('locale.type required'),
      'type.string'   => __('locale.type string'),
    ];
    $transMessage  = [];
    foreach (config('translatable.locales') as $locale) {
      $transMessage = $transMessage + [
        $locale . '.question.required'          => __('locale.' . $locale . '.question required'),
        $locale . '.question.string'            => __('locale.' . $locale . '.question string'),
        $locale . '.question.min'               => __('locale.' . $locale . '.question min'),
        $locale . '.question.max'               => __('locale.' . $locale . '.question max'),
        $locale . '.right_answers.*.required'   => __('locale.' . $locale . '.right_answers required'),
        $locale . '.right_answers.*..string'    => __('locale.' . $locale . '.right_answers string'),
        $locale . '.wrong_answers.*.required'   => __('locale.' . $locale . '.wrong_answers required'),
        $locale . '.wrong_answers.*..string'    => __('locale.' . $locale . '.wrong_answers string'),
      ];
    }
    return  $transMessage + $basicMessage;
  }
}
