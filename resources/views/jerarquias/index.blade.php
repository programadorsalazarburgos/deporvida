@extends('angular.frontend.master')
@section('title', 'Jerarquias de roles')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('datatables/datatables.min.css') }}"/>
<script type="text/javascript" src="{{ asset('datatables/datatables.min.js') }}"></script>
<script>
    $(function()
    {
        CargarRegistro();

    });
	function CargarRegistro() 
	{
       var table = $("#table_clasificaciones").DataTable ({
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/jerarquias/indexData',
                    "columns" : 
                    [
                        { data : "name_user_padre", title: "Rol padre",render:function(name){return name.toUpperCase();}},
                        { data : "name_user_hijo", title: "Rol hijo",render:function(name){return name.toUpperCase();}},
                        {
                            data: 'id', "title": "Editar", 
                            render:function (id) 
                            {
                                return '<a class="btn btn-sm btn-warning" href="'+base+'/jerarquias/editar/'+id+'" title="Modificar"><i class="fa fa-edit"></i> Editar jerarquia</a>';
                            }
                        }
                        
                    ]
                });
            table.draw();
    }
</script>


<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Jerarquias de roles<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div>
    		<a class="btn btn-primary" data-toggle="modal" href="{{ url('/jerarquias/create') }}" ><span class="fa fa-plus"></span> Nueva jerarquia</a>
        </div>
    	<br>
        <table id="table_clasificaciones" class="table table-hover table-striped table-bordered table-advanced tablesorter">
        </table>
    </div>
</div>

@stop