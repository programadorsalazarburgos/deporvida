  $("#registro").click(function(){

    var dato = $("#name2").val();
    var dato2 = $("#display_name2").val();
    var route = "http://localhost:8000/admin/roles";
    var token = $("#token").val();

    $.ajax({

      url: route,
      headers: {'X-CSRF-TOKEN': token},
      type: 'POST',
      dataType: 'json',
      data:{name: dato, display_name: dato2}
    });

  });


 $('select').DualListBox();

   

