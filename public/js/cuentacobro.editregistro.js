var myEditor1;
var myEditor2;
var idx=0;
function other_photo()
{
	idx=idx+1;
	var data = '<div class="col-sm-12">'+
					'<input title="Se deben subir las imágenes en este campo" type="file" name="fotos['+idx+']" required="required"/>'+
				'</div>'+
				'<label class="col-sm-2 control-label"><i class="text-danger">*</i> Lugar // informe mensual</label>'+
				'<div class="col-sm-10">'+
					'<input class="form form-control" value="OFICINA DEPORVIDA" id="lugar" title="Lugar // informe mensual" name="lugar['+idx+']" required="required"/>'+
				'</div>';
	$('#photos').after(data);
}
function registro()
{
	$('#form').submit(function (e)
	{
		e.preventDefault();
		if ($(this).valid())
		{
			var data = new FormData(document.getElementById("form"));
			data.append('tareas_mensuales', myEditor1.instanceById('textarea1').getContent());
			data.append('tareas_supervisor', myEditor2.instanceById('textarea2').getContent());
			$.ajax(
			{
				url: base + '/cdp/savecuentacobro',
				type: 'POST',
				dataType: 'json',
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				type: 'POST',
				success: function (data)
				{
					var Cuota = $('#Cuota').val();
					swal("Cuenta de cobro registrada", "Se ha registrado la cuenta del cobro.");
					$('#informes').show();
					$('#inf1').attr('href', base + '/cdp/inf1/' + data.id);
					$('#inf2').attr('href', base + '/cdp/inf2/' + data.id);
					$('#inf3').attr('href', base + '/cdp/inf3/' + data.id);
				},
				error: function (data)
				{
					console.log(data);
				}
			})
		}
	});
}
$(function ()
{
	bkLib.onDomLoaded(function ()
	{
		myEditor1 = new nicEditor(
		{
			buttonList: ['ul', 'bold', 'italic', 'underline']
		}).panelInstance('textarea1');
		myEditor2 = new nicEditor(
		{
			buttonList: ['ul', 'bold', 'italic', 'underline']
		}).panelInstance('textarea2');
	});
	$('#informes').hide();
	registro();
	$('form').validate()
});
function eliminar(id)
{
    $.ajax({url:base+'/cdp/fotodelete',data:{id:id},success:function(data){$('#id_'+id).html('');}});
}