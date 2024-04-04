@extends('angular.frontend.master')
@section('title', 'Jerarquias de roles')
@section('content')
<style type="text/css">
select{
  text-transform: uppercase;
}
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('datatables/datatables.min.css') }}"/>
<script type="text/javascript" src="{{ asset('datatables/datatables.min.js') }}"></script>
<script>
    function guardar()
    {
        $('form').submit(function(e)
        {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType:'json',
                success: function (data)
                {
                    if(data.validate)
                    {
                        swal("Almacenado!", "Jerarquia guardada.", "success");
                        window.location = base + '/jerarquias/index';
                    }
                    else
                    {
                        swal("No se pudo guardar", data.msj, "error");
                    }
                }
            });
        });
    }
    $(function()
    {
        guardar();
    })
</script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Jerarquias de roles<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
        <form action="{{url('jerarquias/new/save')}}" method="post">
            <div class="panel">
                <div class="panel-heading">
                    <legend>Nueva jerarquia</legend>
                </div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <label>
                                Rol padre
                                </label>
                                <select class="form form-control" id="id_roles_padre" name="id_roles_padre">
                                    @foreach($roles as $temp)
                                    <option value="{{$temp->id}}">{{$temp->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>
                                Rol hijo
                                </label>
                                <select class="form form-control" id="id_roles_hijo" name="id_roles_hijo">
                                    @foreach($roles as $temp)
                                    <option value="{{$temp->id}}">{{$temp->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="container-fluid">
                                <button class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                                <a href="{{url('jerarquias/index')}}" class="btn btn-danger"><i class="fa fa-cancel"></i> Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop