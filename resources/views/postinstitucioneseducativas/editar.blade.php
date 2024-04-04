@extends('angular.frontend.master')
@section('title', 'Editar institucion educativa')
@section('content')
<?php
$v='?v='.date('YmdHis');
?>
<style type="text/css">
  input{
  text-transform:uppercase;
} 
</style>
<script type="text/javascript" src="js/institucion.editar.js"></script>
<div class="container">
<ul id="tableactiondTab" class="nav nav-tabs">
    <li class="active"><a href="#table-table-tab" data-toggle="tab">Editar institucion educativa<strong></strong></a></li>
</ul>
  <div id="tableactionTabContent" class="tab-content">
    <form id="form">
      <div class="col-md-12">
        <label>Nombre</label>
        <input value="{{$nombre}}" type="text" name="nombre" id="nobmre" class="form form-control" required="true" />
        <input value="{{$id}}" type="hidden" name="id" />
      </div>
      <br/>
      <br/>
      <br/>
      <button type="submit" class="btn btn-success">Guardar</button>
    </form>
  </div>
</div>
@stop