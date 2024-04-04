function guardar()
{
	$('form').submit(function(e)
	{	
		$('#submit_button').attr('disabled','disabled')
		e.preventDefault();
		$.ajax({
			url:base+'/implementos/save',
			type:'POST',
			data:$(this).serialize(),
			dataType:'json',
			success:function(data)
			{
				if(data.validate)
				{
					swal("Felicidades!", "Tus Datos han sido Almacenados!", "success");
				}
				else
				{
					swal("Error", "No se ha podido guardar los datos. Error inexperado", "error");					
				}
			},
			error:function(error,data,type)
			{
				swal("Error", "No se ha podido guardar los datos. Error inexperado", "error");
				console.log(error,data,type);
			}
		});
	});

}
$(function()
{
	guardar();
});