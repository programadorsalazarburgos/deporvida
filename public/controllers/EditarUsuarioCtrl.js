SeriesApp.controller("EditarUsuarioCtrl", function($scope, UsuarioService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Usuario";
    $scope.series = [];
    $scope.getData = function(){
    // $scope.serie = UsuarioService.get({id:$routeParams.id});
    // console.log($scope.serie);

};

$http.get(base_api + "/admin/postusuarios/" + $routeParams.id)
  .success(function(response){
         $scope.serie = response[0];    
  });

     $(document).ready(function () {

            //$('[name=integer-data-attribute]').maskNumber({integer: true});
        });


$.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha_nacimiento").datepicker({
      changeMonth: true,
      changeYear: true,

});
});

$http.get(base_api + "/obtenerselect/rol/" + $routeParams.id).success(function(response)
{
    var hashids = new Hashids('', 10);
    $scope.data = 
    {
        'id': 1,
        'unit': hashids.encode(response.id)
    }
});

$http.get(base_api + "/obtenerselect/roles")
  .success(function(response){
    $scope.roles = response;
    console.log($scope.roles);
  });



 $http.get(base_api + "/obtener/tipodocumento_usuario/" + $routeParams.id)
  .success(function(response){


    $scope.obtener = {};
    $scope.obtener.documentoId = response.id.toString();

    $scope.obtener.documentos = [
    {id: '1', nombre: 'Registro Civil'},
    {id: '2', nombre: 'Tarjeta Identidad'},
    {id: '3', nombre: 'Cédula de Ciudadanía'},
    {id: '4', nombre: 'Pasaporte'},
    {id: '5', nombre: 'Sin Información'},

    ];

  });




$scope.getData();
 $scope.form_title = "User Detail";
 $scope.Actualizar = function(id, isValid){
if (isValid) 
{
    var midata = new FormData();
    var primer_nombre = $scope.serie.primer_nombre;         
    var segundo_nombre = $scope.serie.segundo_nombre;           
    var primer_apellido = $scope.serie.primer_apellido;            
    var segundo_apellido = $scope.serie.segundo_apellido;           
    var tipo_documento = $scope.obtener.documentoId;          
    var numero_documento = $scope.serie.numero_documento;           
    var direccion = $scope.serie.direccion;      
    var fecha = $("#fecha_nacimiento").val();        
    var telefono_movil = $scope.serie.telefono_movil;            
    var telefono_fijo = $scope.serie.telefono_fijo;            
    var correo = $scope.serie.email;           
    var obtener_rol = $("#rol").val();    
    var rol = obtener_rol.replace('string:', '');
    var d = new Date(fecha);
    var fecha_nacimiento = $.datepicker.formatDate('yy-mm-dd', d);
    console.log(d);
    midata.append('primer_nombre',primer_nombre);
    midata.append('segundo_nombre',  segundo_nombre);
    midata.append('primer_apellido',  primer_apellido);
    midata.append('segundo_apellido',  segundo_apellido);
    midata.append('tipo_documento',  tipo_documento);
    midata.append('numero_documento',  numero_documento);
    midata.append('direccion',  direccion);
    midata.append('fecha_nacimiento',  fecha_nacimiento);
    midata.append('telefono_movil',  telefono_movil);
    midata.append('telefono_fijo',  telefono_fijo);
    midata.append('correo',  correo);
    midata.append('rol',  rol);
    
   $.ajax({
        url: base_api + '/actualizar/usuario/' + id,
        type: 'POST',
        contentType: false,
        data: midata,  // mandamos el objeto formdata que se igualo a la variable data
        processData: false,
        cache: false,
        success: function (respuestaAjax) {
        swal("Almacenado!", "Registro Guardado.", "success");
        
        $('#myModal').modal('hide');
        }
      });
     }
   };

$scope.ActualizarPassword = function(id, isValid){

if (isValid) {

    var midata = new FormData();
    var password = $scope.registerData.password_confirmation;      
    midata.append('password',password);
    
   $.ajax({
        url: base_api + '/actualizar/clave/' + id,
        type: 'POST',
        contentType: false,
        data: midata,  // mandamos el objeto formdata que se igualo a la variable data
        processData: false,
        cache: false,
        success: function (respuestaAjax) {
        swal("Actualizado!", "Registro Actualizado.", "success");
        
        $('#myModal').modal('hide');
        }
      });
    }
  };
});
