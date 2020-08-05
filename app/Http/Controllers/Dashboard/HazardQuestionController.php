<?php


namespace App\Http\Controllers\Dashboard;

use App\Answer;
use App\AnswerTranslation;
use App\Http\Controllers\Controller;

use App\Question;
use App\QuestionTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class HazardQuestionController extends Controller
{

  public function store(Request $request)
  {
    //  dd($request->all());
    $rules = $this->rules();
    $rules = $rules + ['image' => 'required|mimes:jpg,jpeg,png|max:20000', 'video' => 'required|mimes:mp4,mov,ogg,qt|max:220000',];
    $messages = $this->messages();
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors(), 'status' => 442]);
    }

    $record = new Question();
    $record['type'] = $request->type;


    if (request()->hasFile('image'))
    {
        $image =  $request->file('image');
        $public_path = 'uploads/image';
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move($public_path , $image_name);
    }

    if (request()->hasFile('video'))
    {
        $video =  $request->file('video');
        $public_path = 'uploads/video';
        $video_name = time() . '.' . $video->getClientOriginalExtension();
        $video->move($public_path, $video_name);
    }

    $record['image'] = $image_name;
    $record['video'] = $video_name;
    $record->save();

    foreach (config('translatable.locales') as $lang) {
      $data = $request->get($lang);
      $recordQ = new QuestionTranslation();
      $recordQ['locale']      = $lang;
      $recordQ['question']    = $data['question'];
      $recordQ['question_id'] = $record['id'];
      $recordQ->save();
    }

    foreach ($request['en']['answer']  as  $i => $value) {
      $answer = new Answer();
      $answer['question_id'] = $record['id'];
      $answer['value_1']   = $request->ansvalue['value_1'][$i];
      $answer['value_2']   = $request->ansvalue['value_2'][$i];
      $answer['value_3']   = $request->ansvalue['value_3'][$i];
      $answer['value_4']   = $request->ansvalue['value_4'][$i];
      $answer['value_5']   = $request->ansvalue['value_5'][$i];
      $answer->save();

      foreach (config('translatable.locales') as $lang) {
        $data = $request->get($lang);
        $answerTrans = new AnswerTranslation();
        $answerTrans['locale']    = $lang;
        $answerTrans['answer_id'] = $answer['id'];
        $answerTrans['answer']    = $data['answer'][$i];
        $answerTrans->save();
      }
    }
    return response()->json(['status' => 200]);
  }



  public function update(Request $request,  $id)
  {
    // dd($request->all());
    $rules = $this->rules();
    if (request()->hasFile('video')) {
      $rules = $rules + ['video' => 'required|mimes:mp4,mov,ogg,qt|max:220000',];
    }
    $messages = $this->messages();
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors(), 'status' => 442]);
    }

    $old = Question::find($id);
    $old_image = $old->image;
    $old_video = $old->video;
    $old->delete();
    $record = new Question();
    $record['type'] = $request->type;
    $record->save();

    if (request()->hasFile('image'))
    {
      unlink('uploads/image/'. $old_image);
        $image =  $request->file('image');
        $public_path = 'uploads/image';
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move($public_path, $image_name);
    } else {
        $image_name = $old_image;
    }

    if (request()->hasFile('video'))
    {
      unlink('uploads/image/'.$old_video);
        $video =  $request->file('video');
        $public_path = 'uploads/video';
        $video_name = time() . '.' . $video->getClientOriginalExtension();
        $video->move($public_path, $video_name);
    } else
    {
        $video_name = $old_video;
    }

    $record['image'] = $image_name;
    $record['video'] = $video_name;
    $record->save();

    foreach (config('translatable.locales') as $lang) {
      $data = $request->get($lang);
      $recordQ = new QuestionTranslation();
      $recordQ['locale']      = $lang;
      $recordQ['question']    = $data['question'];
      $recordQ['question_id'] = $record['id'];
      $recordQ->save();
    }

    foreach ($request['en']['answer']  as  $i => $value) {
      $answer = new Answer();
      $answer['question_id'] = $record['id'];
      $answer['value_1']   = $request->ansvalue['value_1'][$i];
      $answer['value_2']   = $request->ansvalue['value_2'][$i];
      $answer['value_3']   = $request->ansvalue['value_3'][$i];
      $answer['value_4']   = $request->ansvalue['value_4'][$i];
      $answer['value_5']   = $request->ansvalue['value_5'][$i];
      $answer->save();

      foreach (config('translatable.locales') as $lang) {
        $data = $request->get($lang);
        $answerTrans = new AnswerTranslation();
        $answerTrans['locale']    = $lang;
        $answerTrans['answer_id'] = $answer['id'];
        $answerTrans['answer']    = $data['answer'][$i];
        $answerTrans->save();
      }
    }
    return response()->json(['status' => 200]);
  }



  public function destroy($id)
  {
    $record = Question::find($id);
    unlink('uploads/image/'.$record->image);
    unlink('uploads/video/'.$record->video);
    $record->delete();
  }



  // Validation Handle Rules and Messages

  public function rules()
  {
    $basicRule = [
      'type'                => 'required|string',
      'ansvalue.value_1.*'  => 'required|numeric',
      'ansvalue.value_2.*'  => 'required|numeric',
      'ansvalue.value_3.*'  => 'required|numeric',
      'ansvalue.value_4.*'  => 'required|numeric',
      'ansvalue.value_5.*'  => 'required|numeric',
    ];
    $transRule = [];
    foreach (config('translatable.locales') as $locale) {
      $transRule = $transRule + [
        $locale . '.question'  => 'required|string|min:3|max:260',
        $locale . '.answer.*'  => 'required|string',
      ];
    }
    return $basicRule + $transRule;
  }

  public function messages()
  {
    $basicMessage =  [
      'type.required'                => __('locale.type required'),
      'type.string'                  => __('locale.type string'),
      'ansvalue.value_1.*.required'  => __('locale.value_1 required'),
      'ansvalue.value_1.*.numeric'   => __('locale.value_1 numeric'),
      'ansvalue.value_2.*.required'  => __('locale.value_2 required'),
      'ansvalue.value_2.*.numeric'   => __('locale.value_2 numeric'),
      'ansvalue.value_3.*.required'  => __('locale.value_3 required'),
      'ansvalue.value_3.*.numeric'   => __('locale.value_3 numeric'),
      'ansvalue.value_4.*.required'  => __('locale.value_4 required'),
      'ansvalue.value_4.*.numeric'   => __('locale.value_4 numeric'),
      'ansvalue.value_5.*.required'  => __('locale.value_5 required'),
      'ansvalue.value_5.*.numeric'   => __('locale.value_5 numeric'),
    ];
    $transMessage  = [];
    foreach (config('translatable.locales') as $locale) {
      $transMessage = $transMessage + [
        $locale . '.question.required'  => __('locale.' . $locale . '.question required'),
        $locale . '.question.string'    => __('locale.' . $locale . '.question string'),
        $locale . '.question.min'       => __('locale.' . $locale . '.question min'),
        $locale . '.question.max'       => __('locale.' . $locale . '.question max'),
        $locale . '.answer.*.required'  => __('locale.' . $locale . '.answer required'),
        $locale . '.answer.*.string'    => __('locale.' . $locale . '.answer string'),
      ];
    }
    return  $transMessage + $basicMessage;
  }

}
