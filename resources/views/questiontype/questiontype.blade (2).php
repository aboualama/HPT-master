

@extends('layouts/contentLayoutMaster')

@section('title', 'Question Types')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection
@section('page-style')
        {{-- Page css files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/plugins/file-uploaders/dropzone.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/pages/data-list-view.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/plugins/extensions/toastr.css')) }}">
@endsection


@section('content')

  {{-- Data list view starts --}}
  <section id="data-list-view" class="data-list-view-header">
    <div class="action-btns d-none">
      <div class="btn-dropdown mr-1 mb-1">
        <div class="btn-group dropdown actions-dropodown">
          <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>Delete</a>
            <a class="dropdown-item" href="#"><i class="feather icon-archive"></i>Archive</a>
            <a class="dropdown-item" href="#"><i class="feather icon-file"></i>Print</a>
            <a class="dropdown-item" href="#"><i class="feather icon-save"></i>Another Action</a>
          </div>
        </div>
      </div>
    </div>


    {{-- <a class="btn btn-primary" href="{{ url('questiontype/create') }}"><i class="feather icon-plus"></i>Add New</a> --}}


  {{-- DataTable starts --}}
  <div class="table-responsive">
    <table class="table data-list-view" id="user-list-table">
      <thead>
      <tr>
        <th></th>
        <th>title</th>
        <th>intro</th>
        <th>ACTION</th>
      </tr>
      </thead>
      <tbody>
      @foreach ($recordss as $questiontype)
        <tr>
          <td></td>
          <td class="user-name" id="name-questiontype_{{ $questiontype["id"] }}">{{ $questiontype["title "] }}</td>
          <td class="user-name" id="cell-questiontype_{{ $questiontype["id"] }}">{{ $questiontype["intro"] }}</td>
          <td class="user-action">
            <span class="action-edit" data-id="{{$questiontype["id"]}}"><i class="feather icon-edit"></i></span>
            <span class="action-delete" data-id="{{$questiontype["id"]}}"><i class="feather icon-trash"></i></span>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  {{-- DataTable ends --}}



@endsection


@section('vendor-script')
        <!-- vendor files -->
        <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>


        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.select.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
@endsection
@section('page-script')
        <!-- Page js files -->
        <script src="{{ asset(mix('js/scripts/forms/select/form-select2.js')) }}"></script>
        <script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>
        {{-- <script src="{{ asset(mix('js/scripts/ui/questiontype.js')) }}"></script> --}}



    <script>
    // Update or Create questiontype
    $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });



    $(document).ready(function() {
  "use strict"
  // init list view datatable
  var dataListView = $(".data-list-view").DataTable({
    responsive: false,
    columnDefs: [
      {
        orderable: true,
        targets: 0,
        checkboxes: { selectRow: true }
      }
    ],
    dom:
      '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
    oLanguage: {
      sLengthMenu: "_MENU_",
      sSearch: ""
    },
    aLengthMenu: [[ 10, 15, 20], [10, 15, 20]],
    select: {
      style: "multi"
    },
    order: [[1, "asc"]],
    bInfo: false,
    pageLength: 4,
    buttons: [
      {
        text: "<div><a href='{{ url('questiontype/create') }}'><i class='feather icon-plus'></i>Add New</a></div>",

        className: "btn-outline-primary"
      }
    ],
    initComplete: function(settings, json) {
      $(".dt-buttons .btn").removeClass("btn-secondary")
    }
  });

  dataListView.on('draw.dt', function(){
    setTimeout(function(){
      if (navigator.questiontypeAgent.indexOf("Mac OS X") != -1) {
        $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
      }
    }, 50);
  });

  // init thumb view datatable
  var dataThumbView = $(".data-thumb-view").DataTable({
    responsive: false,
    columnDefs: [
      {
        orderable: true,
        targets: 0,
        checkboxes: { selectRow: true }
      }
    ],
    dom:
      '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
    oLanguage: {
      sLengthMenu: "_MENU_",
      sSearch: ""
    },
    aLengthMenu: [[10, 15, 20], [10, 15, 20]],
    select: {
      style: "multi"
    },
    order: [[1, "asc"]],
    bInfo: false,
    pageLength: 4,
    buttons: [
      {
        text: "<div><a href='{{ url('questiontype/create') }}'><i class='feather icon-plus'></i>Add New</a></div>",

        className: "btn-outline-primary"
      }
    ],
    initComplete: function(settings, json) {
      $(".dt-buttons .btn").removeClass("btn-secondary")
    }
  })

  dataThumbView.on('draw.dt', function(){
    setTimeout(function(){
      if (navigator.questiontypeAgent.indexOf("Mac OS X") != -1) {
        $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
      }
    }, 50);
  });

  // To append actions dropdown before add new button
  var actionDropdown = $(".actions-dropodown")
  actionDropdown.insertBefore($(".top .actions .dt-buttons"))


  // Scrollbar
  if ($(".data-items").length > 0) {
    new PerfectScrollbar(".data-items", { wheelPropagation: false })
  }

  // Close sidebar
  $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function() {
    $(".add-new-data").removeClass("show")
    $(".overlay-bg").removeClass("show")
    $("#data-name, #data-price").val("")
    $("#data-category, #data-status").prop("selectedIndex", 0)
  })

  // On Edit
  $('.action-edit').on("click",function(e){
    e.stopPropagation();
    var name =  $(this).closest('tr').find('td.questiontype-name').text();
    var category =  $(this).closest('tr').find('td.questiontype-category').text();
    $('#data-name').val(name);
    $('#data-categoryv').val(category);
    $('#data-price').val('$99');
    $(".add-new-data").addClass("show");
    $(".overlay-bg").addClass("show");
  });

  // On Delete
  $('.action-delete').on("click", function(e){
    e.stopPropagation();
    var td = $(this).closest('td').parent('tr');
    var id = $(this).data("id");
    $.ajax({
        url: "/questiontype" + '/' + id,
        method: "DELETE",
        success: function (data) {
          td.fadeOut();
          toastr.success('XXXXXXXXXXXXXXXXXXX',"questiontype!",);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
  });


})


  </script>
@endsection
