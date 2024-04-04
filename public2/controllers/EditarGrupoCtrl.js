SeriesApp.controller("EditarGrupoCtrl", function($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Grupo";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = GrupoService.get({id:$routeParams.id});

   // console.log($scope.serie);

};

$scope.serie = {};
$scope.getData();


$scope.disabled = undefined;

  $scope.enable = function() {
    $scope.disabled = false;
  };

  $scope.disable = function() {
    $scope.disabled = true;
  };

  $scope.clear = function() {
    $scope.person.selected = undefined;
    $scope.address.selected = undefined;
    $scope.country.selected = undefined;
  };

  $scope.person = {};


$http.get(base_api + "/obtenerselect/SedeGrupo/" + $routeParams.id)
  .success(function(response){


          $scope.dataSede = response;
          console.log($scope.dataSede);
   
  });


$http.get(base_api + "/obtenerselect/sedes")
  .success(function(response){

    $scope.people = response;
   console.log($scope.people);

  });


  $scope.address = {};
  $scope.refreshAddresses = function(address) {
    var params = {address: address, sensor: false};
    return $http.get(
      'http://maps.googleapis.com/maps/api/geocode/json',
      {params: params}
    ).then(function(response) {
      $scope.addresses = response.data.results
    });
  };



$scope.dias = [
  {id: 'lunes'},
  {id: 'martes'},
  {id: 'miercoles'},
  {id: 'jueves'},
  {id: 'viernes'},
  ];




$http.get(base_api + "/obtener/GrupoHorario/" + $routeParams.id)
  .success(function(response){

          response.forEach((element) => {
            var dia = $scope.dias.find((d) => d.id == element.dia);
            if (dia) {

              dia.checked = true;
              dia._id = element.id;
              dia.inicio = new Date();
              dia.inicio.setHours(element.hora_inicio.split(":")[0]);
              dia.inicio.setMinutes(element.hora_inicio.split(":")[1]);
              //dia.inicio = element.hora_inicio;
              dia.fin = new Date();
              dia.fin.setHours(element.hora_fin.split(":")[0]);
              dia.fin.setMinutes(element.hora_fin.split(":")[1]);
              //dia.fin = element.hora_fin;
            }
          });          
  });




  $scope.time1 = new Date();
        
        $scope.time2 = new Date();
        $scope.time2.setHours(7, 30);

        $scope.showMeridian = true;
        
        $scope.disabled = false;



$scope.avisar = function(dia){

  if (dia.checked) {
    
  }


}


 $scope.formsubmit = function(id,isValid){
        
    



if (isValid) {


  var codigo_grupo = $scope.serie.codigo_grupo
  var obt_sede = $scope.person.id;   
  var observaciones = $scope.serie.observaciones;  

  if(obt_sede == undefined){

    obt_sede = 0;
    var sede = obt_sede;
 
  }
  else{
  var sede = obt_sede['id']
  }

  

 var datos ={
          codigo_grupo: codigo_grupo,
          sede: sede,    
          observaciones: observaciones            
        };


       let dias_horario = []

      $scope.dias.forEach(function (dia) {
        if(dia.inicio || dia.final){
          dias_horario.push(dia)

        }
      });
    
 $.ajax({
          url: base_api + '/postgrupo/actualizar/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            
            dias_horario,
            datos
        },
    
        }).success(function(){
         
            toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
            window.location="/admin/postgrupos#/admin/postgrupos";


        })
        .error(function() {
          console.log("successs");
        });
      }

     
   };



});
