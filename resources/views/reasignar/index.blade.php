@extends('angular.frontend.master')
@section('title', 'Reasignar metodologos')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" src="{{url('')}}/js/reasignar.js"></script>
<div class="page-content">
    <div id="tab-general">
        <div id="sum_box" class="row mbl">
            <section>
                <div class="container-fluid">                            
                	<div class="row">
                    	<div class="col-md-12">
                        	<form class="form-horizontal ng-pristine ng-invalid ng-invalid-required ng-valid-time ng-valid-maxlength" id="form" >
                            	<div class="nav-tabs-custom">
                                	<ul class="nav nav-tabs">
                                    	<li class="active">
                                    		<a href="#details" data-toggle="tab" aria-expanded="false">
                                        		<span class="label label-success" id="codigo">Reasignar metodologos</span> <span class="label label-primary ng-pristine ng-untouched ng-valid ng-binding" ng-model="codigo" id="codigo"></span>
                                        	</a>
										</li>
									</ul>
                                    <div class="tab-content">
                                        <table id="example" class="display" style="width:100%">
										</table>
										</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
	            </div>
	        </section>
	    </div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style=".modal-header {min-height: 16.43px;padding: 15px;border-bottom: 1px solid #e5e5e5;color: #fff;background-color: #c9302c;border-color: #ac2925;}">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Reasignar metodólogo</h4>
      </div>
      <div class="modal-body">
     	<div class="container-fluid">
     		<div class="col-md-12"><h3 id="name"></h3></div>
     		<div class="col-md-12">
     			<label>Ingrese la comuna a reasignar</label>
     			<input type="hidden" name="id_usuario" id="id_usuario"/>
	     		<select class="form form-control" name="id_comuna" id="id_comuna">
     			@foreach($comunas as $temp)
	     			<option value="{{$temp->id}}">Comuna de impacto {{$temp->codigo_comuna}}</option>
     			@endforeach   
	     		</select>
     		</div>
     	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" id="button_change">Cambiar</button>
      </div>
    </div>
  </div>
</div>
@stop