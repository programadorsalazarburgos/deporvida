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
            $.ajax({
                url: base + '/admin/clasificaciones/save',
                type: 'POST',
                data: $(this).serialize(),
                success: function (data)
                {
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Almacenado!", "Registro Guardado.", "success");
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
            <legend>Registro de Clasificaciones de Implementos</legend>
            <form id="clasificacion_form">
                <div class="col-md-12">
                    <label><i class="required">*</i> Nombres</label>
                    <input type="text" name="nombre" class="form form-control" required="required"/>
                </div>
                <div class="col-md-12">
                    <label>Observaciones</label>
                    <input type="text" name="observaciones" class="form form-control"/>
                </div>
                <div class="col-md-12 row">
                    <button id="submit_button" type="submit" class="btn btn-success" style="margin-left: 15px; "><i class="fa fa-save"></i> Guardar</button>
                </div>
            <form>
      </div>
    </div>
</div>
@stop