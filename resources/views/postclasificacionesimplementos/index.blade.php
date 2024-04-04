@extends('angular.frontend.master')
@section('title', 'Clasificaciones')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('datatables/datatables.min.css') }}"/>

<script type="text/javascript" src="{{ asset('datatables/datatables.min.js') }}"></script>

<script>
    $(function()
    {
        CargarRegistro();

    });
	
    function guardar()
    {
    
    var parametros= {
        "nombre" : $("input#nombre").val(),
        "observaciones" : $("input#observaciones").val()
    };

    $.ajax({
        url: base + '/admin/clasificaciones/save',
        type: 'POST',
        data: parametros,
        success: function (data)
        {
            $('body,html').animate({scrollTop: 0}, 500);
            swal("Almacenado!", "Proveedor Guardado.", "success");
            CargarRegistro();

            //window.location = base + '/admin/proveedor';
        }
    });

    }

    $("#guardar_clasificacion").on("click", ".modalForm", function()        
    {
            e.preventDefault();
            alert($(this).serialize());
            /*$.ajax({
                url: base + '/admin/proveedor/save',
                type: 'POST',
                data: $(this).serialize(),
                success: function (data)
                {
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Almacenado!", "Proveedor Guardado.", "success");
                    window.location = base + '/admin/proveedor';
                }
            });*/ 
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
                url: base + '/admin/clasificaciones/' + id,  
                type: 'DELETE',
                dataType: 'JSON',
            }).success(function(response)
            {
                swal("Eliminado!", "Clasificación Eliminada.", "success");
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
                    ajax:base+'/admin/clasificaciones/listar',
                    "columns" : 
                    [
                        { data : "nombre", title: "Nombres"},
                        { data : "observaciones", title: "Observaciones"},
                        {
                            data: 'id', "title": "Acciones", 
                            render:function (id) 
                            {
                                return '<a class="btn btn-sm btn-warning" href="'+base+'/admin/clasificaciones/editar/'+id+'" title="Modificar"><i class="fa fa-edit"></i></a> <a class="btn btn-sm btn-danger" onclick="Eliminar('+id+')" title="Eliminar"><i class="fa fa-trash-o"></i></a>';
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
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Clasificaciones de Implementos<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div>
    		<a class="btn btn-primary" data-toggle="modal" href="{{ url('/admin/clasificaciones/create') }}" ><span class="fa fa-plus"></span> Nuevo</a>
        </div>
    	<br>
        <table id="table_clasificaciones" class="table table-hover table-striped table-bordered table-advanced tablesorter">
        </table>
    </div>
</div>


@stop