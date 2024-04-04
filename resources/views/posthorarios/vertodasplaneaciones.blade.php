@extends('angular.frontend.master')
@section('title', 'Ver planeaciones')
@section('content')
<script type="text/javascript" src="js/functions.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" src="js/horarios.todos.js"></script>
<div class="page-content">
    <div id="tab-general">
        <div id="sum_box" class="row mbl">
            <section>
                <div class="container">
                    <!-- ngView: undefined --><ng-view class="ng-scope"><section class="content ng-scope">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                                                        <span class="label label-success" id="codigo">Ver planeaciones</span> <span class="label label-primary ng-pristine ng-untouched ng-valid ng-binding" ng-model="codigo" id="codigo"></span>
                                                    </a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="resultados_ajax"></div>
                                                <div class="tab-pane active" id="details">
                                                    <div class="clearfix"></div>
                                                    <br>
                                                </div>

                                                <div class="clearfix"></div>
                                                <legend>Fechas</legend>
                                                <div class="clearfix"></div>
                                                <div class="col-md-5">
                                                	<label>Fecha de inicio</label>
                                                	<input type="text" class="fecha form form-control" id="fi">
                                                </div>
                                                <div class="col-md-5">
                                                	<label>Fecha de fin</label>
                                                	<input type="text" class="fecha form form-control" id="ff">
                                                </div>
                                                <div class="col-md-2">
                                                	<br/>
                                                	<button type="button" class="btn btn-primary" id="search_data">Buscar</button>
                                                </div>

                                                <div class="clearfix"></div>
												
												<div class="row">
													<div class="col-md-2">
														<select id="f_mes">
															<option value="2021-04">Abril</option>
															<option value="2021-05">Mayo</option>
															<option value="2021-06">Junio</option>
														</select>
														<select id="f_dia">
															@for($i=1; $i<=31 ;$i++)
																<option value="{{$i}}">{{$i}}</option>
															@endfor
														</select>
														Indice:
														<input type="text" id="iniRango"/>
														Cuantas trae:
														<input type="text" id="finRango"/>
													</div>
													<div class="col-md-2">
														<script>
															function fnRed(){
																var f_mes = $("#f_mes").val();
																var f_dia = $("#f_dia").val();
																var iniRango = $("#iniRango").val();
																var finRango = $("#finRango").val();
																href='http://sider.cali.gov.co:8082/Horarios/planeacion/1?f_mes='+f_mes+"&f_dia="+f_dia+"&iniRango="+iniRango+"&finRango="+finRango;
																window.open(href, '_blank');
															}
														</script>
														<button type="button" class="btn btn-primary" id="search_data" onclick="fnRed();">Buscar dia</button>
													</div>
												</div>
												
                                                <br>
                                                <table id="table_planeacion" class="table table-hover table-striped table-bordered table-advanced tablesorter dataTable no-footer">
                                                    
                                                </table>
                                            </div>
                                        </div>
                                </div>
                            </div>


                            <div class="messages"></div><br><br>
                            <!--div para visualizar en el caso de imagen-->
                            <div class="showImage"></div>


                        </section>
                    </ng-view>
                </div>

            </section>
            <!-- AQUI VA TODO EL CONTENDIDO -->
            @stop