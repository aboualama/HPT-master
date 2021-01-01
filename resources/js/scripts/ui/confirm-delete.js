/*=========================================================================================
	File Name: sweet-alerts.js
	Description: A beautiful replacement for javascript alerts
	----------------------------------------------------------------------------------------
	Item name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: weeneet
	Author URL:
==========================================================================================*/

function confirmrow(i) {
    var modal = $("#modal").val();
    var C_modal = modal.charAt(0).toUpperCase() + modal.slice(1);
    var td = $('#confirm-color_' + i).closest('td').parent('tr');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-danger ml-1',
      buttonsStyling: false,
    }).then(function (result) {
      if (result.value) {
        // Swal.fire({
        //   type: "success",
        //   title: 'Deleted!',
        //   text: 'Your file has been deleted.',
        //   confirmButtonClass: 'btn btn-success',
        // }),
        $.ajax({
          url: "/" + modal + "/" + i,
          method: "DELETE",
          success: function (data) {
            toastr.success('Deleted Successfully', C_modal + "!",);
            td.fadeOut();
          },
          error: function (data) {
            console.log('Error:');
          }
        });
      }
      else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: 'Cancelled',
          text: 'Your imaginary file is safe :)',
          type: 'error',
          confirmButtonClass: 'btn btn-success',
        })
      }
    })
  // });
}
