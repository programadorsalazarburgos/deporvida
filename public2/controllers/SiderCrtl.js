SeriesApp.controller('SiderCrtl', function ($scope, $routeParams, $location, SiderService, $http, $timeout, base_api) {


$scope.title = "Sider Home";
$scope.series = [];

  $http.get(base_api + "/programas")
    .success(function(response){

    $scope.programas = response;
    console.log($scope.programas);

  });



$scope.toggle = function(modalstate) {
      $scope.modalstate = modalstate;
      switch(modalstate) {
          case 'VerDescripcion':
          $scope.form_title = "Formulario Rol";
          break;
       
      }

      $('#myModal').modal('show');
  }


var chart = AmCharts.makeChart("chartdiv", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  "dataProvider": [{
    "country": "DEPORVIDA",
    "visits": 3025,
    "color": "#FF0F00"
  }, {
    "country": "VIVIR SIN LIMITES",
    "visits": 1882,
    "color": "#FF6600"
  }, {
    "country": "DEPORTE ESCOLAR Y UNIVERSITARIO",
    "visits": 1809,
    "color": "#FF9E01"
  }, {
    "country": "DEPORTE ASOCIADO",
    "visits": 1322,
    "color": "#FCD202"
  }, {
    "country": "DEPORTE COMUNITARIO",
    "visits": 1122,
    "color": "#F8FF01"
  }, {
    "country": "CALINTEGRA",
    "visits": 1114,
    "color": "#B0DE09"
  }, {
    "country": "CUERPO Y ESPÍRITU",
    "visits": 984,
    "color": "#04D215"
  }, {
    "country": "CARRERAS Y CAMINATAS",
    "visits": 711,
    "color": "#0D8ECF"
  }, {
    "country": "VÍACTIVA",
    "visits": 665,
    "color": "#0D52D1"
  }, {
    "country": "VIVE EL PARQUE",
    "visits": 580,
    "color": "#2A0CD0"
  }, {
    "country": "CALI ACOGE",
    "visits": 443,
    "color": "#8A0CCF"
  }, {
    "country": "CALI SE DIVIERTE Y JUEGA",
    "visits": 441,
    "color": "#CD0D74"
  },
   {
    "country": "CANAS Y GANAS",
    "visits": 442,
    "color": "#CD0D74"
  },
  {
    "country": "MI COMUNIDAD ES ESCUELA",
    "visits": 441,
    "color": "#CD0D74"
  }],

  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left",
    "title": "Cantidad Beneficiarios"
  }],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>[[category]]: [[value]]</b>",
    "fillColorsField": "color",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "visits"
  }],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});





var chart_monitores = AmCharts.makeChart("chartdivmonitores", {
  "type": "pie",
  "startDuration": 0,
   "theme": "light",
  "addClassNames": true,
  "legend":{
    "position":"right",
    "marginRight":100,
    "autoMargins":false
  },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "200%",
      "height": "200%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 0,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
  "dataProvider": [{
    "country": "Fútbol",
    "litres": 50
  }, {
    "country": "Baloncesto",
    "litres": 30
  }, {
    "country": "Tenis",
    "litres": 201
  }, {
    "country": "Ciclismo",
    "litres": 165
  }, {
    "country": "Atletismo",
    "litres": 139
  }, {
    "country": "Voleibol",
    "litres": 128
  }, {
    "country": "Natación",
    "litres": 99
  }],
  "valueField": "litres",
  "titleField": "country",
  "export": {
    "enabled": true
  }
});

chart_monitores.addListener("init", handleInit);

chart_monitores.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});

function handleInit(){
  chart_monitores.legend.addListener("rollOverItem", handleRollOver);
}

function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}


var chart_usuarios = AmCharts.makeChart( "chartdivusuarios", {
  "type": "pie",
  "theme": "light",
  "dataProvider": [ {
    "country": "Monitores",
    "value": 260
  }, {
    "country": "Metodólogos",
    "value": 100
  } ],


  "valueField": "value",
  "titleField": "country",
  "outlineAlpha": 0.4,
  "depth3D": 15,
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 30,
  "export": {
    "enabled": true
  }
} );

});


