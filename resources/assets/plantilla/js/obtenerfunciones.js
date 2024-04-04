    var obtenerFuncion = function(){

        var departamento = document.getElementById("departamento").value;

        var imagen = $("#imagen");

        $.ajax({
            url: base + '/obtener/funcionesdept/' + departamento,
            type: 'POST',
            dataType: 'JSON',
            data: {param1: 'value1'},
        }).success(function(data){
            imagen.empty();
            imagen.append("<img src='"+ '/' +""+  data.image +"' alt=''>");

            console.log(data);

        });



    }
