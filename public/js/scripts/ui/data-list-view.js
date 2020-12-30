/*=========================================================================================
    File Name: data-list-view.js
    Description: List View
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: weeneet
    Author URL:
==========================================================================================*/

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
    aLengthMenu:  [[10, 15, 20], [10, 15, 20]],
    select: {
      style: "multi"
    },
    order: [[1, "asc"]],
    bInfo: false,
    pageLength: 10,
    buttons: [
      {
        text: "<i class='feather icon-plus'></i> Add New ",
        action: function() {
          $(this).removeClass("btn-secondary")
          $(".add-new-data").addClass("show")
          $(".overlay-bg").addClass("show")
          $("#data-name, #data-price").val("")
          $("#data-category, #data-status").prop("selectedIndex", 0)
        },
        className: "btn-outline-primary"
      }
    ],
    initComplete: function(settings, json) {
      $(".dt-buttons .btn").removeClass("btn-secondary")
    }
  });

  dataListView.on('draw.dt', function(){
    setTimeout(function(){
      if (navigator.userAgent.indexOf("Mac OS X") != -1) {
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
        text: "<i class='feather icon-plus'></i> Add New  ",
        action: function() {
          $(this).removeClass("btn-secondary")
          $(".add-new-data").addClass("show")
          $(".overlay-bg").addClass("show")
        },
        className: "btn-outline-primary"
      }
    ],
    initComplete: function(settings, json) {
      $(".dt-buttons .btn").removeClass("btn-secondary")
    }
  })

  dataThumbView.on('draw.dt', function(){
    setTimeout(function(){
      if (navigator.userAgent.indexOf("Mac OS X") != -1) {
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
    $("#data-name, #data-email, #data-userName, #data-cell, #data-company, #data-address, #data-id, #data-form").val("")
    $("#permissions").prop('checked', false)
    $("#add-update").val("Add Data")
    $("#h-add-update").text("Add New Data")
    $("#data-category, #data-status").prop("selectedIndex", 0)
  })

  // On Edit
  $('.action-edit').on("click",function(e){
    e.stopPropagation();
    var name =  $(this).closest('tr').find('td.user-name').text();
    var email =  $(this).closest('tr').find('td.user-email').text();
    var userName =  $(this).closest('tr').find('td.user-userName').text();
    var cell =  $(this).closest('tr').find('td.user-cell').text();
    var company =  $(this).closest('tr').find('td.user-company').text();
    var address =  $(this).closest('tr').find('td.user-address').text();
    var id = $(this).data("id");
    $('#data-name').val(name);
    $('#data-email').val(email);
    $('#data-userName').val(userName);
    $('#data-cell').val(cell);
    $('#data-company').val(company);
    $('#data-address').val(address);
    $('#data-id').val(id);
    $('#data-form').val("edit");
    $('#add-update').val("Update Data");
    $('#h-add-update').text("Update Data");
    $(".add-new-data").addClass("show");
    $(".overlay-bg").addClass("show");
  });

  // On Delete
  $('.action-delete').on("click", function(e){
    e.stopPropagation();
    var td = $(this).closest('td').parent('tr');
    var id = $(this).data("id");
    $.ajax({
        url: "/app-user-delete" + '/' + id,
        method: "DELETE",
        success: function (data) {
          toastr.success('Deleted Successfully',"User!",);
          td.fadeOut();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
  });

  // dropzone init
  // Dropzone.options.dataListUpload = {
  //   complete: function(files) {
  //     var _this = this
  //     // checks files in class dropzone and remove that files
  //     $(".hide-data-sidebar, .cancel-data-btn, .actions .dt-buttons").on(
  //       "click",
  //       function() {
  //         $(".dropzone")[0].dropzone.files.forEach(function(file) {
  //           file.previewElement.remove()
  //         })
  //         $(".dropzone").removeClass("dz-started")
  //       }
  //     )
  //   }
  // }
  // Dropzone.options.dataListUpload.complete()

  // // mac chrome checkbox fix
  // if (navigator.userAgent.indexOf("Mac OS X") != -1) {
  //   $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
  // }
})
