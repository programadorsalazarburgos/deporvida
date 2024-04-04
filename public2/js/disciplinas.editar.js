$(function()
{
	Guardar();
});
function Guardar()
{
	$('form').submit(function(e)
	{
		e.preventDefault();
		$.ajax({
			url:base+'/disciplinas/editar_registro',
			data:$(this).serialize(),
			type:'POST',
			dataType:'json',
			success:function(data)
			{
				if(data.validate)
				{
					swal("Guardado!", "Registro editado.", "success");					
				}
				else
				{
					swal("Cancelado", "Se ha presentado un error inesperado", "error");	
				}
			},
			error:function(data)
			{
				console.log(data);	
				swal("Cancelado", "Se ha presentado un error inesperado", "error");
			}
		});
	});
}