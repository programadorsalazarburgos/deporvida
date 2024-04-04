SeriesApp.controller('UsuariosCrtl', function ($scope, $routeParams, $location, UsuarioService, $http, $timeout, base_api) {


$scope.title = "Usuarios";
$scope.series = [];

$scope.getData = function(){
  $http.get(base_api + "/admin/postusuarios")
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
$scope.series = UsuarioService.query();


$scope.toggle = function(modalstate) {
      $scope.modalstate = modalstate;
      switch(modalstate) {
          case 'CrearRol':
          $scope.form_title = "Formulario Rol";
          break;
       
      }

      $('#myModal').modal('show');
  }


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
  url: base_api + '/eliminar/usuario/' + id,
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


