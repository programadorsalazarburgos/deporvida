SeriesApp.controller('LocalizacionInstitucionCtrl', function ($scope, $routeParams, $location, LocalizacionService, $http, $timeout, base_api) {


$scope.title = "Localizacion Institución";
$scope.comuna = $routeParams.id;
$scope.instituciones = [];


    $http.get(base_api + "/admin/postlocalizacion_instituciones/" + $routeParams.id)
    .success(function(response){

      $scope.instituciones = response;
      console.log($scope.instituciones);
    
     var self;
  
  $scope.data = data = [
    {
        "key": "Cantidad Sedes",
        "values": $scope.instituciones
    }]

  $scope.options = {
            chart: {
                type: 'multiBarChart',
                height: 400,
                width: 400,
                x: function(d){return d.label;},
                y: function(d){return d.value;},
                showControls: true,
                showValues: true,
                   labels: {
        items: [{
            html: 'Total fruit consumption',
            style: {
                left: '50px',
                top: '18px',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
            }
        }]
    },
                // xAxis: {
                //     showMaxMin: false
                // },
                yAxis: {
                    axisLabel: 'Values',
                    tickFormat: function(d){
                        return d3.format(',.2f')(d);
                    }
                },
                multibar: {
                  dispatch: {
                    renderEnd: function (e) {
                      // d3.select(self.container).selectAll('.nv-bar').attr('width', 40);
                      // console.log('this fires each time window is resized')
                    }
                  }
                },
                callback: function (chart) {
                  self = chart;
                  
                  d3.selectAll('.nv-bar').attr('width', 40);
                  
                  return chart;
                }
            }
        };

 });



$scope.selectedValue = "INFORMACIÓN.";


$scope.instituciones2 = [];


      $scope.events = {
        dataplotclick: function(ev, props) {
    

          $scope.$apply(function() {

            $scope.colorValue = "background-color:" + props.categoryLabel + ";";
            $scope.selectedValue = "Institución " + props.categoryLabel + " cantidad de sedes " + props.dataValue;
          });
        }
      };

 $http.get(base_api + "/admin/postlocalizacion_institucion/" + $routeParams.id)
    .success(function(response){

      $scope.instituciones2.push(response);


});



   
      $scope.dataSource = {
        "chart": {
          "caption": "INSTITUCIONES COMUNA " + $routeParams.id,
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
          "toolTipSepChar": " Sedes ",

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



        "data": $scope.instituciones2
      };






});



