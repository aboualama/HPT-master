<?php



namespace App\Http\Controllers\Dashboard;

use App\Answer;
use App\Http\Controllers\Controller;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    public function index()
    {
      $records = Question::all();
      $breadcrumbs = [
        ['link'=>"/",'name'=>__('locale.home')], ['name'=>__('locale.question')]
      ];
      return view('question.question', [
        'breadcrumbs' => $breadcrumbs,
        'records' => $records
      ]);
    }


    public function getaddform(Request $request)
    {
        $type =  $request->type;
        $page = 'question.' . $request->type;
        return view($page, compact('type'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
      $rules = $this->rules();
      $rules = $rules + ['video' => 'required|mimes:mp4,mov,ogg,qt|max:220000',];
      $messages = $this->messages();
      $validator = Validator::make($request->all(), $rules, $messages);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors(), 'status' => 442]);
      }

      if (request()->hasFile('video'))
      {
          $public_path = 'uploads/videos';
          $video_name = time() . '.' . request('video')->getClientOriginalExtension();
          request('video')->move($public_path , $video_name);
      }else
      {
          $video_name = 'default.mp4';
      }

      $request['video'] = $video_name;
      $record = Question::create($request->all());
      return response()->json(['status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }


    public function edit($id)
    {
      $record = Question::find($id);
      $type = $record->type;
      $answers = Answer::where('question_id' , $id)->get();
      $breadcrumbs = [
        ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Edit Question "]
      ];
      return view('question.edit.'.$type, [
        'breadcrumbs' => $breadcrumbs,
        'type' => $type,
        'record' => $record,
        'answers' => $answers
      ]);
    }


    public function update(Request $request,  $id)
    {
      $rules = $this->rules();
      if (request()->hasFile('video')) {
        $rules = $rules + ['video' => 'required|mimes:mp4,mov,ogg,qt|max:220000',];
      }
      $messages = $this->messages();
      $validator = Validator::make($request->all(), $rules, $messages);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors(), 'status' => 442]);
      }

      $record = Question::find($id) ;

      if (request()->hasFile('video'))
      {
          $public_path = 'uploads/videos';
          $video_name = time() . '.' . request('video')->getClientOriginalExtension();
          request('video')->move($public_path , $video_name);
      }else
      {
          $video_name = $record->video;
      }

      $request['video'] = $video_name;
      $record->update($request->all());
      return response()->json(['status' => 200]);
    }


    public function destroy($id)
    {
      $record = Question::find($id);
      $record->delete();
    }

    public function getquestions()
    {
      dd(Question::withTranslation()->get()->toArray());
      $p = Question::listsTranslations('id')->get()->toArray();
      $right_answer = $p[2]['translations'] ;

      dd($right_answer);
      dd(Question::listsTranslations('id')->get()->toArray());
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
        $locale . '.question'       => 'required|string|min:3|max:260',
        $locale . '.right_answer' => 'required|string',
        $locale . '.wrongans_1'   => 'required|string',
        $locale . '.wrongans_2'   => 'required|string',
        $locale . '.wrongans_3'   => 'required|string',
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
        $locale . '.question.required'         => __('locale.' . $locale . '.question required'),
        $locale . '.question.string'           => __('locale.' . $locale . '.question string'),
        $locale . '.question.min'              => __('locale.' . $locale . '.question min'),
        $locale . '.question.max'              => __('locale.' . $locale . '.question max'),
        $locale . '.right_answer.*.required'   => __('locale.' . $locale . '.right_answers required'),
        $locale . '.right_answer.*..string'    => __('locale.' . $locale . '.right_answers string'),
        $locale . '.wrongans_1.*.required'     => __('locale.' . $locale . '.wrongans required'),
        $locale . '.wrongans_1.*..string'      => __('locale.' . $locale . '.wrongans string'),
        $locale . '.wrongans_2.*.required'     => __('locale.' . $locale . '.wrongans required'),
        $locale . '.wrongans_2.*..string'      => __('locale.' . $locale . '.wrongans string'),
        $locale . '.wrongans_3.*.required'     => __('locale.' . $locale . '.wrongans required'),
        $locale . '.wrongans_3.*..string'      => __('locale.' . $locale . '.wrongans string'),
      ];
    }
    return  $transMessage + $basicMessage;
  }
}
