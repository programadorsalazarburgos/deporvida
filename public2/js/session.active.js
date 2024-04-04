function consultar()
{
	$.ajax({
		url:base+'/session',
		dataType:'json',
		success:function(data)
		{
			if(data.login==='stop')
			{
				swal("Sesion cerrada", "Se ha cerrado su sesión, por favor vuelva a iniciar sesión", "error");
				window.setInterval(function(){window.location.href = base;},2000);
			}
		}
	});
}
$(function()
{
	if(base+'/personal/create'!=window.location.href)
	{
		//consultar();
		//setInterval('consultar()',10000);
	}
});