var tipo=0;
function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
function tabla(data)
{
	var html='';
	html+='<table class="table table-hover">';
	html+='<tr>';
	html+='<td>Descripcion</td>';
	html+='<td>Valor</td>';
	html+='</tr>';
	$.each(data,function(index,value)
	{
		html+='<tr>';
		html+='<td>'+value.name+'</td>';
		html+='<td>'+addCommas(value.data[0])+'</td>';
		html+='</tr>';
	})
	html+='<table>';
	$('#table_grafico').html(html);
}
function render(container,data_object,title,type_render)
	{
		tabla(data_object);
		$('#exampleModalLabel').html(title);
		var xAxis=[];
		if(
			type_render=='pie'
			||
			type_render=='semi_pie'
		)
		{
			var datatemp=[];
			$.each(data_object,function(index,value)
			{
				xAxis.push(value.name);
				datatemp.push({
					name:value.name,
					y:value.data[0]
				});
			});
			var temp=[{
				name: 'Valor',
				colorByPoint: true,
				data:datatemp,
			}];
			if(type_render=="semi_pie")
			{
				type_render='pie';
				temp.push({
					type:'pie',
					innerSize : '50%'
				});
			}
			data_object=temp;
		}
		else if(
			type_render=='line'
			||
			type_render=='spline'
		)
		{
			var datatemp=[];
			$.each(data_object,function(index,value)
			{
				xAxis.push(value.name);
				datatemp.push(value.data[0]);
			});
			var temp=[{
				name: title,
				data:datatemp,
			}];
			data_object=temp
		}
		else{
			xAxis=[title];
		}
		console.log(xAxis);
		Highcharts.chart(container,
		{
			exporting: {
				chartOptions: { // specific options for the exported image
					plotOptions: {
						series: {
							dataLabels: {
								enabled: true
							}
						}
					}
				},
				fallbackToExportServer: false
			},
		    chart: {
		        type: type_render,
			},
			credits: {
				enabled: false
			},
			xAxis: {
				categories: xAxis
			},
		    title: {
		        text: title
			},
			
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						format: '<b>{point.name}</b>: {point.percentage:.1f} %',
						style: {
							color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
						}
					}
				},
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: true
				},
				spline:{
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: true
				},
				bar:{
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: true
				},
				column:{
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: true
				},
			},
		    series:data_object,
			tooltip: 
			{
				formatter: function() 
				{
					var nStr=this.point.y;
					nStr += '';
					x = nStr.split('.');
					x1 = x[0];
					x2 = x.length > 1 ? '.' + x[1] : '';
					var rgx = /(\d+)(\d{3})/;
					while (rgx.test(x1)) {
						x1 = x1.replace(rgx, '$1' + ',' + '$2');
					}
					var y = x1 + x2;
			   		return this.series.name +  ': <b>' + y + '</b>';
           		}
    		}
		});
	} 
	function search()
	{
		$('#search').click(function(){filtrar()});
	}
	function export_pdf()
	{
		$('#exportar').hide();
		$('#exportar').click(function()
		{
			//html2canvas(document.querySelector("informes")).then(canvas => {document.body.appendChild(canvas)});
		});
	}
	function graficar_data()
	{
		$('#tipo_grafico').hide();
		$('#exampleModalLabel').html('');
		$('#container_grafico').html('<center><h3>Cargando </h3><br/><img src="'+base+'/images/loading.gif" style="width:100px !important"></center>');
		$('#exampleModal').modal('show');
		$.ajax({
			url:base+'/panelcontrol/datos',
			dataType:'json',
			success:function(data)
			{
				$("#container_grafico").html('');
				switch(tipo)
				{
					case 1://Beneficiarios atendidos durante el año
					$('#container_grafico').html('<h1 align="center">'+data.TotalBeneficiarios+' beneficiarios atendidos</h1>');
					break;
					case 2://Genero
						$('#tipo_grafico').val('pie');
						render('container_grafico',data.Generos,'Genero',$('#tipo_grafico').val())
					break;
					case 3://Nivel de escolaridad
						render('container_grafico',data.nivel_escolaridad,'Nivel de escolaridad',$('#tipo_grafico').val())
					break;
					case 4://Comuna de residencia
						render('container_grafico',data.Comunas_residencia,'Comunas de residencia',$('#tipo_grafico').val())
					break;
					case 5://Estratos socioeconomicos
						$('#tipo_grafico').val('bar');
						render('container_grafico',data.estratos_socioeconomicos,'Estratos socioeconomicos',$('#tipo_grafico').val())
					break;
					case 6://Cobertura por comuna de impacto
						render('container_grafico',data.cobertura_comuna_impacto,'Cobertura por comuna de impacto',$('#tipo_grafico').val())
					break;
					case 7://Cobertura por disciplina
						render('container_grafico',data.cobertura_disciplina,'Cobertura por disciplina',$('#tipo_grafico').val())
					break;
					case 8://Etnias
						render('container_grafico',data.etnias,'Etnias',$('#tipo_grafico').val())
					break;
					case 9://Discapacidad
						render('container_grafico',data.con_discapacidad,'Con discapacidad',$('#tipo_grafico').val())
					break;
					case 10://Corregimiento de residencia
						render('container_grafico',data.corregimiento_residencia,'Corregimiento de residencia',$('#tipo_grafico').val())
					break;
				}
				$('#tipo_grafico').show();
			},
			error:function(data)
			{
				$('#search').show();
			}
		});
	}
	function graf(thetipo)
	{
		tipo=thetipo;
		graficar_data();
	}
	$(function()
	{
		$('#tipo_grafico').change(function()
		{
			graficar_data();
		});
	});