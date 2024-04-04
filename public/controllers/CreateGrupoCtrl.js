  SeriesApp.controller("CreateGrupoCtrl", function($scope, GrupoService, fileUpload, $http, $location, base_api, $q){
    $scope.title = "Agregar Grupo";
    $scope.disable_submit = false;

    $scope.serie = {};



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


    $http.get(base_api + "/obtenercount/grupos")
    .success(function(response){

      var numero = [response];

      var largo_numero = numero.length;
      var largo_maximo = 4;
      var agregar = largo_maximo - largo_numero;
      
      for(i =0; i<agregar; i++){
        numero = "0"+numero;
     // console.log(numero);

   }


   $http.get(base_api + "/obtener/monitores")
   .success(function(response)
   {
    $scope.monitores=response;
    console.log($scope.monitores);
  });





   $scope.codigo_grupo = numero;

 });



    $http.get(base_api + "/obtenerselect/sedes")
    .success(function(response){

      $scope.people = response;

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

      $scope.addItem = function() {
        $scope.items.push({id: $scope.items.length, text: 'item '+$scope.items.length});
      };

      $scope.removeItem = function() {
        $scope.items.pop();
      };  

      $scope.changeItems = function() {
      //$scope.items[0].id = 123;
      $scope.items[0].text = 'item 123';
      $scope.items1[0] = 'item 123';
    };    

    $scope.reorder = function() {
      var t = $scope.items[2];
      $scope.items[2] = $scope.items[3];
      $scope.items[3] = t;
    };

    $scope.check = function() {
      $scope.user.values1 = [1,4];
    };



    $scope.dias = [
    {id: 'lunes'},
    {id: 'martes'},
    {id: 'miercoles'},
    {id: 'jueves'},
    {id: 'viernes'},

    ];
    


    $scope.time1 = new Date();

    $scope.time2 = new Date();
    $scope.time2.setHours(7, 30);
    $scope.showMeridian = true;

    $scope.disabled = false;

    
    $scope.formsubmit = function(isValid) 
    {

     if (isValid) 
     {
      let dias_horario = []
      $scope.dias.forEach(function (dia) 
      {
        if(dia.inicio || dia.final){
          dias_horario.push(dia)
        }
      });

      console.log($scope);
      var observaciones = $scope.observaciones;   


      $.ajax({
        url: base_api + '/postgrupo/create',
        type: 'POST',
        dataType: 'JSON',
        data: {
          codigo_grupo: $scope.codigo_grupo,
          id_monitor: $scope.id_monitor,
          observaciones: observaciones,
          dias_horario
        },

      }).success(function(){

        toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
        window.location="/admin/postgrupos#/admin/postgrupos";


      })
      .error(function() {
        console.log("success");
      });
    }
  }
}); 



















