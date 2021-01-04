<?php



namespace App\Http\Controllers\Dashboard;

use App\Answer;
use App\Group;
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
      $rules = $this->rules();
      $rules = $rules + ['img_answers' => 'required', 'img_answers.*' => 'mimes:jpg,jpeg,png|max:20000',];
      $messages = $this->messages();
      $validator = Validator::make($request->all(), $rules, $messages);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors(), 'status' => 442]);
      }
      $index = count($request->en['right_answers']);

      $group = new Group;
      $group->save();

      for($i = 0 ; $i < $index ; $i++)
      {

        $record = new Question();
        $record['type'] = $request->type;
        $record['group_id'] = $group->id;
        $record->save();

        if (isset($request->file('img_answers')[$i])) {
            $image = $request->file('img_answers')[$i];
            $public_path = 'uploads/image';
            $img_name = $i . time() . '.' . $image->getClientOriginalExtension();
            $image->move($public_path , $img_name);
            $img = $img_name;
        }
        else {
            $img = 'default.jpg';
        }

      foreach(config('translatable.locales') as $lang){
        $data = $request->get($lang);
          $recordQ = new QuestionTranslation();
          $recordQ['locale']      = $lang;
          $recordQ['question']    = $data['question'];
          $recordQ['title']       = $data['title'];
          $recordQ['question_id'] = $record['id'];
          $recordQ->right_answers = $data['right_answers'][$i];
          $recordQ->wrong_answers = json_encode($data['wrong_answers']);
          $recordQ->save();
      }

        $record['image'] = $img;
        $record->update();
      }

      return response()->json(['status' => 200]);
    }




    public function update(Request $request,  $id)
    {
      //  dd($request->all());
      $old       = Question::find($id);
      $old_group = $old->group_id;
      $old_img[0]   = $old->image;

      $rules = $this->rules();
      $rules = $rules + ['img_answers' => 'required', 'img_answers.*' => 'mimes:jpg,jpeg,png|max:20000',];
      $messages  = $this->messages();
      $validator = Validator::make($request->all(), $rules, $messages);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors(), 'status' => 442]);
      }

      $index = count($request->en['right_answers']);
      for($i = 0 ; $i < $index ; $i++)
      {
        $record = new Question();
        $record['type'] = $request->type;
        $record['group_id'] = $old_group;
        $record->save();

        if (isset($request->file('img_answers')[$i])) {
            $image = $request->file('img_answers')[$i];
            $public_path = 'uploads/image';
            $img_name = $i . time() . '.' . $image->getClientOriginalExtension();
            $image->move($public_path , $img_name);
            $img = $img_name;
        }
        else {
            $img = $old_img[$i];
        }

      foreach(config('translatable.locales') as $lang){
            $data                   = $request->get($lang);
            $recordQ                = new QuestionTranslation();
            $recordQ['locale']      = $lang;
            $recordQ['question']    = $data['question'];
            $recordQ['title']       = $data['title'];
            $recordQ['question_id'] = $record['id'];
            $recordQ->right_answers = $data['right_answers'][$i];
            $recordQ->wrong_answers = json_encode($data['wrong_answers']);
            $recordQ->save();
      }

        $record['image'] = $img;
        $record->update();
      }

      $record->update();
      $old->delete();
      return response()->json($record);
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
        $locale . '.question'        => 'required|string|min:3|max:260',
        $locale . '.title'           => 'required|string|min:3|max:260',
        $locale . '.right_answers.*' => 'required|string',
        $locale . '.wrong_answers.*' => 'required|string',
      ];
    }
    return $basicRule + $transRule;
  }

  public function messages()
  {
    $basicMessage =  [
      'type.required' => __('locale.type required'),
      'type.string'   => __('locale.type string'),
      'img_answers.required' => __('locale.img_answers required'),

    ];
    $transMessage  = [];
    foreach (config('translatable.locales') as $locale) {
      $transMessage = $transMessage + [
        $locale . '.question.required'        => __('locale.' . $locale . '.question required'),
        $locale . '.question.string'          => __('locale.' . $locale . '.question string'),
        $locale . '.question.min'             => __('locale.' . $locale . '.question min'),
        $locale . '.question.max'             => __('locale.' . $locale . '.question max'),
        $locale . '.title.required'           => __('locale.' . $locale . '.title required'),
        $locale . '.title.string'             => __('locale.' . $locale . '.title string'),
        $locale . '.title.min'                => __('locale.' . $locale . '.title min'),
        $locale . '.title.max'                => __('locale.' . $locale . '.title max'),
        $locale . '.right_answers.*.required' => __('locale.' . $locale . '.right_answers required'),
        $locale . '.right_answers.*.string'   => __('locale.' . $locale . '.right_answers string'),
        $locale . '.wrong_answers.*.required' => __('locale.' . $locale . '.wrong_answers required'),
        $locale . '.wrong_answers.*.string'   => __('locale.' . $locale . '.wrong_answers string'),
      ];
    }
    return  $transMessage + $basicMessage;
  }

}













    // by group id
    // public function update(Request $request,  $id)
    // {
    //     // dd($request->all());
    //   $old = Question::find($id);
    //   $oldgroup = Group::find($old->group_id);
    //   $old_img = Question::where('group_id' , $oldgroup->id)->pluck('image');

    //   $group = new Group;
    //   $group->type = 'question';
    //   $group->save();

    //   $rules = $this->rules();
    //   $messages = $this->messages();
    //   $validator = Validator::make($request->all(), $rules, $messages);
    //   if ($validator->fails()) {
    //     return response()->json(['errors' => $validator->errors(), 'status' => 442]);
    //   }


    //   $index = count($request->en['right_answers']);


    //   for($i = 0 ; $i < $index ; $i++)
    //   {
    //     $record = new Question();
    //     $record['type'] = $request->type;
    //     $record['group_id'] = $group->id;
    //     $record->save();

    //     if (isset($request->file('img_answers')[$i])) {
    //         $image = $request->file('img_answers')[$i];
    //         $public_path = 'uploads/image';
    //         $img_name = $i . time() . '.' . $image->getClientOriginalExtension();
    //         $image->move($public_path , $img_name);
    //         $img = $img_name;
    //     }
    //     else {
    //         $img = $old_img[$i];
    //     }

    //   foreach(config('translatable.locales') as $lang){
    //         $data                   = $request->get($lang);
    //         $recordQ                = new QuestionTranslation();
    //         $recordQ['locale']      = $lang;
    //         $recordQ['question']    = $data['question'];
    //         $recordQ['title']       = $data['title'];
    //         $recordQ['question_id'] = $record['id'];
    //         $recordQ->right_answers = $data['right_answers'][$i];
    //         $recordQ->wrong_answers = json_encode($data['wrong_answers']);
    //         $recordQ->save();
    //   }

    //     $record['image'] = $img;
    //     $record->update();
    //   }

    //   $record->update();
    //   $oldgroup->delete();
    //   return response()->json($record);
    // }
