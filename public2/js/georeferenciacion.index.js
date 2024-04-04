function theme()
{
    Highcharts.createElement('link', 
    {
        href: 'https://fonts.googleapis.com/css?family=Signika:400,700',
        rel: 'stylesheet',
        type: 'text/css'
    }, null, document.getElementsByTagName('head')[0]);
    Highcharts.wrap(Highcharts.Chart.prototype, 'getContainer', function (proceed) {
        proceed.call(this);
        this.container.style.background =
            'url('+base+'/images/sand.png)';
    });
    Highcharts.theme = {
        colors: ['#f45b5b', '#8085e9', '#8d4654', '#7798BF', '#aaeeee',
            '#ff0066', '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
        chart: {
            backgroundColor: null,
            style: {
                fontFamily: 'Signika, serif'
            }
        },
        title: {
            style: {
                color: 'black',
                fontSize: '16px',
                fontWeight: 'bold'
            }
        },
        subtitle: {
            style: {
                color: 'black'
            }
        },
        tooltip: {
            borderWidth: 0
        },
        legend: {
            itemStyle: {
                fontWeight: 'bold',
                fontSize: '13px'
            }
        },
        xAxis: {
            labels: {
                style: {
                    color: '#6e6e70'
                }
            }
        },
        yAxis: {
            labels: {
                style: {
                    color: '#6e6e70'
                }
            }
        },
        plotOptions: {
            series: {
                shadow: true
            },
            candlestick: {
                lineColor: '#404048'
            },
            map: {
                shadow: false
            }
        },

        // Highstock specific
        navigator: {
            xAxis: {
                gridLineColor: '#D0D0D8'
            }
        },
        rangeSelector: {
            buttonTheme: {
                fill: 'white',
                stroke: '#C0C0C8',
                'stroke-width': 1,
                states: {
                    select: {
                        fill: '#D0D0D8'
                    }
                }
            }
        },
        scrollbar: {
            trackBorderColor: '#C0C0C8'
        },

        // General
        background2: '#E0E0E8'

    };

    // Apply the theme
    Highcharts.setOptions(Highcharts.theme);
}
function format_data_map(data)
{
    var res=[];
    $.each(data.data,function(index,value)
    {
      if(value.path!=null)
      {
        var temp=
        {
            name: value.nombre_comuna,
            type: "map",
            dataLabels: {enabled: true,format: '<b>C '+value.codigo_comuna+'</b>'},
            tooltip: {
                pointFormat: 
                'Escenarios: '+value.escenarios_cantidad+
                '<br>Disciplinas:'+value.disciplina_cantidad+
                '<br>Monitores:'+value.monitores+
                '<br>Beneficiarios:'+value.beneficiarios
            },
            //animation: { duration: 50 },
            data: 
            [{
                name: ""+value.id+"",
                path: value.path
            }]
        };
        res.push(temp);
      }
    });
    return res;
}
function LoadMap()
{
  $.ajax({
    url:base+'/georreferenciacion/datamap',
    type:'GET',
    dataType:'json',
    success:function(data)
    {
      if(data.validate)
      {
        var res = format_data_map(data);
        $('#container').highcharts('Map',
        {
          title:
          {
            text: "<h1>Mapas de las comunas de<br>Santiago de Cali</h1>"
          },
          credits:false,
          exporting: {
                  sourceWidth: 600,
                  sourceHeight: 500
          },
          legend: {
            align: 'right',
            verticalAlign: 'top',
            layout: 'vertical',
            width: 120,
            height: 240
          },
          plotOptions:
          {
            series:
            {
              point:
              {
                events:
                {
                  click: function()
                  {
                    window.location.href = base+"/georreferenciacion/comunas/" + this.name;
                  }
                }
              }
            }
          },
          mapNavigation:
          {
            enabled: true
          },
          series: res
        });

      }
    }
  });
}
$(function ()
{
  theme();
  LoadMap();
});
$(window).load(function() 
{
    function labelsmaps()
    {
        $('g.highcharts-data-labels.highcharts-series-20 g').attr('transform','translate(529,300)');
        $('g.highcharts-data-labels.highcharts-series-13 g').attr('opacity','1').attr('visibility','');
    }
    window.setTimeout(labelsmaps, 2500 );
})