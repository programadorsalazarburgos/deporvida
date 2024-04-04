SeriesApp.controller('BeneficiariosCrtl', function ($scope, $routeParams, $location, BeneficiarioService, $http, $timeout, base_api) {


$scope.title = "Beneficiarios";
$scope.series = [];


$scope.getData = function(){
  $http.get(base_api + "/admin/postbeneficiarios")
    .success(function(response){
    $scope.list = response;
   // console.log($scope.list);
    $scope.currentPage = 1; //current page
    $scope.entryLimit = 50; //max no of items to display in a page
    $scope.filteredItems = $scope.list.length; //Initially for no filter
    $scope.totalItems = $scope.list.length;
     
  });
};


$scope.pageSize = 50;

$scope.sort = function(keyname){
    $scope.sortKey = keyname;   //set the sortKey to the param passed
    $scope.reverse = !$scope.reverse; //if true make it false and vice versa
  }

$scope.setPage = function(pageNo) {
      $scope.currentPage = pageNo;
     console.log($scope.currentPage); 

    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filteredItems = $scope.filtered.length;
              console.log($scope.filteredItems); 

        }, 10);
    };
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };

$scope.getData();
$scope.series = BeneficiarioService.query();

$scope.toggle = function(modalstate, id) {
      $scope.modalstate = modalstate;
      switch(modalstate) {

          case 'AgregarGrupo':
          $scope.form_contenido = "GRUPOS";
          $scope.form_title = "obtener";
          $scope.id = id;

          break;
        default:
          break;
      }

      $('#myModal').modal('show');
  }




 $http.get(base_api + "/obtener/allmonitores")
    .success(function(response){
    $scope.monitores = response;
   

  });



    $scope.selectedMonitor=function(item){

      $http.get(base_api + "/obtener/gruposmonitor/" + item)
      .success(function(response){

        $scope.monitores_grupo = response;



      });
    }    

$scope.formAsociar = function(isValid, id){


 if (isValid) {

 $.ajax({
          url: base_api + '/postbeneficiario/asociargrupo/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            grupo_id:$scope.grupo_monitor
        },
    
        }).success(function(){
         
            $scope.getData();
            toastr.success("Su registro ha sido exitoso", "Grupo Asociado");
            window.location="/admin/postbeneficiarios#/admin/postbeneficiarios";


        })
        .error(function() {
          console.log("success");
        });

 }

}


$scope.SacarGrupo = function(id) {
swal({
  title: "Sacar del Grupo?",
  text: "Desea sacar del grupo a este beneficiario!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Sacalo!",
  cancelButtonText: "No, cancela!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {

      $.ajax({
        url: base_api + '/eliminar/grupo/' + id,
        type: 'POST',
        dataType: 'JSON',
        data: {param1: 'value1'},
      }).success(function(){
        swal("Eliminado!", "Has sacado del grupo este beneficiario.", "success");
        $scope.getData();

      });

  } else {
    swal("Cancelado", "Has decidido que no sacarlo del grupo :)", "error");
  }
});

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
  url: base_api + '/eliminar/beneficiario/' + id,
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


$scope.myDataSource = {
    chart: {
        caption: "Age profile of website visitors",
        subcaption: "Last Year",
        startingangle: "120",
        showlabels: "0",
        showlegend: "1",
        enablemultislicing: "0",
        slicingdistance: "15",
        showpercentvalues: "1",
        showpercentintooltip: "0",
        plottooltext: "Age group : $label Total visit : $datavalue",
        theme: "fint"
    },
    data: [
        {
            label: "Teenage",
            value: "1250400"
        },
        {
            label: "Adult",
            value: "1463300"
        },
        {
            label: "Mid-age",
            value: "1050700"
        },
        {
            label: "Senior",
            value: "491000"
        }
    ]
}

});


