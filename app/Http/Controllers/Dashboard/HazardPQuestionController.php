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
    // dd($request->all());
    $rules = ['video' => 'required|mimes:mp4,mov,ogg,qt|max:220000',];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors(), 'status' => 442]);
    }

    if (request()->hasFile('video'))
    {
        $public_path = 'uploads/video';
        $video_name = time() . '.' . request('video')->getClientOriginalExtension();
        request('video')->move($public_path , $video_name);
    }

    $record = Question::create($request->all());
    $record['video'] = $video_name;
    $record->save();

    return response()->json(['status' => 200]);
  }


  public function update(Request $request,  $id)
  {

    if (request()->hasFile('video')) {
      $rules = ['video' => 'required|mimes:mp4,mov,ogg,qt|max:220000',];
    }
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors(), 'status' => 442]);
    }

    $record = Question::find($id) ;

    if (request()->hasFile('video'))
    {
      // if(isset($record->video) && $record->video !== 'demo.mp4'){
      //     unlink('uploads/video/'.$record->video);
      // }
        $video =  $request->file('video');
        $public_path = 'uploads/video';
        $video_name = time() . '.' . $video->getClientOriginalExtension();
        $video->move($public_path , $video_name);
    }

    $record['video'] = $video_name;
    $record->save();
    return response()->json($record);
  }
}
