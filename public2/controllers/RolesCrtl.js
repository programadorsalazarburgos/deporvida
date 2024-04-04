SeriesApp.controller('RolesCrtl', function ($scope, $routeParams, $location, RoleService, $http, $timeout, base_api) {


$scope.title = "Roles y Permisos";
$scope.series = [];

$scope.getData = function(){
  $http.get(base_api + "/admin/postroles")
    .success(function(response){
    $scope.list = response;
    $scope.currentPage = 1; //current page
    $scope.entryLimit = 50; //max no of items to display in a page
    $scope.filteredItems = $scope.list.length; //Initially for no filter
    $scope.totalItems = $scope.list.length;
  });
};

$scope.setPage = function(pageNo) {
      $scope.currentPage = pageNo;

    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };

$scope.getData();
$scope.series = RoleService.query();


$scope.toggle = function(modalstate) {
      $scope.modalstate = modalstate;
      switch(modalstate) {
          case 'CrearRol':
          $scope.form_title = "Formulario Rol";
          break;
       
      }

      $('#myModal').modal('show');
  }




$scope.GuardarRol = function(){


  var midata = new FormData();
  var nombre = $scope.nombre;
  var descripcion  = $scope.descripcion;
  midata.append('nombre',nombre);
  midata.append('descripcion',  descripcion);
    
  $.ajax({
    url: base_api + '/guardar/rol',
    type: 'POST',
    contentType: false,
    data: midata,  // mandamos el objeto formdata que se igualo a la variable data
    processData: false,
    cache: false,
    success: function (respuestaAjax) {
    swal("Almacenado!", "Registro Guardado.", "success");
    $scope.getData();
    $('#myModal').modal('hide');
    }
  });
 };


$scope.eliminar = function(id){


swal({
  title: "Estas seguro?",
  text: "No podrá recuperar este archivo!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Eliminado!",
  cancelButtonText: "No, lo Elimines!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {

  $.ajax({
  url: base_api + '/eliminar/rol/' + id,
  type: 'POST',
  dataType: 'JSON',

}).success(function(response){
    swal("Eliminado!", "Registro Eliminado.", "success");
    $scope.getData();
});


  } else {
    swal("Cancelado", "No elimino su registro :)", "error");
  }
});


  }



});


