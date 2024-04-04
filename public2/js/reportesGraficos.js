    var obtenerMes = function(){

            var d = new Date();
            var n = d.getFullYear();


mes = $('#meses').val();
var variable = (n + "-" + mes);
var combo = document.getElementById("meses");
var nombreMes = combo.options[combo.selectedIndex].text;


$.ajax({
    url: base + '/reportesGraficos/save',
    type: 'POST',
    dataType: 'JSON',
    data: {param1: variable, param2: nombreMes},
}).success(function(data){

console.log(data.compras);

var data_compras = data.compras;
var data_ventas = data.ventas;
var data_nombreMes = data.nombreMes;
var data_ganancias = [(parseFloat(data_ventas) - parseFloat(data_compras))];


var compras = $("#compras").empty();
compras.append("$", data_compras);
var ventas = $("#ventas").empty();
ventas.append("$", data_ventas);
var ganancias = $("#ganancias").empty();
ganancias.append("$", data_ganancias);




Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Datos Estadisticos Mi Empresa'
    },
    xAxis: {
        categories: [data_nombreMes]
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'COMPRAS',
        data: data_compras
    }, {
        name: 'VENTAS',
        data: data_ventas
    }, {
        name: 'GANANCIA',
        data: data_ganancias
    }]
});


})
.done(function() {
    console.log("success");
})
.fail(function() {
    console.log("error");
})
.always(function() {
    console.log("complete");
});






    }
