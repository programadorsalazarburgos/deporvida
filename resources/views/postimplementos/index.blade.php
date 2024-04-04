@extends('angular.frontend.master')
@section('title', 'Implementos')
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
                url: base + '/admin/implementos/' + id,
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



	function CargarRegistro()
	{
       var table = $("#table_clasificaciones").DataTable ({
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/admin/implementos/listar',
                    "columns" :
                    [
                        { data : "nombre_clasificacion", title: "Clasificación"},
                        { data : "nombre", title: "Nombre Implemento"},
                        { data : "nombre_proveedor", title: "Proveedor"},
                        { data : "stock", title: "Cantidad Inicial"},
                        { data : "cantidad_actual", title: "Cantidad actual"},

                        {
                            data: 'id', "title": "Acciones",
                            render:function (id)
                            {
                                return '<a class="btn btn-sm btn-warning" href="'+base+'/admin/implementos/editar/'+id+'" title="Modificar"><i class="fa fa-edit"></i></a> <a class="btn btn-sm btn-danger" onclick="Eliminar('+id+')" title="Eliminar"><i class="fa fa-trash-o"></i></a>';
                            }
                        }

                    ]
                });
            table.draw();
    }
</script>


<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Implementos Deportivos<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div>
    		<a class="btn btn-primary" data-toggle="modal" href="{{ url('/admin/implementos/create') }}" ><span class="fa fa-plus"></span> Nuevo</a>
            <a class="btn btn-primary" data-toggle="modal" href="{{ url('/admin/entradainventario/create') }}" ><span class="fa fa-plus"></span> Crear Entrada</a>
            <a class="btn btn-success" data-toggle="modal" href="{{ url('/admin/entradainventario') }}" ><span class="fa fa-plus"></span> Ver Entradas</a>
        </div>
    	<br>
        <table id="table_clasificaciones" class="table table-hover table-striped table-bordered table-advanced tablesorter">
        </table>
    </div>
</div>

@stop
