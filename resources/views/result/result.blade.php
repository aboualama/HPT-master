@extends('layouts/contentLayoutMaster')

@section('title', __('locale.result'))


@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
<style>
  .modal-body {
    max-height: calc(90vh);
    overflow-y: auto;
  }
</style>
@endsection
@section('page-style')
        {{-- Page css files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/plugins/extensions/toastr.css')) }}">
@endsection


@section('content')


@include('partials._errors')


<div id="q-type"></div>




<!-- Table head options start -->
<div class="row" id="table-head">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">{{__('locale.result')}}</h4>

      </div>
      <div class="card-content">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">{{__('locale.User')}}</th>
                <th scope="col">{{__('locale.Licensecode')}}</th>
                <th scope="col">{{__('locale.Date')}}</th>
                <th scope="col">{{__('locale.Action')}}</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                <th scope="row">1</th>
                <td> User </td>
                <td> Licensecode </td>
                <td> Date </td>
                <td>
                  <span class="action-mail" data-id="id1"><i class="feather icon-mail"></i></span>
                </td>
              </tr>

              <tr>
                <th scope="row">1</th>
                <td> User </td>
                <td> Licensecode </td>
                <td> Date </td>
                <td>
                  <span class="action-mail" data-id="id2"><i class="feather icon-mail"></i></span>
                </td>
              </tr>

              <tr>
                <th scope="row">1</th>
                <td> User </td>
                <td> Licensecode </td>
                <td> Date </td>
                <td>
                  <span class="action-mail" data-id="id3"><i class="feather icon-mail"></i></span>
                </td>
              </tr>

              {{-- @if(isset($records))
                @foreach ($records as $i => $record)
                <tr>
                  <th scope="row">{{$i +1}}</th>
                  <td>{{$record->type}}</td>
                  <td id="question_{{$record->id}}">{{$record->question}}</td>
                  <td id="question_{{$record->id}}">{{$record->question}}</td>
                  <td>
                    <span class="action-mail" data-id="{{$record->id}}"><i class="feather icon-mail"></i></span>
                  </td>
                </tr>
                @endforeach
              @endif --}}

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Table head options end -->







@endsection


@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')

<!-- Page js files -->


<script src="{{ asset(mix('js/scripts/forms/select/form-select2.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>
<script src="{{ asset('js/scripts/ui/mail.js') }}"></script>


<script>








  // $(document).on('click', '#submit', function (e) {
  //           e.preventDefault();
  //           $(".small_error").text('');
  //           var url = $("#url").val();
  //           var formData = new FormData($('#form')[0]);

  //           $.ajax({
  //               type: 'post',
  //               url: url,
  //               data: formData,
  //               processData: false,
  //               contentType: false,
  //               cache: false,
  //               success: function (data) {

  //                   if (data.status == 442){
  //                     $.each(data.errors, function (key, val) {
  //                       var newchar = '_'
  //                       var str = key.split('.').join(newchar);
  //                       // str = key.replace(/./g , "_")
  //                       $("#" + str + "_error").text(val[0]);
  //                       console.log(str);
  //                     });
  //                   }else{
  //                       window.location.href = "/en/question";
  //                       toastr.success('Created Successfully', "Question!",);
  //                   }
  //               }, error: function (xhr) {

  //               }
  //           });
  //       });

  </script>
  @endsection
