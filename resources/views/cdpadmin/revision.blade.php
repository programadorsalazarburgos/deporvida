@extends('angular.frontend.master')
@section('title', 'Cuentas de cobro')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.18/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.18/datatables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="text/javascript">

	function LoadData()
	{
		table = $('#mytable').DataTable ({
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/cpd/allcuentascobro/'+$('#estado_cuota').val(),
                    columns : 
                    [
                        {
                            data: 'user', "title": "Contratista", 
                            render:function (value,type,row) 
                            {
                                return value;
                            }
                        },
                        {
                            data: 'numero_documento', "title": "Documento", 
                            render:function (value,type,row) 
                            {
                                return value;
                            }
                        },
                        {
                            data: 'fecha_transaccion', "title": "Fecha de transaccion", 
                            render:function (value,type,row) 
                            {
                                return value;
                            }
                        },
                        {
                            data: 'cuota_numero', "title": "Cuota", 
                            render:function (value,type,row) 
                            {
                                return value;
                            }
                        },
                        {
                            data: 'estado', "title": "Estado", 
                            render:function (value,type,row) 
                            {
                            	var color="";
                            	switch(row.id_estado)
                            	{
                            		case 1:color="success";break;
                            		case 2:color="danger";break;
                            		case 3:color="warning";break;
                            	}
                                return '<span class="label label-'+color+'">'+
                                		value+'</span>';
                            }
                        },
                        {
                            data: 'id', "title": "Documentos", 
                            render:function (id,type,row) 
                            {
                                var html=
                                '<div class="btn-group pull-right">'+
                                    '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Documentos <span class="fa fa-caret-down"></span></button>'+
                                    '<ul  class="dropdown-menu">'+
                                        '<li>'+
                                            '<a target="_blank" href="'+base+'/cdp/inf1/'+id+'"><i class="far fa-file-pdf"></i> Documento equivalente</a> '+
                                        '</li>'+
                                        '<li>'+
                                            '<a target="_blank" href="'+base+'/cdp/inf2/'+id+'"><i class="far fa-file-pdf"></i> Informe parcial</a> '+
                                        '</li>'+
                                        '<li>'+
                                            '<a target="_blank" href="'+base+'/cdp/inf3/'+id+'"><i class="far fa-file-pdf"></i> Informe mensual</a> '+
                                        '</li>'+
                                    '</ul>'+
                                '</div>';
                                return html;
                            }
                        },
                        {
                            title:'prueba',
                            render:function (value,type,row) 
                            {
                                var html=
                                '<div class="btn-group pull-right">'+
                                    '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>'+
                                    '<ul  class="dropdown-menu">'+
                                        '<li>'+
                                            '<a href="javascript:estado(1,'+row.id+')">'+
                                        		'<i class="fa fa-check"></i> Aprobar</button> '+
                                            '</a>'+
                                        '</li>'+
                                        '<li>'+
                                            '<a href="javascript:estado(2,'+row.id+')">'+
                                        		'<i class="fa fa-remove"></i> Rechazar</button> '+
                                            '</a>'+
                                        '</li>'+
                                    '</ul>'+
                                '</div>';
								 return html;
                            }
                        }
                    ]
                });


}
function estado(estado,id)
{
	var nombre=(estado==1)?'Aprobado':'Cancelado';
	swal(
	{
		title: "Estas seguro?",
		text: "Va a cambiar el estado de la cuenta de cobro a "+nombre,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Cambiar estado",
		cancelButtonText: "No cambiar",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm) 
	{
		if (isConfirm) 
		{
			$.ajax({
                url: base + '/cdp/changeestado',
                type: 'POST',
                data:{estado:estado,id_cuenta_cobro:id},
            	dataType: 'JSON',
            }).success(function(response)
			{
                swal("Cambiado", "El estado se ha cambiado.", "success");
            	LoadData();
			});
		}
        else
		{
        	swal("Cancelado", "No se ha cambiado el estado", "error");
    	}
	});
}
$(function()
{
    $('#estado_cuota').change(function()
    {
        loadingstart();
        LoadData();
        loadingstop();
    })
    loadingstart();
    LoadData();
    loadingstop();
})
</script>
<div class="container-fluid">
    <div class="col-md-12">
        <ul id="tableactiondTab" class="nav nav-tabs">
            <li class="active">
                <a href="#table-table-tab" data-toggle="tab">Cuentas de cobro</a>
            </li>
        </ul>
        <div id="tableactionTabContent" class="tab-content">
            <div class="container-fluid">
                <div class="col-md-4 row">
                    <label>Estado</label>
                    <select id="estado_cuota" class="form form-control">
                        <option value="-1">Seleccione</option>
                        @foreach($estadoscuota as $temp)
                        <option value="{{$temp->id}}">{{$temp->descripcion}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                <div class="table-responsive">
                    <table id="mytable" class="table table-hover"></table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop