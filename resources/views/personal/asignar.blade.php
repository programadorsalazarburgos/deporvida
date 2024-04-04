@extends('angular.frontend.master')
@section('title', 'Registro de personal')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
    $(function()
    {
        $('#table_asignar_roles').DataTable();
    });
    function asignar_rol(id_user, id_rol)
    {
        $.ajax({
            url: 'asignar/roles',
            data: {user: id_user, rol: id_rol},
            type: 'POST',
            dataType: 'json',
            success: function (data)
            {
                if (data.validate)
                {
                    swal("Asignado!", "Se asigno el usuario un rol.", "success");
                    window.location = base + '/postusuarios/asignar';
                }
                else
                {
                    swal("Error", "Se presento un error inexperado", "warning");
                    console.log(data.msj);
                }
            }
        });
    }
</script>
<ul id="tableactiondTab" class="nav nav-tabs">
    <li class="active"><a href="#table-table-tab" data-toggle="tab">Registro del personal<strong></strong></a></li>
</ul>
<div id="tableactionTabContent" class="tab-content">
    <div id="log"></div>
    <form id="empleado_form">
        <table id="table_asignar_roles">
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Usuario</th>
                    <th>Fecha nacimiento</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $temp)
                <tr>
                    <td>{{$temp->numero_documento}}</td>
                    <td>{{$temp->usuario}}</td>
                    <td>{{$temp->fecha_nacimiento}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Asignar Rol <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach($roles as $rol)
                                <li><a href="javascript:asignar_rol({{$temp->id_user}},{{$rol->id}})">{{$rol->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@stop