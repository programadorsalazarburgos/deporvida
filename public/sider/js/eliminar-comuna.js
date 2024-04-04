
  function request_access($this){
    var request_data = $this.id;


	swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false
}).then(function (result) {
  if (result.value) {

	$.ajax({
         type: "POST",
         url: "{% url 'del_dept' %}",
         data: { 'id':request_data },
         beforeSend: function(xhr) {
            xhr.setRequestHeader("X-CSRFToken", "{{ csrf_token }}");
         },
         success: function(response){
	
			swal(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )

		$('#service_command_' + request_data).remove();
	
        }
        })

  // result.dismiss can be 'cancel', 'overlay',
  // 'close', and 'timer'
  } else if (result.dismiss === 'cancel') {
    swal(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})

}
