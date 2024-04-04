function reasignar(id_usuario, nombre,comuna_impacto)
{
	$('#id_comuna').val(comuna_impacto);
	$('#myModal').modal('show');
	$('#id_usuario').val(id_usuario);
	$('#name').html(nombre);

	console.log(id_usuario);
}
function reasignarbutton()
{
	$('#button_change').click(function()
	{
		$.ajax({
			url:base+'/reasignar/change',
			type:'POST',
			data:{id_usuario:$('#id_usuario').val(),id_comuna:$('#id_comuna').val()},
			success:function(data)
			{
				swal("El metodologo ha sido reasignado", "Metodologo reasignado.", "success");
				$('#myModal').modal('hide');
				load_data();

			}
		})
	})
}
function load_data()
{
	table = $('#example').DataTable ({
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/metodologos/data',
                    columns : 
                    [
	                    {
                            data: 'nombre_comuna', "title": "Comuna de impacto", 
                            render:function (value,type,row) 
                            {
                                return value;
                            }
                        },
                       {
                            data: 'apellido_primero', "title": "Metodologo", 
                            render:function (value,type,row) 
                            {
                                return row.apellido_primero+' '+row.apellido_segundo+' '+row.nombre_primero+' '+row.nombre_segundo;
                            }
                        },
                        {
                            data: 'documento', "title": "Documento", 
                            render:function (value,type,row) 
                            {
                                return value;
                            }
                        },
                        {
                            data: 'codigo_grupo', "title": "Grupos", 
                            render:function (value,type,row) 
                            {
                                return value;
                            }
                        },
                        {
                            data: 'codigo_grupo', "title": "Opciones", 
                            render:function (value,type,row) 
                            {
                            	var html='';
                            	var nombre = row.apellido_primero+' '+row.apellido_segundo+' '+row.nombre_primero+' '+row.nombre_segundo;
                            	if(row.id_comuna_impacto===0)
                            	{
                            		html='<button onclick="reasignar('+row.id_usuario+',\''+nombre+'\',0)" type="button" class="btn btn-warning">'+
                            				'<i class="glyphicon glyphicon-resize-full"></i>'+
                            				'Asignar'+
                            				'</button>';
                            	}
                            	else
                            	{
									html='<button onclick="reasignar('+row.id_usuario+',\''+nombre+'\','+row.id_comuna_impacto+')" type="button" class="btn btn-danger">'+
                            				'<i class="glyphicon glyphicon-resize-full"></i>'+
                            				'Reasignar'+
                            				'</button>';	
                            	}
                                return html;
                            }
                        }
                    ]
                });
}
$(function()
{
	load_data();
	reasignarbutton();
	//var table=    $('#example').DataTable({"ordering": false});
});