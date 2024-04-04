@extends('angular.frontend.master')
@section('title', 'Implementos Deportivos')
@section('content')
<script type="text/javascript" src="{{url('')}}/js/implementos.create.jss"></script>
<script>
    $(function ()
    {
        $('#proveedor_id').select2();

        $('#implemento_form').submit(function (e)
        {
            e.preventDefault();
     
            var id = $('#id').val();
  
            $.ajax({
                url: base + '/admin/implementos/update/'+id,
                type: 'POST',
                data: $(this).serialize(),
                success: function (data)
                {
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Modificado!", "Registro Guardado.", "success");
                    window.location = base + '/admin/implementos';
                }
            });
        });

        $('#proveedor_id').val({{$implemento->proveedor_id }} );
        $('#clasificacion_id').val( {{$implemento->clasificacion_id}} );
        $('#disciplina_id').val( {{$implemento->disciplina_id}} );

    });

</script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active">
        	<a href="#table-table-tab" data-toggle="tab">Modificar Implemento Deportivo</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
            <legend>Implemento</legend>
            <form id="implemento_form">
                <input type="hidden" name="id" id="id" value="{{ $implemento->id}}">
                <div class="col-md-12">
                    <label><i class="required">*</i> Clasificación</label>
                    <select name="clasificacion_id" id="clasificacion_id" class="form form-control" required="required">
                        @foreach($clasificacion as $temp)
                        <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label><i class="required">*</i> Disciplina</label>
                    <select name="disciplina_id" class="form form-control" required="required">
                        @foreach($disciplina as $temp)
                        <option value="{{$temp->id}}">{{$temp->descripcion}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label><i class="required">*</i> Proveedor</label>
                    <select name="proveedor_id" id="proveedor_id" class="form form-control" required="required">
                        @foreach($proveedor as $temp)
                        <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <label><i class="required">*</i> Nombre Implemento</label>
                    <input type="text" value="{{$implemento->nombre}}" name="nombre" class="form form-control" required="required"/>
                </div>
                <div class="col-md-12">
                    <label><i class="required">*</i> Especificación Tecnica</label>
                    <textarea name="especificacion_tecnica" rows="10" class="form form-control" required="required">{{$implemento->especificacion_tecnica}}</textarea>
                </div>

                <div class="col-md-4">
                    <label><i class="required">*</i> Cantidad Inicial / Stock</label>
                    <input type="number" name="stock" value="{{$implemento->stock}}" min="1" class="form form-control" required="required"/>
                </div>
                <div class="col-md-12 row">
                    <button id="submit_button" type="submit" class="btn btn-success" style="margin-left: 15px; "><i class="fa fa-save"></i> Guardar</button>
                    <a href="{{url('/admin/implementos')}}" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                </div>
            <form>
    	</div>
    </div>
</div>
@stop