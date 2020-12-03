
@extends('layouts/contentLayoutMaster')

@section('title', 'List View')

@section('vendor-style')
        {{-- vendor files --}}
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.css')) }}">
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

    {{-- DataTable starts --}}
    <div class="table-responsive">
      <table class="table data-list-view" id="user-list-table">
        <thead>
          <tr>
            <th></th>
            <th>{{__('locale.Name')}}</th>
            <th>{{__('locale.Email')}}</th>
            <th>{{__('locale.User Name')}}</th>
            <th>{{__('locale.Cell')}}</th>
            <th>{{__('locale.Address')}}</th>
            <th>{{__('locale.Action')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($record as $user)
            <tr>
              <td></td>
              <td class="user-name" id="name-user_{{ $user["id"] }}">{{ $user["name"] }}</td>
              <td class="user-email" id="email-user_{{ $user["id"] }}">{{ $user["email"] }}</td>
              <td class="user-userName" id="userName-user_{{ $user["id"] }}">{{ $user["userName"] }}</td>
              <td class="user-cell" id="cell-user_{{ $user["id"] }}">{{ $user["cell"] }}</td>
              <td class="user-address" id="address-user_{{ $user["id"] }}">{{ $user["address"] }}</td>
              <td class="user-action">
                <span class="action-edit" data-id="{{$user["id"]}}"><i class="feather icon-edit"></i></span>
                <span class="action-delete" data-id="{{$user["id"]}}"><i class="feather icon-trash"></i></span>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{-- DataTable ends --}}

    {{-- add new sidebar starts --}}
    <div class="add-new-data-sidebar">
      <div class="overlay-bg"></div>
      <div class="add-new-data">
        <form action="#">
          @csrf
          <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
            <div>
              <h4 class="text-uppercase" id="h-add-update">{{__('locale.Add New Data')}}</h4>
            </div>
            <div class="hide-data-sidebar">
              <i class="feather icon-x"></i>
            </div>
          </div>
          <div class="data-items pb-3">
            <div class="data-fields px-2 mt-1">
              <div class="row">
                <div class="col-sm-12 data-field-col">
                  <label for="data-name">{{__('locale.Name')}}</label>
                  <input type="text" class="form-control" name="name" id="data-name">
                </div>
                <div class="col-sm-12 data-field-col">
                  <label for="data-email">{{__('locale.Email')}}</label>
                  <input type="text" class="form-control" name="email" id="data-email">
                </div>
                <div class="col-sm-12 data-field-col">
                  <label for="data-userName">{{__('locale.User Name')}}</label>
                  <input type="text" class="form-control" name="userName" id="data-userName">
                </div>
                <div class="col-sm-12 data-field-col">
                  <label for="data-cell">{{__('locale.Cell')}}</label>
                  <input type="text" class="form-control" name="cell" id="data-cell">
                </div>

                <div class="col-sm-12 data-field-col">
                  <label for="data-address">{{__('locale.Address')}}</label>
                  <input type="text" class="form-control" name="address" id="data-address">
                </div>



                {{-- @foreach ( config('laratrust_seeder.role_structure.admin') as $index => $mod)--}}
                {{--     $index;--}}
                {{-- @endforeach--}}


                <div class="col-sm-12 col-12 data-field-col">
                  <label for="user-role">User Role</label>
                      <select class="select2 form-control" id="user-role">
                          <option value="0" selected>{{__('locale.Select User Role')}}</option>
                          <option value="admin"> {{__('locale.Admin')}}</option>
                          <option value="user"> {{__('locale.User')}}</option>
                      </select>
                </div>

{{--
              <section id="basic-tabs-components" style="width: 100%">
                <div class="row">
                  <div class="col-12">
                    <div class="card overflow-hidden">
                      <div class="card-header">
                        <h4 class="card-title">  @lang('locale.permissions')</h4>
                      </div>
                      <div class="card-content">
                        <div class="card-body">

                          @php
                            $models = ['users', 'Licensecode', 'questions'];
                            $can_do = ['create', 'read', 'update', 'delete'];
                          @endphp

                          <p>{{__('locale.what can user do.')}}</p>
                          <ul class="nav nav-tabs" role="tablist">
                            @foreach ($models as $index => $model)
                              <li class="nav-item">
                                <a class="nav-link {{ $index == 0 ? 'active' : '' }}" href="#{{ $model }}" id="{{ $model }}-tab" data-toggle="tab" aria-controls="{{ $model }}" role="tab" aria-selected="true">@lang('locale.' . $model)</a>
                              </li>
                            @endforeach
                          </ul>

                          <div class="tab-content">
                            @foreach ($models as $index => $model)
                                <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}" aria-labelledby="{{ $model }}-tab" role="tabpanel">

                                  @foreach ($can_do as $can)
                                    <label>
                                          <input
                                                type="checkbox"
                                                id="permissions"
                                                name="permissions[]"
                                                value="{{ $can . '-' . $model }}"
                                                {{($user->can($can . '-' . $model )) ? 'checked' : ''}} >
                                    @lang('locale.' . $can)</label>
                                  @endforeach
                                </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section> --}}




                <input type="hidden" class="form-control" name="id" id="data-id">
                <input type="hidden" class="form-control" name="id" id="data-form" value="add">
              </div>
            </div>
          <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
            <div class="add-data-btn">
              {{-- <input type="submit" id="add-update" class="btn btn-primary" value="{{__('locale.Submit')}}"> --}}
              <button id="add-update" type="submit" class="btn btn-primary mr-1 mb-1">{{__('locale.Submit')}}</button>
            </div>
            <div class="cancel-data-btn">
              <input type="reset" class="btn btn-outline-danger" value="{{__('locale.Cancel')}}">
            </div>
          </div>
        </form>
      </div>
    </div>
    {{-- add new sidebar ends --}}
  </section>
  {{-- Data list view end --}}
@endsection



@section('vendor-script')
{{-- vendor js files --}}
        <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.select.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection
@section('page-script')
        {{-- Page js files --}}
        <script src="{{ asset(mix('js/scripts/ui/data-list-view.js')) }}"></script>
        <script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>
        <script src="{{ asset(mix('js/scripts/extensions/sweet-alerts.js')) }}"></script>



    <script>

    // Update or Create User
    $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });

    $('#add-update').on("click",function(event){
      event.preventDefault();
      var id = $('#data-id').val();
      var form = $('#data-form').val();
      var td = $("#user-list-table  > tbody");
      // var permissions = [];
      //     $("#permissions:checked").each(function() {
      //         permissions.push($(this).val());
      //     });
      $.ajax({
            type: "get",
            url: "/app-user-UpdateOrCreate",
            data: {
                'id': id,
                'name': $('#data-name').val(),
                'email': $('#data-email').val(),
                'userName': $('#data-userName').val(),
                'cell': $('#data-cell').val(),
                'address': $('#data-address').val(),
                'role': $('#user-role').val(),
                // 'permissions': permissions,
            },
            success: function (data) {
              $(".add-new-data").removeClass("show")
              $(".overlay-bg").removeClass("show")
              $("#data-name, #data-email, #data-userName, #data-cell, #data-address").val("")
              $("#data-category, #data-status").prop("selectedIndex", 0)

              if(form === "edit"){
              console.log(form);
                toastr.info('Updated Successfully', "User!", { "timeOut": 5000 });
                $('#name-user_' + data.id).text(data.name);
                $('#email-user_' + data.id).text(data.email);
                $('#userName-user_' + data.id).text(data.userName);
                $('#cell-user_' + data.id).text(data.cell);
                $('#address-user_' + data.id).text(data.address);
              }else{
              toastr.info('Created Successfully', "User!", { "timeOut": 5000 });
              console.log(form);
              td.append(`
                  <tr>
                    <td class="dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes"></td>
                    <td class="user-name">${data.name}</td>
                    <td class="user-email">${data.email}</td>
                    <td class="user-userName">${data.userName}</td>
                    <td class="user-cell">${data.cell}</td>
                    <td class="user-address">${data.address}</td>
                    <td class="user-action">
                      <span class="action-edit" data-id="${data.id}"><i class="feather icon-edit"></i></span>
                      <span class="action-delete" data-id="${data.id}"><i class="feather icon-trash"></i></span>
                    </td>
                  </tr>
              `)
              }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
  });

  </script>
@endsection
