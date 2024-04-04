SeriesApp.controller('LocalizacionInstitucionSedeCtrl', function ($scope, $routeParams, $location, LocalizacionInstitucionService, $http, $timeout, base_api) {


$scope.title = "Localizacion Institución Sede";
$scope.institucion = $routeParams.id;
$scope.serie = LocalizacionInstitucionService.get({id:$routeParams.id});
//console.log($scope.serie);



$scope.instituciones = [];


    $http.get(base_api + "/admin/postlocalizacion_institucion_sede/" + $routeParams.id)
    .success(function(response){

      $scope.instituciones = response;
      console.log($scope.instituciones);


  
 var suma = 0; 
for (var i = 0; i < $scope.instituciones.length; i++) {
      suma = suma + $scope.instituciones[i].value;
  }
  $scope.total_estudiantes = suma;
 });


$scope.selectedValue = "INFORMACIÓN.";


$scope.sedes_bar= [];


      $scope.events = {
        dataplotclick: function(ev, props) {
    

          $scope.$apply(function() {

            $scope.colorValue = "background-color:" + props.categoryLabel + ";";
            $scope.selectedValue = "Sede " + props.categoryLabel + " cantidad de estudiantes " + props.dataValue;
          });
        }
      };

 $http.get(base_api + "/admin/postlocalizacion_institucion_sede/" + $routeParams.id)
    .success(function(response){

     $scope.sedes_bar.push(response);
     //console.log(response);

});


      $scope.dataSource = {
        "chart": {
          "caption": "ESTADÍSTICAS POR SEDE",
          "captionFontSize": "16",
          "captionPadding": "25",
          "baseFontSize": "14",
          "canvasBorderAlpha": "0",
          "showPlotBorder": "0",
          "placevaluesInside": "1",
          "valueFontColor": "#2C3E50",
          "captionFontBold": "0",
          "bgColor": "white",  ///fondo 
          "divLineAlpha": "50",
          "plotSpacePercent": "10",
          "bgAlpha": "95",
          "canvasBgAlpha": "0",
          "outCnvBaseFontColor": "#2C3E50",
          "showValues": "0",
          "baseFont": "Open Sans",
          "paletteColors": "#6495ED, #FF6347, #90EE90, #FFD700, #FF1493",
          "theme": "zune",
          
          // tool-tip customization
          "toolTipBorderColor": "#2C3E50",
          "toolTipBorderThickness": "1",
          "toolTipBorderRadius": "2",
          "toolTipBgColor": "#000000",
          "toolTipBgAlpha": "70",
          "toolTipPadding": "12",
          "toolTipSepChar": " Estudiantes ",

          // axis customization
          "xAxisNameFontSize": "16",
          "yAxisNameFontSize": "16",
          "xAxisNamePadding": "10",
          "yAxisNamePadding": "10",
          // "xAxisName": "Colors",
          "yAxisName": "Valores",
          "xAxisNameFontBold": "0",
          "yAxisNameFontBold": "0",
          "showXAxisLine": "1",
          "xAxisLineColor": "#999999",

        },



        "data": $scope.sedes_bar
      };






});



