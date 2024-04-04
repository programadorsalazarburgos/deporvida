document.getElementById('departamento').addEventListener('change', function(){
    var variable = this.value;

    $.ajax({
        url: base + '/api/medico/obtenermunic',
        type: 'POST',
        dataType: 'JSON',
        data: {variable: variable},

    }).success(function(data){
    var munic = $('#municipio').empty();

    $.each(data, function(index, val) {
      console.log(val);
    var data_area = '<option value="'+val.id+'">' + val.nombre + '</option>';
    munic.append(data_area);
    });
  });
});

$(".solo_letras").on('keyup', function(e) {
    var val = $(this).val();
   if (val.match(/[^a-zA-Z]/g)) {
       $(this).val(val.replace(/[^a-zA-Z]/g, ''));
   }
});
