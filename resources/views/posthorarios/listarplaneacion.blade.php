@extends('angular.frontend.master')
@section('title', 'Planeacion')
@section('content')
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
       var table = $("#table_planeacion").DataTable ({
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/Horarios/misplanificaciones',
                    pageLength:$('#pagination_value').val(),
                    "columns" : [

                        { "data" : "disciplina" , "title": "Disciplina" },
                        { "data" : "nombre_escenario" , "title": "Escenario" },
                        { "data" : "codigo_grupo" , "title": "Codigo" },
                        { "data" : "fecha", "title": "Fecha"  },
                        { "data" : "dia", "title": "Dia"  },
                        { "data" : "hora_inicio" , "title": "Inicio" },
                        { "data" : "hora_fin" , "title": "Fin" },
                        {
                            data: 'id', "title": "Opciones", 
                            render:function (id_grupo) 
                            {
                                return '<div class="btn-group pull-right">'+
                                '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>'+
                                '    <ul class="dropdown-menu">'+
                                '        <li>'+
                                '           <a href="Horarios/planificacion/'+id_grupo+'"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>'+
                                //'            <a href="#'+base+'/Horario/Editar/'+id_grupo+'"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>'+
                                '        </li>'+
                                '<!--'+
                                '        <li>'+
                                '           <a onclick="Guardar('+id_grupo+')"><i class="fa fa-save"></i>&nbsp;Guardar</a>'+
                                '        </li>'+
                                '-->'+
                                '        <li>'+
                                '            <a class="imp" href="'+base+'/Horarios/planeacion/'+id_grupo+'"><i class="fa fa-print"></i>&nbsp;Imprimir</a>'+
                                '        </li>'+
                                '        <li>'+
                                '            <a onclick="Eliminar('+id_grupo+')"><i class="fa fa-trash-o"></i>&nbsp;Eliminar planeacion</a>'+
                                '        </li>'+
                                '    </ul>'+
                                '</div>';
                                $('.imp').printPage();
                            }
                        }
                    ]
                });
        $('.search_value').on('keyup', function () 
        {
            table.search(this.value).draw();
        });
        $('.pagination_value').change(function()
        {
            $('#table_planeacion_length').hide();
            table.page.len($('.pagination_value').val()).draw();
            console.log(table.rows().count());
        });
}
                //$('.imp').printPage();
</script>
<style>
#table_planeacion_length,#table_planeacion_filter{
    display: none;
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
#id_grupo, #id_grupo option 
{
    font-family: Consolas, monospace;
}
input[type=number] { -moz-appearance:textfield; }
    .table{
        margin-bottom: 0px !important;
    }
    table tr td,table tr th{
        vertical-align:middle !important;
    }
    table tr td,table tr th{
        text-align: center !important;
    }
</style>

<div class="page-content">
    <div id="tab-general">
        <div id="sum_box" class="row mbl">
            <section>
                <div class="container">
                    <!-- ngView: undefined --><ng-view class="ng-scope"><section class="content ng-scope">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal ng-pristine ng-invalid ng-invalid-required ng-valid-time ng-valid-maxlength" id="form" >
                                        <div class="nav-tabs-custom">

    

<div class="row">

        <div class="col-md-2">Lista:
            <select id="pagination_value" class="pagination_value form-control " style="text-align: left;">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option selected value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="col-md-3">Busqueda:
            <input type="text" id="buscar" placeholder="Buscar" class="form-control search_value">
        </div>
        <div class="col-md-4">
            <h5 class="ng-binding">Resultado 2 de 2 total Grupos</h5>
        </div>
    </div>

<div class="clearfix"></div><br>
    <div class="clearfix"></div><br>


    <div id="table-action" class="row">
        <div class="col-lg-12">

            <ul id="tableactiondTab" class="nav nav-tabs">
                <li class="active"><a href="#table-table-tab" data-toggle="tab">Información</a></li>
            </ul>

            <div id="tableactionTabContent" class="tab-content">
                <div id="table-table-tab" class="tab-pane fade in active">
                    <div class="row">
                            <div class="table-container">
                                <div class="row mbm">
                                    </div>

                                </div>
                                <div class="col-lg-12">
<h4 class="box-heading">Paginación</h4>
                                <div class="table-responsive">
                                    <!--Inicia Boton Nuevo -->

                                    <div class="clearfix"></div>
                                    <br>
                                    <!--COMIENZA EL CONTENIDO-->
<div class="table-responsive">
<!--Inicia Boton Nuevo -->
<div class="portlet-body">
   <div class="actions">
       <a class="crear-planificacion btn btn-info" href="Horarios/newplanificacion"><i class="fa fa-plus"></i> Nuevo</a>
   </div>
</div>

 <div class="clearfix">
</div>
                                    <div class="col-md-12">
                                            <table id="table_planeacion" class="table table-hover table-striped table-bordered table-advanced tablesorter">
                                                
                                            </table>
                                    </div>
                                    </div>
                                            <!--FINALIZA EL CONTENIDO-->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="messages"></div><br><br>
                            <!--div para visualizar en el caso de imagen-->
                            <div class="showImage"></div>
                        </section>
                    </ng-view>
                </div>

            </section>
            <!-- AQUI VA TODO EL CONTENDIDO -->
        </div>
    </div>
</div>
@stop