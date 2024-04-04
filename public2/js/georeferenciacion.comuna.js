    function graficar(data)
    {
        var format_data=($('#tipo_grafico').val()=='pie')?'<b>{point.name}</b>: {point.percentage:.1f}%':'{point.y}';
        var colorByPoint=($('#tipo_grafico').val()=='column' || $('#tipo_grafico').val()=='bar');
        Highcharts.setOptions({
            lang: {
                numericSymbols: null//[' thousands', ' millions']
            }
        });
        Highcharts.chart('container', {
            chart: {
                type: $('#tipo_grafico').val()
            },
            title: {
                text: 'Registro de comuna '+id+' de Santiago de Cali'
            },
            subtitle: {
                text: 'Beneficiarios de disciplinas'
            },
            legend: {
                enabled: true
            },
            credits: {
                enabled: false
            },
            plotOptions: 
            {
                pie: 
                {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: 
                    {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: 
                        {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                },
                bar: {dataLabels: {enabled: true}},

            },
            xAxis:{categories: data.name},
            series: [{
                //dataLabels:{format: format_data},
                data: data.y,
                name: 'Beneficiarios',
                colorByPoint: colorByPoint,
                //allowPointSelect: true,
                dataLabels: {
                    enabled: true,
                    //rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: format_data,
                    y: 10,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    }
function Load_graficos()
{
    $.ajax({
        url:base+'/georreferenciacion/comunasdisciplinas/'+id,
        type:'GET',
        dataType:'json',
        success:function(data)
        {
            graficar(data.registros)
        }
    })
}





//=============================================ESCENARIOS=============================================//
    function graficar_escenarios(data)
    {
        var format_data=($('#tipo_grafico_Escenarios').val()=='pie')?'<b>{point.name}</b>: {point.percentage:.1f}%':'{point.y}';
        var colorByPoint=($('#tipo_grafico_Escenarios').val()=='column' || $('#tipo_grafico_Escenarios').val()=='bar');
        Highcharts.setOptions({
            lang: {
                numericSymbols: null//[' thousands', ' millions']
            }
        });
        Highcharts.chart('container_Escenarios', {
            chart: {
                type: $('#tipo_grafico_Escenarios').val()
            },
            title: {
                text: 'Registro de comuna '+id+' de Santiago de Cali'
            },
            subtitle: {
                text: 'Beneficiarios de escenarios'
            },
            legend: {
                enabled: true
            },
            credits: {
                enabled: false
            },
            plotOptions: 
            {
                pie: 
                {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: 
                    {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: 
                        {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                },
                bar: {dataLabels: {enabled: true}},

            },
            xAxis:{categories: data.name},
            series: [{
                //dataLabels:{format: format_data},
                data: data.y,
                name: 'Beneficiarios',
                colorByPoint: colorByPoint,
                //allowPointSelect: true,
                dataLabels: {
                    enabled: true,
                    //rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: format_data,
                    y: 10,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    }

function Load_graficos_escenarios()
{
        $.ajax({
        url:base+'/georreferenciacion/comunasxescenario/'+id,
        type:'GET',
        dataType:'json',
        success:function(data)
        {
            graficar_escenarios(data.registros)
        }
    })
}
//=============================================ESCENARIOS=============================================//
$(function()
{

    $('#tipo_grafico').change(function()
    {
        Load_graficos();
    });
    Load_graficos();


    $('#tipo_grafico_Escenarios').change(function()
    {
        Load_graficos_escenarios();
    });
    Load_graficos_escenarios();


})