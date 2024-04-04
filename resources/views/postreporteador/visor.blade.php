<style type="text/css">
    iframe {
        height: 650px; 
        width: 952px; 
        border: 1px solid #CCC;
    }
    .tab-content {
        padding: 20px 8px !important;
    }
</style>

<script type="text/javascript">
    var jasperServer = {!! json_encode($jasperServer) !!};
    var jasperUser = {!! json_encode($jasperUser) !!};
    var jasperPass = {!! json_encode($jasperPass) !!};
</script>

<div ng-controller="ReporteadorVisorCrtl">

    <div class="clearfix"></div>
    <br>

    <div class="clearfix"></div>
    <br>
    <div id="table-action" class="row">
        <div class="col-lg-12">

            <ul id="tableactiondTab" class="nav nav-tabs">
                <li class="active">
                    <a href="#table-table-tab" data-toggle="tab">Reporteador - Visor</a>
                </li>
            </ul>

            <div id="tableactionTabContent" class="tab-content">
                <div id="table-table-tab" class="tab-pane fade in active">

                    <div class="clearfix"></div>
                    <br/>
                    <div class="alert alert-warning alert-dismissible" role="alert" ng-show="alertDashboard">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Recuerde!</strong> Para mejorar la visualización de los gráficos exporte el informe en PDF.
                    </div>
                    {{-- <iframe src="{{$jasperServer}}/j_spring_security_check?j_username={{$jasperUser}}&j_password={{$jasperPass}}"></iframe> --}}
                    <iframe ng-src="@{{getIframeSrc()}}"></iframe>

                </div>
            </div>
        </div>
    </div>
</div>

                        