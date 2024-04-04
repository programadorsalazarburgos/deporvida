$(function()
{
	$('form').submit(function(e)
	{
		e.preventDefault();
		$.ajax({
			url:base+'/personal/saveobservaciones',
			data:$(this).serialize(),
			type:'POST',
			dataType:'json',
			success:function(data)
			{
				swal("Almacenado!", "Datos actualizados.", "success");
			},
			error:function(data)
			{
				console.log(data.responseText);
				swal("Error!", "Ocurrio un error al intentar guardar.", "error");
			}
		})
	});
})