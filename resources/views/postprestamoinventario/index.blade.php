@extends('angular.frontend.master')
@section('title', 'Prestamo')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('datatables/datatables.min.css') }}"/>
<script type="text/javascript" src="{{ asset('datatables/datatables.min.js') }}"></script>
<script>
    $(function()
    {
        CargarRegistro();

    });
	
	function Eliminar(id)
    {
        swal({
            title: "Estas seguro?",
            text: "No podrá recuperar este archivo!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Eliminado!",
            cancelButtonText: "No, lo Elimines!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) 
        {
            if (isConfirm) 
            {
                $.ajax({
                    url: base + '/admin/prestamoinventario/' + id,  
                    type: 'DELETE',
                    dataType: 'JSON',
                }).success(function(response)
                {
                    swal("Eliminado!", "Registro Eliminado.", "success");
                    CargarRegistro();
                });
            }
            else
            {
                swal("Cancelado", "No elimino su registro", "error");
            }
        });
    }
 
    function Cancelar(id)
    {
        swal({
        title: "Estas seguro?",
        text: "Cambiará el estado del prestamo!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si!",
        cancelButtonText: "No!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) 
    {
        if (isConfirm) 
        {
            $.ajax({
                url: base + '/admin/prestamoinventario/cancelar/' + id,  
                type: 'GET',
                dataType: 'JSON',
            }).success(function(response)
            {
                swal("Actualizado!", "Prestamo Cancelado.", "success");
                CargarRegistro();
            });
        }
        else
        {
            swal("Cancelado", "No cambio de estado el prestamo", "error");
        }
    });
    }
	

    function cambiaEstado(id,estado)
    {
        swal({
        title: "Estas seguro?",
        text: "Cambiará el estado del prestamo!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si!",
        cancelButtonText: "No!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) 
    {
        if (isConfirm) 
        {
            $.ajax({
                url: base + '/admin/prestamoinventario/cambiarEstado/'+id+'/'+estado,  
                type: 'GET',
                dataType: 'JSON',
            }).success(function(response)
            {
                swal("Actualizado!", "Estado del Prestamo Cambiado.", "success");
                CargarRegistro();
            });
        }
        else
        {
            swal("Cancelado", "No cambio de estado el prestamo", "error");
        }
    });
    }

	function CargarRegistro() 
	{
       var table = $("#table_proveedores").DataTable ({
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/admin/prestamoinventario/listar',
                    "columns" : 
                    [
                        { data : "fecha", title: "Fecha"},
                        { data : "contratista", title: "Contratista"},
                        { data : "rol", title: "Rol"},
                        { data : "comunas", title: "Comuna"},
                        { data : "implementos", title: "Prestamo"},
                        { data : "estado", title: "Estado"},
                        {
                            data: 'id', "title": "Acciones", 
                            render:function (data, type, row, id) 
                            {
                                var html='';
                                if(row['estado']=='ENTREGADO')
                                {
                                    html='<div class="btn-group pull-right">'+
                                     '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>'+
                                         '<ul class="dropdown-menu">'+
                                             '<li>'+
                                                '<a title="Imprimir Acta Formal" onclick="Imprimir('+row['id']+')"><i class="fa fa-print"></i> Imprimir acta formal</a>'+
                                             '</li>'+
                                         '</ul>'+
                                      '</div>';
                                }
                                else
                                {
                                    html='<div class="btn-group pull-right">'+
                                     '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>'+
                                         '<ul class="dropdown-menu">'+
                                             '<li>'+
                                                '<a  href="'+base+'/admin/prestamoinventario/editar/'+row['id']+'"><i class="fa fa-edit"></i> Editar</a> '+
                                             '</li>'+
                                             '<li>'+
                                                '<a onclick="Eliminar('+row['id']+')"><i class="fa fa-trash-o"></i> Eliminar</a> '+
                                             '</li>'+
                                             '<li>'+
                                                '<a title="Cambia Estado a Entregado" onclick="cambiaEstado('+row['id']+',1)"><i class="fa  fa-check-square"></i> Cambiar a entregado</a> '+
                                             '</li>'+
                                             '<li>'+
                                                '<a title="Cancelar Prestamo" onclick="Cancelar('+row['id']+')"><i class="fa  fa-times-circle"></i> Cancelar prestamo</a> '+
                                             '</li>'+
                                             '<li>'+
                                                '<a title="Imprimir Acta Formal" onclick="Imprimir('+row['id']+')"><i class="fa fa-print"></i> Imprimir acta formal</a>'+
                                             '</li>'+
                                         '</ul>'+
                                      '</div>';
                                }

                                return html;
                            }
                        }
                        
                    ]
                });
            table.draw();
}
                //$('.imp').printPage();
</script>


<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Prestamo<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div>
    		<a class="btn btn-primary" href="{{ url('/admin/prestamoinventario/create') }}"><span class="fa fa-plus"></span> Nuevo</a>
    	</div>
    	<br>
        <table id="table_proveedores" class="table table-hover table-striped table-bordered table-advanced tablesorter">

        </table>
    </div>
</div>


@stop