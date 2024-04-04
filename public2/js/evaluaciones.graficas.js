function render(container, data_object, title, type_render) {
	var xAxis = [];
	if (
		type_render == 'pie'
		||
		type_render == 'semi_pie'
	) {
		var datatemp = [];
		$.each(data_object, function (index, value) {
			xAxis.push(value.name);
			datatemp.push({
				name: value.name,
				y: value.data[0]
			});
		});
		var temp = [{
			name: 'Valor',
			colorByPoint: true,
			data: datatemp,
		}];
		if (type_render == "semi_pie") {
			type_render = 'pie';
			temp.push({
				type: 'pie',
				innerSize: '50%'
			});
		}
		data_object = temp;
	}
	else if (
		type_render == 'line'
		||
		type_render == 'spline'
	) {
		var datatemp = [];
		$.each(data_object, function (index, value) {
			xAxis.push(value.name);
			datatemp.push(value.data[0]);
		});
		var temp = [{
			name: title,
			data: datatemp,
		}];
		data_object = temp
	}
	else {
		xAxis = [title];
	}
	Highcharts.chart(container,
		{
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
				}
			},
			series: data_object,
			tooltip:
			{
				formatter: function () {
					var nStr = this.point.y;
					nStr += '';
					x = nStr.split('.');
					x1 = x[0];
					x2 = x.length > 1 ? '.' + x[1] : '';
					var rgx = /(\d+)(\d{3})/;
					while (rgx.test(x1)) {
						x1 = x1.replace(rgx, '$1' + ',' + '$2');
					}
					var y = x1 + x2;
					return this.series.name + ': <b>' + y + '</b>';
				}
			}
		});
}
function reporte() {
	$('#graficar').html('<center><H1>GRAFICANDO</H1></center>');
	$.ajax({
		url: base + '/evaluaciones/index',
		data: $('form').serialize(),
		type: 'GET',
		dataType: 'json',
		success: function (data) {
			$('#graficar').html('');
			$(data.data).each(function (index, value) {
				var container = 'grafico_' + value.id;
				var html = '';
				html += '<div class="col-sm-6">';
				html += '  <div class="thumbnail">';
				//'	<img src="..." alt="...">'+
				html += '	<div class="caption">';
				//'	  <h3>Thumbnail label</h3>'+
				html += '	  <div id="' + container + '"></div>';
				//'	  <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>'+
				html += '	</div>';
				html += '  </div>';
				html += '</div>';
				
				//$('#graficar').append('<div class="col-md-6" id="'++'"></div>')
				$('#graficar').append(html)
				render(container, value.data, value.indicador, $('#grafico').val());
			})
		}
	})
}
$(function () {
	$('#render').validate()
	$('form').submit(function (e) {
		e.preventDefault();
		if ($(this).valid()) {
			reporte();
		}
	})
	$('#tipo').change(function () {
		$('#id_EvaluacionesPlazosyperiodos').val('');
		$('#id_EvaluacionesPlazosyperiodos option').show();
		$('#id_EvaluacionesPlazosyperiodos option[data-tipo=' + $('#tipo').val() + ']').hide();
	});
})
