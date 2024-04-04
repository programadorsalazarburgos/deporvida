function ver_horario()
{
	$('#id_grupo').change(function()
	{
		var data_input=$(this).find('option:selected').attr('data-horario');
		console.log(data_input);
		$('#horario_label').html(data_input);
	});
}
function buscar_ajax()
{
	$.ajax({
		url:base+'/novedad/misgrupos',
		type:'POST',
		dataType:'json',
		data:{fecha:$('#fecha_reportar').val()},
		success:function(data)
		{
			if(data.validate)
			{
				$('#horario_label').html('');
				$('#id_grupo').html(data.html);
			}
		}
	})
}
function buscar_grupos()
{
	$('#fecha_reportar').change(function()
	{
		buscar_ajax()
	});
}
function guardar()
{
	$('#form').submit(function(e)
	{
		e.preventDefault();
		$.ajax({
			url:$('#form').attr('action'),
			type:$('#form').attr('method'),
			data:$('#form').serialize(),
			dataType:'json',
			success(data)
			{
				if(data.validate)
				{
					swal("Guardado!", "Novedad enviada", "success");
				}
				else
				{
					swal("Error!", data.msj, "error");
				}
			}
		});
	});
}
function opciones()
{
	$('#id_novedad_tipo').change(function(e)
	{
		var f = new Date();
		var fecha_actual=
		f.getFullYear()+'-' +
		(f.getMonth() +1) + '-' +
		f.getDate();

		switch($('#id_novedad_tipo').val())
		{
			case '1'://Cancelacion de clases
			var fecha = (new Date(fecha_actual));
			var dias = 1;
			fecha.setDate(fecha.getDate() + dias);


			$("#fecha_reportar").datepicker('destroy').datepicker({ minDate: 0, maxDate:fecha, dateFormat: 'yy-mm-dd' }).val('').removeAttr('readonly');
			buscar_ajax();
			break;
			case '2'://Cambiar de escenario
			var fecha = (new Date(fecha_actual));
			var dias = 1;
			fecha.setDate(fecha.getDate() + dias);


			$("#fecha_reportar").datepicker('destroy').datepicker({ minDate: 0, maxDate:fecha, dateFormat: 'yy-mm-dd' }).val('').removeAttr('readonly');
			break;
			case '3'://Incapacidades
			var fecha = (new Date(fecha_actual));
			var dias = 1;
			fecha.setDate(fecha.getDate() + dias);


			$("#fecha_reportar").datepicker('destroy').datepicker({ minDate: 0, maxDate:fecha, dateFormat: 'yy-mm-dd' }).val('').removeAttr('readonly');
			break;
			case '4'://Permisos
			$("#fecha_reportar").datepicker('destroy').datepicker({ minDate: 0, dateFormat: 'yy-mm-dd' }).val('').removeAttr('readonly');
			break;
		}
	});
}
$(function()
{
	opciones();
	ver_horario();
	buscar_grupos();
	guardar();
})
