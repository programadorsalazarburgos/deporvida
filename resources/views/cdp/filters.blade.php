@extends('angular.frontend.master')
@section('title', 'CDP')
@section('content')
<?php
$v='?v='.date('YmdHis');
?>
<style type="text/css">
  input{
  text-transform:uppercase;
} 

</style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery.printPage.js"></script>
<script type="text/javascript" src="js/cdp.listar.js<?= $v; ?>"></script>


<div class="container">
  <ul id="tableactiondTab" class="nav nav-tabs">
      <li class="active"><a href="#table-table-tab" data-toggle="tab">Listado<strong></strong></a></li>
  </ul>
  <div id="tableactionTabContent" class="tab-content">
  <div class="row">
    <div class="col-lg-12">
      <h4 class="box-heading">Paginación</h4>
    </div>
    <div class="col-lg-12">
      <div class="pagination-panel ng-binding">Resultado  de <span class="count_datatable"></span> total empleados</div>
    </div>
    <div class="col-md-12">
      <div class="table-responsive">
          <table id="table_hoja_vida" width="100%" class="table table-hover table-striped table-bordered table-advanced tablesorter">
          </table>
      </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Combinar</h4>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
              <div class="col-md-12">
              </div>
              <div class="col-md-12">
                <label>Ingrese el nombre</label>
                <input type="text" id="name" class="form form-control" name="name" placeholder="Ingrese el nombre del instituto">
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
          <button type="button" id="cambiar_nombre" class="btn btn-danger">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
@stop