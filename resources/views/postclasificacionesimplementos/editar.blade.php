@extends('angular.frontend.master')
@section('title', 'Clasificaciones')
@section('content')
<script type="text/javascript" src="{{url('')}}/js/implementosa.create.jss"></script>
<script>
    $(function ()
    {
        $('#clasificacion_form').submit(function (e)
        {
            e.preventDefault();
            var id = $('#id').val();
            $.ajax({
                url: base + '/admin/clasificaciones/update/'+id,
                type: 'POST',
                data: $(this).serialize(),
                success: function (data)
                {
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Modificado!", "Registro Guardado.", "success");
                    window.location = base + '/admin/clasificaciones';
                }
            });
        });
    });

</script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active">
          <a href="#table-table-tab" data-toggle="tab">Clasificaciones de Implementos</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
      <div class="container-fluid">
            <legend>Modificar Clasificaciones de Implementos</legend>
            <form id="clasificacion_form">
                <input type="hidden" name="id" id="id" value="{{$clasificacion->id}}">
                <div class="col-md-12">
                    <label><i class="required">*</i> Nombres</label>
                    <input type="text" value="{{$clasificacion->nombre}}" name="nombre" class="form form-control" required="required"/>
                </div>
                <div class="col-md-12">
                    <label>Observaciones</label>
                    <input type="text" value="{{$clasificacion->observaciones}}" name="observaciones" class="form form-control"/>
                </div>
                <div class="col-md-12 row">
                    <button id="submit_button" type="submit" class="btn btn-success" style="margin-left: 15px; "><i class="fa fa-save"></i> Guardar</button>
                    <a href="{{url('/admin/clasificaciones')}}" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>

                </div>
            <form>
      </div>
    </div>
</div>
@stop