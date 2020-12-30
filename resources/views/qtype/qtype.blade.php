@extends('layouts/contentLayoutMaster')

@section('title', __('locale.questions'))


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

{{-- datatables files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
@endsection

@section('page-style')
        {{-- Page css files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/plugins/extensions/toastr.css')) }}">

        {{-- datatables files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/pages/data-list-view.css')) }}">
@endsection


@section('content')

<button class="btn btn-success mr-1 mb-1" id="action-add">{{__('locale.Add New Question Type')}}</button>


@include('partials._errors')


<!-- Table head options start -->
        <section id="data-list-view" class="users-list-wrapper data-list-view-header">
          <div class="table-responsive">
            <table class="table data-list-view" id="user-list-table">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">{{__('locale.type')}}</th>
                  <th scope="col">{{__('locale.title')}}</th>
                  <th scope="col">{{__('locale.entro')}}</th>
                  <th scope="col">{{__('locale.Action')}}</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($records as $i => $record)
                <tr>
                  <th scope="row">{{$i +1}}</th>
                  <td id="qtype_type_{{$record->id}}">{{$record->type}}</td>
                  <td id="qtype_title_{{$record->id}}">{{$record->title}}</td>
                  <td id="qtype_entro_{{$record->id}}">{{$record->entro}}</td>
                  <td>
                    <span class="action-edit" data-id="{{$record->id}}"><i class="feather icon-edit"></i></span>
                    <span class="action-delete" data-id="{{$record->id}}"><i class="feather icon-trash"></i></span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </section>
<!-- Table head options end -->



{{-- Modal --}}
<div class="col-12">
  <div class="row">
    <div class="modal-size-lg mr-1 mb-1 d-inline-block">
      <div class="modal fade text-left" id="modal-block-add" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <div id="create_qtype"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




{{-- Modal --}}
<div class="col-12">
  <div class="row">
    <div class="modal-size-lg mr-1 mb-1 d-inline-block">
      <div class="modal fade text-left" id="modal-block-edit" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <div id="qtype"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection


@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>

<!-- datatable files -->
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script> {{-- --}}
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script> {{-- --}}
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script> {{-- --}}
<script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script> {{-- --}}
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.select.min.js')) }}"></script> {{-- --}}
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script> {{-- --}}
@endsection

@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/forms/select/form-select2.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>


<!-- datatable files -->
<script src="{{ asset(mix('js/scripts/ui/licensecode-list-view.js')) }}"></script>
<script>

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('#action-add').on("click", function (e) {
     e.stopPropagation();
    /* $('#modal-block-add').modal('toggle');*/
     $.ajax({
       type: 'GET',
       url: '/qtype-creat/',
       success: function (data) {
         $('#modal-block-add').modal('toggle');
         $('#create_qtype').html(data);
       }
     });
   });

$('.action-edit').on("click", function (e) {
     e.stopPropagation();
     var id = $(this).data("id");

     $.ajax({
       type: 'GET',
       url: '/qtype-edit/' + id,
       success: function (data) {
         $('#modal-block-edit').modal('toggle');
         $('#qtype').html(data);
       }
     });
   });


    // On Delete
    $('.action-delete').on("click", function (e) {
      e.stopPropagation();
      var td = $(this).closest('td').parent('tr');
      var id = $(this).data("id");
      $.ajax({
        url: "/qtype/" + id,
        method: "DELETE",
        success: function (data) {
          toastr.success('Deleted Successfully',"Question Type!",);
          td.fadeOut();
        },
        error: function (data) {
          console.log('Error:');
        }
      });
    });



  $(document).on('click', '#submit', function (e) {
            e.preventDefault();
            $(".small_error").text('');
            var url = $("#url").val();
            var formData = new FormData($('#form')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {

                    if (data.status == 442){
                      $.each(data.errors, function (key, val) {
                        var newchar = '_'
                        var str = key.split('.').join(newchar);
                        $("#" + str + "_error").text(val[0]);
                        console.log(str);
                      });
                    }else{
                        window.location.href = "/en/qtype";
                        toastr.success('Created Successfully', "Question Type!",);
                    }
                }, error: function (xhr) {

                }
            });
        });



        $(document).on('click', '#edit', function (e) {
            e.preventDefault();
            var url = $("#url").val();
            var qtype_id = $("#qtype_id").val();
            var qtype = $('#qtype').val();
            $(".small_error").text('');

            console.log(qtype);
            var formData = new FormData($('#formedit')[0]);

            $.ajax({
                enctype: 'multipart/form-data',
                url: url ,
                data: formData,
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                        console.log(data);

                        if (data.status == 442){
                          $.each(data.errors, function (key, val) {
                            var newchar = '_'
                            var str = key.split('.').join(newchar);
                            $("#" + str + "_error").text(val[0]);
                            console.log(str);
                          });
                        }else{
                            $("#modal-block-edit").modal('toggle');
                            $('#qtype_type_' + qtype_id).text(data.type);
                            $('#qtype_title_' + qtype_id).text(data.title);
                            $('#qtype_entro_' + qtype_id).text(data.entro);
                            toastr.success('Updated Successfully', "Question Type!",);
                        }
                }, error: function (xhr) {

                }
            });
        });


  </script>
  @endsection
