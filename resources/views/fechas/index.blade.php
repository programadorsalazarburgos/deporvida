@extends('angular.frontend.master')
@section('title', 'Informe grupos')
@section('content')
<div class="container-fluid">
<div class="col-md-12">
<div id="tableactionTabContent" class="tab-content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <label for="id_grupo">Seleccione comuna</label>
                    <select class="form form-control" name="id_comuna" id="id_comuna" onchange="seleccionarComuna(this)">
                        <option value="">Seleccione comuna</option>
                        @foreach($comunas as $comuna)
                        <option value="{{$comuna->id}}">{{$comuna->nombre_comuna}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-6">
                    <label for="id_grupo">Seleccione monitor</label>
                    <div class="con-monitores">
                        <select class="form form-control" id="id_monitor" name="id_monitor"  onchange="seleccionarMonitor(this)">
                            <option value="">Seleccione comuna</option>

                        </select>    
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <label for="id_grupo">Seleccione el grupo</label>
                    <div class="con-json1">
                        <select class="form form-control" id="id_grupo"></select>    
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="mes">Seleccione el mes</label>
                    <select class="form form-control" name="mes" id="mes">
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <button id="buscar" class="btn btn-primary">Buscar</button>

                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
             <div id="clases"></div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<script>


$(function() {

    $.ajax({
            url:base+'/obtener/grupos/',
            success:function(value)
            {
                $('.con-json1 select').empty();
                $.each(value,function(index,data)
                {
                    $(".con-json1 select").append('<option value="'+data.id+'">'+data.codigo_grupo+'</option>');
 
                })

            }
        })


});

    function seleccionarComuna(sel) {
    var comuna = sel.value;

    if (comuna == 0) 
    {
        
        $('.con-monitores select').empty();
        $.ajax({
                url:base+'/obtener/grupos/',
                success:function(value)
                {
     
                    $.each(value,function(index,data)
                    {
                        $(".con-json1 select").append('<option value="'+data.id+'">'+data.codigo_grupo+'</option>');
     
                    })

                }
            })
    }
    else{

        $('.con-json1 select').empty();

    $.ajax({
            url:base+'/obtener/monitores/'+ comuna,
            success:function(value)
            {


                // console.log(value);
                $('.con-monitores select').empty();
                $.each(value,function(index,data)
                {

                    $(".con-monitores select").append('<option value="'+data.id+'">'+data.nombres+'</option>');
 
                })

            }
        })
        }

    }

    function seleccionarMonitor(b)
    {

    var monitor = b.value;;

        console.log(monitor);
    $.ajax({
            url:base+'/obtener/grupos_monitor/'+ monitor,
            success:function(value)
            {


                // // console.log(value);
                $('.con-json1 select').empty();
                $.each(value,function(index,data)
                {
                    $(".con-json1 select").append('<option value="'+data.id+'">'+data.codigo_grupo+'</option>');
 
                })

            }
        })



    }
$(function()
{

    $('#buscar').click(function()
    {

        if ($('#id_comuna').val() =='') 
        {
            var comuna = 'noseleccionado';
        }
        else
        {
            var comuna = $('#id_comuna').val();
        }

        $.ajax({
            url:base+'/grupos/dias/'+$('#id_grupo').val()+'/'+$('#mes').val()+'/'+comuna,
            success:function(value)
            {
                html="<table class=\"table table-hover\"><tr><th>Mes</th><th>Grupo</th><th>Clases del mes</th><th>Clases reportadas</th><th>Clases asistencias</th><th>Diferencia</th></tr>";
                $.each(value,function(index,data)
                {
                    html=html+"<tr><td>"+data.mes+"</td><td>"+data.grupo+"</td><td>"+data.clases_asignadas+"</td><td>"+data.Clases_programadas+"</td><td>"+data.total_asistencias+"</td><td>";

                    html+= (data.Diferencia<0)?'<label  class="label label-danger">'+(-1*data.Diferencia)+'</label>':data.Diferencia;
                    html=html+"</td></tr>";
                })
                html=html+'</table>';
                $('#clases').html(html);

            }
        })
    })
})
</script>
@stop