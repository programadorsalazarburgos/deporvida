@extends('angular.frontend.master')
@section('title', 'Registro de personal')
@section('content')
<?php
$v='?v='.date('YmdHis');
?>
<style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
    }
    input[type=number] { -moz-appearance:textfield; }
    input{text-transform: uppercase;}
    .dir_format{
    width: 100%;
    }
    .row{
    padding-top: 10px;
    }
    .data_hide{
    display: none !important;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery.printPage.js"></script>
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
                url: base + '/Horario/eliminar/' + id,  
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
    function Guardar(id)
    {
        alert(id);
    }
function CargarRegistro() 
{
       var table = $("#table_hoja_vida").DataTable ({
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/personal/listado',
                    pageLength:$('#pagination_value').val(),
                    "columns" : 
                    [
                        { data : "fecha_registro", "title": "Fecha de registro"  },
                        {
                            data : "apellido_primero" , "title": "Nombres",
                            render:function (value,data,row) 
                            {
                                return (row.apellido_primero+' '+row.apellido_segundo+' '+row.nombre_primero+' '+row.nombre_segundo).toUpperCase();
                            }
                        },
                        { 
                            data : "documento" , "title": "Documento",
                            render:function (value) 
                            {
                                return value;
                            }
                        },
                        { data : "comunas", "title": "Comunas"  },
                        { 
                            data : "estado_cargo", "title": "Rol en el programa" ,
                            render : function(value)
                            {
                                return (''+value+'').toUpperCase();
                            }
                        },
                        {
                            data : "estado" , "title": "Estado" ,
                            render: function(value)
                            {
                                return (''+value+'').toUpperCase();
                            }
                        },
                        {
                            data: 'hoja_vida', "title": "Revisar", 
                            render:function (id) 
                            {
                                return '<a href="'+base+'/personal/verhojavida/'+id+'"><button class="btn btn-default"<i class="icon-user"></i> Ver hoja de vida</button></a>';
                            }
                        },
                        {
                            data: 'hoja_vida', "title": "Imprimir", 
                            render:function (id) 
                            {
                                return '<a href="'+base+'/hojavida/imp/'+id+'" class="btn btn-default" target="_blank"><i class="icon-print"></i> Imprimir</a>';
                            }
                        }
                    ]
                    
                });
            table.draw();
        $('.search_value').on('keyup', function () 
        {
        });
        $('.pagination_value').change(function()
        {
            table.page.length($('.pagination_value').val()).draw();
        });
}
                //$('.imp').printPage();
</script>



<div class="container">

    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Listado<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
        <table id="table_hoja_vida" class="table table-hover table-striped table-bordered table-advanced tablesorter">

        </table>
    </div>
</div>
@stop