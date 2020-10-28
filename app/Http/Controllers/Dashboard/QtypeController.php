<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Qtype;
use Illuminate\Http\Request;
use Validator;

class QtypeController extends Controller
{

  public $all_type = ['Recognation','Risk-Responsibilty' ,'Reaction-SMC', 'Hazard', 'Hazard-Perception'];


  public function index()
  {
    $record = Qtype::all();
    $breadcrumbs = [
      ['link'=>"/",'name'=>__('locale.home')], ['name'=>__('locale.qtype')]
    ];
    return view('qtype.qtype', [
      'breadcrumbs' => $breadcrumbs,
      'records' => $record
    ]);
  }


  public function create()
  {
    $types = $this->all_type;
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Add Question Type"]
    ];
    return view('qtype.add', [
      'breadcrumbs' => $breadcrumbs,
      'types' => $types,
    ]);
  }

  public function store(Request $request)
  {
     // dd($request->all());
    $rules = $this->rules();
    $messages = $this->messages();
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors(), 'status' => 442]);
    }

    $record = Qtype::create($request->all());
    $record->save();
    return response()->json(['status' => 200]);
  }




  public function edit($id)
  {
    $types = $this->all_type;
    $record = Qtype::find($id);
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Edit Question "]
    ];
    return view('qtype.edit', [
      'breadcrumbs' => $breadcrumbs,
      'types' => $types,
      'record' => $record
    ]);
  }


  public function update(Request $request,  $id)
  {
    $rules = $this->rules();
    $messages = $this->messages();
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors(), 'status' => 442]);
    }
    $record = Qtype::find($id) ;
    $record->update($request->all());
    $record->save();
    return response()->json($record);
  }


  public function destroy($id)
  {
    $record = Qtype::find($id);
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
        $locale . '.title'     => 'required|string|min:3|max:260',
        $locale . '.entro'     => 'required|string|min:3|max:260',
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
        $locale . '.title.required'         => __('locale.' . $locale . '.title required'),
        $locale . '.title.string'           => __('locale.' . $locale . '.title string'),
        $locale . '.title.min'              => __('locale.' . $locale . '.title min'),
        $locale . '.title.max'              => __('locale.' . $locale . '.title max'),
        $locale . '.entro.required'         => __('locale.' . $locale . '.entro required'),
        $locale . '.entro.string'           => __('locale.' . $locale . '.entro string'),
        $locale . '.entro.min'              => __('locale.' . $locale . '.entro min'),
        $locale . '.entro.max'              => __('locale.' . $locale . '.entro max'),
      ];
    }
    return  $transMessage + $basicMessage;
  }
}
