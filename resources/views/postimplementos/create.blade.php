@extends('angular.frontend.master')
@section('title', 'Implementos Deportivos')
@section('content')
<script type="text/javascript" src="{{url('')}}/js/implementoss.create.jss"></script>
<script>
    $(function ()
    {
        $('#proveedor_id').select2();

        $('#implemento_form').submit(function (e)
        {
            e.preventDefault();
            $.ajax({
                url: base + '/admin/implementos/save',
                type: 'POST',
                data: $(this).serialize(),
                success: function (data)
                {
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Almacenado!", "Registro Guardado.", "success");
                    window.location = base + '/admin/implementos';
                }
            });
        });
    });

</script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active">
        	<a href="#table-table-tab" data-toggle="tab">Implementos Deportivos</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
            <legend>Implemento</legend>
            <form id="implemento_form">
                <div class="col-md-12">
                    <label><i class="required">*</i> Clasificacion</label>
                    <select name="clasificacion_id" class="form form-control" required="required">
                        <option value="">Seleccionar</option>
                        @foreach($clasificacion as $temp)
                        <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label><i class="required">*</i> Disciplina</label>
                    <select name="disciplina_id" class="form form-control" required="required">
                        <option value="">Seleccionar</option>

                        @foreach($disciplina as $temp)
                        <option value="{{$temp->id}}">{{$temp->descripcion}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label><i class="required">*</i> Proveedor</label>
                    <select name="proveedor_id" id="proveedor_id" class="form form-control" required="required">
                        <option value="">Seleccionar</option>
                        @foreach($proveedor as $temp)
                        <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <label><i class="required">*</i> Nombre implemento</label>
                    <input type="text" name="nombre" class="form form-control" required="required"/>
                </div>
                <div class="col-md-12">
                    <label><i class="required">*</i> Especificacion tecnica</label>
                    <textarea name="especificacion_tecnica" rows="10" class="form form-control" required="required"> </textarea>
                </div>

                <div class="col-md-4">
                    <label><i class="required">*</i> Cantidad inicial/Stock</label>
                    <input type="number" name="stock" min="1" class="form form-control" required="required"/>
                </div>
                <div class="col-md-12 row">
                    <button id="submit_button" type="submit" class="btn btn-success" style="margin-left: 15px; "><i class="fa fa-save"></i> Guardar</button>
                </div>
            <form>
    	</div>
    </div>
</div>
@stop