@extends('layouts/contentLayoutMaster')
@section('content')
  <div class="col-md-12 col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">{{__('locale.Edit')}} {{__('locale.result')}} </h4>
      </div>
      <div class="card-content">
        <div class="card-body">


          <form id="formedit" class="form form-horizontal" method="POST"
                action="{{ url('en/result-edit/' ) }}"
                enctype="multipart/form-data">
            @csrf
            {{ method_field('put') }}
            <div class="form-body">
              <div class="row">

                {{--   <input type="hidden" id="url" value="{{ url('en/result-edit/' . $record->id) }}">
                   <input type="hidden" id="result_id" value="{{ $record->id }}">--}}

                @foreach($records as $record)
                  @switch($record->type)
                    @case("Recognation")
                    @case("Risk-Responsibilty")
                    <div class="col-12">
                      <label>{{__('locale.'.$record->type)}}</label>
                      <div class="form-group">
                        <input type="text" class="data form-control" data-id="{{$record->id}}"
                               value="{{$record->point}}">
                      </div>
                    </div>
                    @break
                    @case( "Reaction-SMC")
                    <div class="col-12">
                      <hr>
                    </div>
                    @break
                    @case( "Hazard-Perception")
                    <div class="col-12">
                      <hr>
                    </div>
                    @break
                    @case( "Recognation")
                    <div class="col-12">
                      <hr>
                    </div>
                    @break
                    @default
                  @endswitch
                @endforeach


                <div class="col-12">
                  <button id="edit" type="button" class="btn btn-primary mr-1 mb-1">{{__('locale.Submit')}}</button>
                  <button type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('locale.Reset')}}</button>
                  <button type="reset" class="btn btn-warning mr-1 mb-1"
                          onclick="location.reload()">{{__('locale.Cancel')}}</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection


