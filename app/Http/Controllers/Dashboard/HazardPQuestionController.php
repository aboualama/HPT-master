<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\Support\Facades\Validator;

class HazardPQuestionController extends Controller
{


  public function store(Request $request)
  {
    //  dd($request->all());

    $rules = $this->rules();
    $rules = $rules + ['video' => 'required|mimes:mp4,mov,ogg,qt|max:220000'];
    $messages = $this->messages();
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors(), 'status' => 442]);
    }

    if (request()->hasFile('video')) {
      $public_path = 'uploads/video';
      $video_name = time() . '.' . request('video')->getClientOriginalExtension();
      request('video')->move($public_path, $video_name);
    }

    $record = Question::create($request->all());
    $record['video'] = $video_name;
    $record['wrong_answers'] = json_encode($request->answer);
    $record['right_answers'] = json_encode($request->val);
    $record->save();

    return response()->json(['status' => 200]);
  }


  public function update(Request $request, $id)
  {
    /* $rules = $this->rules();

    if (request()->hasFile('video')) {
      $rules = ['video' => 'required|mimes:mp4,mov,ogg,qt|max:220000',];
    }
    $validator = Validator::make($request->all(), $rules);*/
    /* if ($validator->fails()) {
       return response()->json(['errors' => $validator->errors(), 'status' => 442]);
     }*/

    $record = Question::find($id);

    if (request()->hasFile('video')) {
      // if(isset($record->video) && $record->video !== 'demo.mp4'){
      //     unlink('uploads/video/'.$record->video);
      // }
      $video = $request->file('video');
      $public_path = 'uploads/video';
      $video_name = time() . '.' . $video->getClientOriginalExtension();
      $video->move($public_path, $video_name);
    }
    if (isset($video_name)) {
      $record['video'] = $video_name;
    }

    $record['wrong_answers'] = json_encode($request->answer);
    $record['right_answers'] = json_encode($request->val);
    $record->save();
    return response()->json($record);
  }


  // Validation Handle Rules and Messages

  public function rules()
  {
    $basicRule = [
      'type' => 'required|string',
      'val.*' => 'required|numeric',
      'answer.*' => 'required|string',
    ];
    return $basicRule;
  }

  public function messages()
  {
    $basicMessage = [
      'type.required' => __('locale.type required'),
      'type.string' => __('locale.type string'),
      'val.*.required' => __('locale.val required'),
      'val.*.numeric' => __('locale.val numeric'),
      'answer.*.required' => __('locale.answer required'),
      'answer.*.numeric' => __('locale.answer string'),
    ];
    return $basicMessage;
  }

}
