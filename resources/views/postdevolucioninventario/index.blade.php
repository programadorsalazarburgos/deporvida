@extends('angular.frontend.master')
@section('title', 'Devoluciones')
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
                url: base + '/admin/devolucioninventario/' + id,  
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
                url: base + '/admin/inventario/cancelar/' + id,  
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
	
	function CargarRegistro() 
	{
       var table = $("#table_proveedores").DataTable ({
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/admin/devolucioninventario/listar',
                    "columns" : 
                    [
                        { data : "fecha", title: "Fecha"},
                        { data : "numero_documento", title: "Documento"},
                        { data : "contratista", title: "Contratista"},
                        { data : "rol", title: "Rol"},
                        { data : "comunas", title: "Comuna"},
                        { data : "estado", title: "Estado"},
                        {
                            data: 'id', "title": "Acciones", 
                            render:function (id) 
                            {
                                return '<a class="btn btn-sm btn-warning" href="'+base+'/admin/devolucioninventario/editar/'+id+'"><i class="fa fa-edit" title="Modificar"></i></a> <a class="btn btn-sm btn-danger" onclick="Eliminar('+id+')"><i class="fa fa-trash-o" title="Eliminar"></i></a><a class="btn btn-sm btn-default" title="Imprimir Acta Formal" onclick="Imprimir('+id+')" title="Imprimir Acta"><i class="fa fa-print"></i></a>';
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
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Devoluciones<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div>
    		<a class="btn btn-primary" href="{{ url('/admin/devolucioninventario/create') }}"><span class="fa fa-plus"></span> Nuevo</a>
    	</div>
    	<br>
        <table id="table_proveedores" class="table table-hover table-striped table-bordered table-advanced tablesorter">

        </table>
    </div>
</div>


@stop