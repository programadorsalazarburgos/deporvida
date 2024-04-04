<?php
$url='//'.($_SERVER['HTTP_HOST']);?>
<!--CAMBIAR RUTAS-->
<!--CAMBIAR RUTAS-->
<script type="text/javascript" src="http://sider.cali.gov.co:8082/dir_generator/jquery.min.js"></script>
<script type="text/javascript" src="http://sider.cali.gov.co:8082/dir_generator/bootstrap.min.js"></script>
<script type="text/javascript" src="http://sider.cali.gov.co:8082/dir_generator/handlebars.js"></script>
<script type="text/javascript" src="http://sider.cali.gov.co:8082/dir_generator/typeahead.bundle.js"></script>

<link rel="stylesheet" href="http://sider.cali.gov.co:8082/dir_generator/plg-bootstrap.css">
<link rel="stylesheet" href="http://sider.cali.gov.co:8082/dir_generator/typehead.css">
<link rel="stylesheet" href="http://sider.cali.gov.co:8082/dir_generator/font-awesome.min.css">


<script>
    var npn = $('#numero_unico_nacional');
    npn.val($('#').val());
    var b_npn = $('#b_npn');
    var direccion = $('#direccionPlugin');
    var direccionVisual = $('#direccionPluginVisual');
    var dirAdicional = $('#adicional');
    var dir = $('#direccionPlugin');


    function generardirecciones()
    {
        var dir = ($.trim($('#direccionPluginVisual').val()) != '') ? $.trim($('#direccionPluginVisual').val()) : $('#b_direccion').val();
        $('#hiden_direccion').val(dir);
        $('#hiden_direccion_observacion').val($('#adicional').val());
        try {
            parent.<?= $_GET['fieldNamecallbackFunction']; ?>();
        } catch (Exception)
        {
            console.log(Exception);
        }
    }
    //Retrsa la carga de todo el codigo contenido en la esta funcion para garantizar la carga de los scripts iniciales
    function retrasarCargaCodigo()
    {
        var datapredio = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('codigounico'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            //CAMBIAR RUTAS
            prefetch: 'http://planeacion.cali.gov.co/saul/predio/Numpredial/',
            remote: {
                //CAMBIAR RUTAS
                url: 'http://planeacion.cali.gov.co/saul/predio/Numpredial/q/%QUERY',
                wildcard: '%QUERY'
            }
        });

        $('#busquedanumeropredial .typeahead').typeahead(null, {
            name: 'b_npn',
            display: 'codigounico',
            hint: false,
            highlight: true,
            minLength: 4,
            source: datapredio,
            templates: {
                empty: [
                    '<div class="plg-titulo text-left empty-message">',
                    '&nbsp&nbspNo se encontraron resultados&nbsp<small class="plg-small"><a href="#" id="plg-crear-nomenclatura" class="btn plg-btn btn-primary " role="button" onclick="crearnomenclatura();">Ingresar su dirección</a></small>  ',
                    '</div>'
                ].join('\n'),
                suggestion: Handlebars.compile('<div id="resultado" direccion="{{direccion}}" idpredio="{{idpredio}}" idnomenclatura="{{idnomenclatura}}" codigounico="{{codigounico}}">{{codigounico}} – {{direccion}}</div>')
            }
        });


        // constructs the suggestion engine
        var data_direccion = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('direccion'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            //CAMBIAR RUTAS
            prefetch: 'http://planeacion.cali.gov.co/saul/nomenclatura/Dirpredial/',
            remote: {
                //CAMBIAR RUTAS
                url: 'http://planeacion.cali.gov.co/saul/nomenclatura/Dirpredial/q/%QUERY',

                wildcard: '%QUERY'
            }
        });

        $('#busquedadireccion .typeahead').typeahead(null, {
            name: 'b_direccion',
            display: 'direccion',
            hint: false,
            highlight: true,
            minLength: 4,
            source: data_direccion,
            templates: {
                empty: [
                    '<div class="plg-titulo text-left empty-message">',
                    '&nbsp&nbspNo se encontraron resultados&nbsp<small class="plg-small"><a href="#" id="plg-crear-nomenclatura" class="btn plg-btn btn-primary " role="button" onclick="crearnomenclatura();">Crear Nomenclatura</a></small>  ',
                    '</div>'
                ].join('\n'),
                suggestion: Handlebars.compile('<div id="resultado" direccion="{{direccion}}" idpredio="{{idpredio}}" idnomenclatura="{{idnomenclatura}}" codigounico="{{codigounico}}">{{direccion}} - {{codigounico}}</div>')
            }
        });
    }

    $(document).ready(function ()
    {
        var activarBusqueda = 1;
        if (activarBusqueda === false)
        {
            //$('#div_busqueda').hide();
        } else {
           // $('#formularioplugin').hide();
            $('#busquedadireccion').hide();
            $('#busquedanumeropredial').hide();
            $('#boton-guardar-busqueda').hide();
        }

        setTimeout("retrasarCargaCodigo()", 3000); //Retrasar la carga de esta funcion..
        // constructs the suggestion engine

        $("body").on("click", "#resultado", function () {
            $('#busquedanumeropredial').addClass('has-success has-feedback');
            $('#busquedadireccion').addClass('has-success has-feedback');
            $('#b_direccion').addClass('success');
            $('#b_npn').addClass('success');
            $('#b_npn').val($(this).attr('codigounico'));
            $('#b_direccion').val($(this).attr('direccion'));
            $('#b_idpredio').val($(this).attr('idpredio'));
            $('#b_idnomenclatura').val($(this).attr('idnomenclatura'));
            $('#boton-guardar-busqueda').show();
            $('#busquedadireccion').show();
            $('#busquedanumeropredial').show();

        });

        $('#radiobusqueda1').change(function () {
            $('#b_direccion').attr('disabled', true);
            $('#b_npn').removeAttr('disabled');
            $('#b_npn').addClass('typeahead');
            $('#b_direccion').removeClass('typeahead');
        });

        $('#radiobusqueda2').change(function () {
            $('#b_npn').attr('disabled', true);
            $('#b_direccion').removeAttr('disabled');
            $('#b_direccion').addClass('typeahead');
            $('#b_npn').removeClass('typeahead');
        });

        $("[data-toggle='tooltip']").tooltip();

        $('.numero').keyup(function () {
            this.value = (this.value + '').replace(/[^0-9+.]/g, '');
        });

        $('#V__a').change(function () {
            concatenarDireccion();
        });

        $('#No').change(function () {
            concatenarDireccion();
        });

        $('#No_Placa_1').change(function () {
            concatenarDireccion();
        });

        $('#No_Placa_2').change(function () {
            concatenarDireccion();
        });

        $('#Cruce').change(function () {
            concatenarDireccion();
        });

        $('#Letra').change(function () {
            concatenarDireccion();
        });

        $('#No_Sec').change(function () {
            concatenarDireccion();
        });

        $('#Letra_Sec').change(function () {
            concatenarDireccion();
        });

        $('#BIS').change(function () {
            concatenarDireccion();
        });

        $('#Sector').change(function () {
            concatenarDireccion();
        });

        $('#Sector_P').change(function () {
            concatenarDireccion();
        });

        $('#Letra_P').change(function () {
            concatenarDireccion();
        });

        $('#No_Sec_P').change(function () {
            concatenarDireccion();
        });

        $('#Letra_Sec_P').change(function () {
            concatenarDireccion();
        });

        $('#BIS_P').click(function () {
            concatenarDireccion();
        });

        $('#Sector_P').change(function () {
            concatenarDireccion();
        });

        $("#plg-guardar").click(function () {
            guardarDireccion();
        });

        $("#plg-guardar-busqueda").click(function () {
            guardarDireccionBuscada();
        });

        $("#plg-crear-nomenclatura").click(function () {
            crearnomenclatura();
        });

        npn.change(function () {
            validarNPN();
            //$(this).siblings(".plg-limpiar").show();
        });

        $(".plg-limpiar").on('click', function () {
            $(this).siblings('input').val("");
            //$(this).hide();
        });

        $(".plg-cerrar").on('click', function () {
            //<?= $_GET['fieldNamecallbackFunction']; ?>();
            $("#<?= $_GET['fieldNameDiv']; ?>").html("");
        });
    });

    function crearnomenclatura() {
        $('#numero_unico_nacional').val($('#b_npn').val());
        $('#formularioplugin').show();
        //$('#div_busqueda').hide();
        //<?= $_GET['fieldNamecallbackFunction']; ?>();
    }
    function concatenarAdicional()
    {
        //$('.infoAdiconal').show();
        //$(".plg-limpiar").show();
        var informacion = $('#adicional').val().trim();
        $('#adicional').val(informacion + ' ' + ($('#Descripci__n_Interior').val()).trim() + ' ' + ($('#Valor').val()).trim());
    }

    function guardarDireccion()
    {
        if (validarNPN() && validarObligatorios())
        {
            $('#<?= $_GET['fieldNameDireccion']; ?>').val(direccion.val());
            $('#<?= $_GET['fieldNameDireccion']; ?>').trigger('change');
            $('#direccionVisual').val(direccionVisual.val());
            $('#direccionVisual').trigger('change');
            $('#idpredio').val('');
            $('#idpredio').trigger('change');
            $('#idnomenclatura').val('');
            $('#idnomenclatura').trigger('change');
            $('#<?= $_GET['fieldNameDireccionAdicional']; ?>').val(dirAdicional.val());
            $('#')
//<?= $_GET['fieldNamecallbackFunction']; ?>();
            $("#<?= $_GET['fieldNameDiv']; ?>").html("");
            console.warn('Evento trigger');
            generardirecciones();
        }
    }
    function guardarDireccionBuscada()
    {
        if (validarB_NPN())
        {
            $('#').val($('#b_npn').val());
            $('#').trigger('change');
            $('#<?= $_GET['fieldNameDireccion']; ?>').val($('#b_direccion').val());
            $('#<?= $_GET['fieldNameDireccion']; ?>').trigger('change');

            if (direccionVisual.val() == '')
            {
                $('#direccionVisual').val($('#b_direccion').val());
                $('#direccionVisual').trigger('change');
            } else {
                $('#direccionVisual').val(direccionVisual.val());
                $('#direccionVisual').trigger('change');
            }
            $('#idpredio').val($('#b_idpredio').val());
            $('#idnomenclatura').val($('#b_idnomenclatura').val());

            //<?= $_GET['fieldNamecallbackFunction']; ?>();
            $("#<?= $_GET['fieldNameDiv']; ?>").html("");
            generardirecciones();
        }
    }

    var requerido = 0
    function validarNPN()
    {
        if (requerido)
        {
            /*
             if (npn.val().length < 30 || npn.val().length > 30 || npn.val().length == 0)
             {
             npn.addClass("plg-has-error");
             $(".plg-help-block").show();
             return false;
             }*/
        }
        npn.removeClass("plg-has-error");
        $(".plg-help-block").hide();
        return true;
    }


    function validarB_NPN()
    {
        if (requerido)
        {/*
         if (b_npn.val().length < 30 || b_npn.val().length > 30 || b_npn.val().length == 0)
         {
         b_npn.addClass("plg-has-error");
         $(".plg-help-block").show();
         return false;
         }*/
        }
        b_npn.removeClass("plg-has-error");
        $(".plg-help-block").hide();
        return true;
    }

    function validarObligatorios()
    {
        /*
         if (dir.val().length == 0)
         {
         dir.addClass("plg-has-error");

         $('#V__a').val("");
         $('#No').val("");
         $('#No_Placa_1').val("");

         $('#V__a').addClass("plg-has-error");
         $('#No').addClass("plg-has-error");
         $('#No_Placa_1').addClass("plg-has-error");

         $("#error-dir").show();
         return false;
         }
         */
        if (($('#V__a').val() == "") || ($('#No').val() == "") || ($('#No_Placa_1').val() == ""))
        {
            $('#V__a').addClass("plg-has-error");
            $('#No').addClass("plg-has-error");
            $('#No_Placa_1').addClass("plg-has-error");

            $("#error-dir").show();
            return false;
        } else
        {
            dir.removeClass("plg-has-error");
            $('#V__a').removeClass("plg-has-error");
            $('#No').removeClass("plg-has-error");
            $('#No_Placa_1').removeClass("plg-has-error");

            $("#error-dir").hide();
            return true;
        }
    }

    function concatenarDireccion()
    {
        //direccionPluginNormalizada(compilada): es la dirección normalizada sin palabras ni caracteres especiales
        //direccionPluginVisual: Es la dirección que es etendible para las personas del comun
        direccionPluginVisual = (($('#V__a').val()).trim() + ' ' +
                ($('#No').val()).trim() +
                ($('#Letra').val()).trim() + ' ' +
                ($('#No_Sec').val()).trim() +
                ($('#Letra_Sec').val()).trim() + ' ' +
                ($('#BIS').val()).trim() + ' ' +
                $("#Sector option[value='" + $('#Sector').val() + "']").text() + ' ' +
                '# ' +
                ($('#Cruce').val()).trim() + ' ' +
                ($('#No_Placa_1').val()).trim() +
                ($('#Letra_P').val()).trim() + ' ' +
                ($('#No_Sec_P').val()).trim() +
                ($('#Letra_Sec_P').val()).trim() + ' ' +
                ($('#BIS_P').val()).trim() + ' ' +
                $("#Sector_P option[value='" + $('#Sector_P').val() + "']").text() + ' ');
        if (($('#No_Placa_2').val()).trim() !== '') {
            direccionPlugin += '- ';
        }
        direccionPluginVisual += ($('#No_Placa_2').val()).trim();

        direccionPluginNormalizada = (($('#V__a').val()).trim() + ' ' +
                ($('#No').val()).trim() +
                ($('#Letra').val()).trim() + ' ' +
                ($('#No_Sec').val()).trim() +
                ($('#Letra_Sec').val()).trim() + ' ' +
                ($('#BIS').val()).trim() + ' ' +
                ($('#Sector').val()).trim() + ' ' +
                ($('#Cruce').val()).trim() + ' ' +
                ($('#No_Placa_1').val()).trim() +
                ($('#Letra_P').val()).trim() + ' ' +
                ($('#No_Sec_P').val()).trim() +
                ($('#Letra_Sec_P').val()).trim() + ' ' +
                ($('#BIS_P').val()).trim() + ' ' +
                ($('#Sector_P').val()).trim() + ' ') +
                ($('#No_Placa_2').val()).trim();

        $('#direccionPluginVisual').val(direccionPluginVisual.replace(/\s\s+/g, ' ')).siblings('.plg-limpiar').show();
        $('#direccionPlugin').val(direccionPluginNormalizada.replace(/\s\s+/g, ' ')).siblings('.plg-limpiar').show();
    }


    function cargardivdireccion() {
//        $('#b_npn').val("");
//        $('#busquedadireccion').show();
//        $('#busquedanumeropredial').show();
//        $('#b_direccion').attr('readonly', false);
//        $('#b_npn').attr('readonly', true);
//        //$('#b_npn').val($('#resultado').attr('codigounico'));
        $('#busquedadireccion').show();
        $('#busquedanumeropredial').hide();
        $('#b_direccion').removeAttr("readonly");
        $('#b_npn').attr("readonly", true);
        $('#b_npn').val("");
        $('#b_direccion').val("");
    }

    function cargardivnpn() {
        $('#busquedanumeropredial').show();
        $('#busquedadireccion').hide();
        $('#b_direccion').val("");
        $('#b_npn').val("");
        $('#b_direccion').attr("readonly", true);
        $('#b_npn').removeAttr("readonly");
    }

</script>
<div class="plg-body">
    <div class="modal-dialog">
        <div id="modalWarning" class="modal modal-alert modal-warning fade" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <i class="fa fa-warning"></i>
                    </div>
                    <div class="modal-title">Campos Obligatorios</div>
                    <div class="modal-body">Debe llenar los campos vía, No, No Placa 1 y  No Placa 2</div>
                    <div class="modal-footer">
                        <a href="#" onclick="return <?= $_GET['fieldNamecallbackFunction']; ?>Warning()" class="plg-btn btn-warning" role="button" >Aceptar</a>
                    </div>
                </div> <!-- / .modal-content -->
            </div> <!-- / .modal-dialog -->
        </div>
        <form id="formNomenclaturaDireccion">
            <div class="modal-content">
                <span style="display:none" title="Cerrar Ventana" class="fa fa-times-circle fa-4x plg-cerrar"></span>
                <div class="modal-body div-no-padding">
                    <div id="formularioplugin">
                        <div class="row">
                            <div class="plg-col col-xs-8">
                                <div class="plg-titulo"> Dirección <i class="plg-npn-info fa fa-question-circle " data-toggle="tooltip" data-placement="right" title="" data-original-title="Previsualización de la dirección"></i></div>
                                <div class="">
                                    <input type="text" name="direccionPluginVisual" id="direccionPluginVisual" class="form-control" readonly="readonly">
                                    <input type="hidden" name="direccionPlugin" id="direccionPlugin" class="form-control" readonly="readonly">
                                    <span class="fa fa-eraser plg-limpiar" data-toggle="tooltip" data-placement="right" title="" data-original-title="Limpiar campo"></span>
                                    <div class="plg-help-block" id="error-dir">Campo requerido. Seleccione un tipo de vía y su respectiva nomenclatura</div>
                                </div>
                            </div>
                            <div class="plg-col col-xs-4">
                                <div class="plg-titulo"> Información adicional <i class="plg-npn-info fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="" data-original-title="Información complementaria de la dirección ej: Bloque A Apartamento 201"></i></div>
                                <input type="text" name="adicional" id="adicional" class="form-control" readonly="readonly">
                                <span class="fa fa-eraser plg-limpiar" data-toggle="tooltip" data-placement="right" title="" data-original-title="Limpiar campo"></span>
                            </div>
                        </div>
                        <div class="row plg-info plg-via">
                            <div class="plg-titulo text-center">Información de la Vía <i class="plg-npn-info fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="" data-original-title="Seleccionar información de la Vía ( Ej: K 24A )"></i></div>
                            <div class="plg-col col-xs-12">
                                <div class="row">
                                    <div class="plg-col col-xs-1 " >
                                        <small class="plg-small">
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-3 " >
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="V__a">Vía</label>
                                                <select class="form-control" name="Vía" id="V__a">
                                                    <option value="" selected="selected"></option>
                                                    <option value="A">Avenida</option>
                                                    <option value="C">Calle</option>
                                                    <option value="K">Carrera</option>
                                                    <option value="D">Diagonal</option>
                                                    <option value="P">Pasaje</option>
                                                    <option value="R">Rural</option>
                                                    <option value="T">Transversal</option>
                                                    <option value="U">Urbanización</option>
                                                </select>



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-1 ">
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="No">No</label>
                                                <input placeholder="#" class="form-control numero" maxlength="3" type="text" name="No" id="No" />



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-1 text-light-gray">
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="Letra">Letra</label>
                                                <select class="form-control" name="Letra" id="Letra">
                                                    <option value="" selected="selected"></option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                    <option value="E">E</option>
                                                    <option value="F">F</option>
                                                    <option value="G">G</option>
                                                    <option value="H">H</option>
                                                    <option value="I">I</option>
                                                    <option value="J">J</option>
                                                    <option value="K">K</option>
                                                    <option value="L">L</option>
                                                    <option value="M">M</option>
                                                    <option value="N">N</option>
                                                    <option value="Ñ">Ñ</option>
                                                    <option value="O">O</option>
                                                    <option value="P">P</option>
                                                    <option value="Q">Q</option>
                                                    <option value="R">R</option>
                                                    <option value="S">S</option>
                                                    <option value="T">T</option>
                                                    <option value="U">U</option>
                                                    <option value="V">V</option>
                                                    <option value="W">W</option>
                                                    <option value="X">X</option>
                                                    <option value="Y">Y</option>
                                                    <option value="Z">Z</option>
                                                </select>



                                            </div>
                                        </small>
                                    </div>

                                    <div class="plg-col col-xs-1 text-light-gray">
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="No_Sec">No Sec</label>
                                                <input placeholder="#" class="form-control numero" maxlength="3" type="text" name="No Sec" id="No_Sec" />



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-1 text-light-gray">
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="Letra_Sec">Letra Sec</label>
                                                <select class="form-control" name="Letra Sec" id="Letra_Sec">
                                                    <option value="" selected="selected"></option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                    <option value="E">E</option>
                                                    <option value="F">F</option>
                                                    <option value="G">G</option>
                                                    <option value="H">H</option>
                                                    <option value="I">I</option>
                                                    <option value="J">J</option>
                                                    <option value="K">K</option>
                                                    <option value="L">L</option>
                                                    <option value="M">M</option>
                                                    <option value="Ñ">Ñ</option>
                                                    <option value="P">P</option>
                                                    <option value="Q">Q</option>
                                                    <option value="R">R</option>
                                                    <option value="S">S</option>
                                                    <option value="T">T</option>
                                                    <option value="U">U</option>
                                                    <option value="V">V</option>
                                                    <option value="W">W</option>
                                                    <option value="X">X</option>
                                                    <option value="Y">Y</option>
                                                    <option value="Z">Z</option>
                                                </select>



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-1 text-light-gray">
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="BIS">BIS</label>
                                                <select class="form-control" name="BIS" id="BIS">
                                                    <option value="" selected="selected"></option>
                                                    <option value="BIS
                                                            ">BIS</option>
                                                </select>



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-2 text-light-gray">
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="Sector">Sector</label>
                                                <select class="form-control" name="Sector" id="Sector">
                                                    <option value="" selected="selected"></option>
                                                    <option value="N">Norte</option>
                                                    <option value="O">Oeste</option>
                                                </select>



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-2 " >
                                        <small class="plg-small">
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row plg-info plg-placa">
                            <div class="plg-titulo text-center">Información de la Placa <i class="plg-npn-info fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="" data-original-title="Ingresar información de la Placa ( Ej: 72B 04 ) Cruce: Si la placa lleva Transversal o Diagonal, No Placa 1: Primer número de la placa, Letra P:  Si el primer número de la placa tiene asociada una letra, No Sec P: Si la letra del primer número tiene asociado un número, Letra Sec P: si el No Sec P tiene asociada una letra"></i></div>
                            <div class="plg-col col-xs-12">
                                <div class="row">
                                    <div class="plg-col col-xs-1 text-light-gray">
                                        <small class="plg-small">
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-1 text-light-gray">
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="Cruce">Cruce</label>
                                                <select class="form-control" name="Cruce" id="Cruce">
                                                    <option value="" selected="selected"></option>
                                                    <option value="D">D</option>
                                                    <option value="T">T</option>
                                                </select>



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-1">
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="No_Placa_1">No Placa 1</label>
                                                <input placeholder="#" class="form-control numero" maxlength="3" type="text" name="No Placa 1" id="No_Placa_1" />



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-1 text-light-gray">
                                        <small>
                                            <div class="form-group  ">
                                                <label class="control-label" for="Letra_P">Letra P</label>
                                                <select class="form-control" name="Letra P" id="Letra_P">
                                                    <option value="" selected="selected"></option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                    <option value="E">E</option>
                                                    <option value="F">F</option>
                                                    <option value="G">G</option>
                                                    <option value="H">H</option>
                                                    <option value="I">I</option>
                                                    <option value="J">J</option>
                                                    <option value="K">K</option>
                                                    <option value="L">L</option>
                                                    <option value="M">M</option>
                                                    <option value="N">N</option>
                                                    <option value="Ñ">Ñ</option>
                                                    <option value="O">O</option>
                                                    <option value="P">P</option>
                                                    <option value="Q">Q</option>
                                                    <option value="R">R</option>
                                                    <option value="S">S</option>
                                                    <option value="T">T</option>
                                                    <option value="U">U</option>
                                                    <option value="V">V</option>
                                                    <option value="W">W</option>
                                                    <option value="X">X</option>
                                                    <option value="Y">Y</option>
                                                    <option value="Z">Z</option>
                                                </select>



                                            </div>
                                        </small>
                                    </div>

                                    <div class="plg-col col-xs-1 text-light-gray">
                                        <small>
                                            <div class="form-group  ">
                                                <label class="control-label" for="No_Sec_P">No Sec P</label>
                                                <input placeholder="#" class="form-control numero" maxlength="3" type="text" name="No Sec P" id="No_Sec_P" />



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-2 text-light-gray">
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="Letra_Sec_P">Letra Sec P</label>
                                                <select class="form-control" name="Letra Sec P" id="Letra_Sec_P">
                                                    <option value="" selected="selected"></option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                    <option value="E">E</option>
                                                    <option value="F">F</option>
                                                    <option value="G">G</option>
                                                    <option value="H">H</option>
                                                    <option value="I">I</option>
                                                    <option value="J">J</option>
                                                    <option value="K">K</option>
                                                    <option value="L">L</option>
                                                    <option value="M">M</option>
                                                    <option value="N">N</option>
                                                    <option value="O">O</option>
                                                    <option value="P">P</option>
                                                    <option value="Q">Q</option>
                                                    <option value="R">R</option>
                                                    <option value="S">S</option>
                                                    <option value="T">T</option>
                                                    <option value="U">U</option>
                                                    <option value="V">V</option>
                                                    <option value="W">W</option>
                                                    <option value="X">X</option>
                                                    <option value="Y">Y</option>
                                                    <option value="Z">Z</option>
                                                </select>



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-1 text-light-gray">
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="BIS_P">BIS P</label>
                                                <select class="form-control" name="BIS P" id="BIS_P">
                                                    <option value="" selected="selected"></option>
                                                    <option value="BIS
                                                            ">BIS</option>
                                                </select>



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-2 text-light-gray">
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="Sector_P">Sector P</label>
                                                <select class="form-control" name="Sector P" id="Sector_P">
                                                    <option value="" selected="selected"></option>
                                                    <option value="N">Norte</option>
                                                    <option value="O">Oeste</option>
                                                </select>



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-1 ">
                                        <small class="plg-small">

                                            <div class="form-group  ">
                                                <label class="control-label" for="No_Placa_2">No Placa 2</label>
                                                <input placeholder="#" class="form-control numero" maxlength="3" type="text" name="No Placa 2" id="No_Placa_2" />



                                            </div>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row plg-info plg-infoadicional">
                            <div class="plg-titulo text-center">Informaci&oacute;n Adicional <i class="plg-npn-info fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="" data-original-title="Ingresar informacón complementaria de la dirección ( Ej: Bloque A Apto 201 )"></i></div>
                            <div class="plg-col col-xs-12">
                                <div class="row">
                                    <div class="plg-col col-xs-1">
                                        <small class="plg-small">
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-4">
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="Descripci__n_Interior">Descripción Interior</label>
                                                <select class="form-control" name="Descripción Interior" id="Descripci__n_Interior">
                                                    <option value="" selected="selected"></option>
                                                    <option value="P">Apartamento</option>
                                                    <option value="Bloque">Bloque (Torre o Edificio)</option>
                                                    <option value="K">Cabaña</option>
                                                    <option value="C">Casa</option>
                                                    <option value="D">Depósito o Bodega</option>
                                                    <option value="G">Garaje</option>
                                                    <option value="R">Jarillón</option>
                                                    <option value="L">Local</option>
                                                    <option value="T">Manzana - Bloque</option>
                                                    <option value="O">Oficina</option>
                                                    <option value="Piso">Piso</option>
                                                    <option value="Unidad Predial">Unidad Predial</option>
                                                </select>



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-4">
                                        <small class="plg-small">
                                            <div class="form-group  ">
                                                <label class="control-label" for="Valor">Valor</label>
                                                <input placeholder="  " class="form-control " type="text" name="Valor" id="Valor" />



                                            </div>
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-1">
                                        <small class="plg-small">
                                            <label>&NonBreakingSpace;</label>
                                            <a href="#" onclick="return concatenarAdicional()" class="plg-btn btn-primary " role="button"  >Adicionar</a>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="plg-col col-xs-12">
                                <div class="row">
                                    <div class="plg-col col-xs-8">
                                        <small class="plg-small">
                                        </small>
                                    </div>
                                    <div class="plg-col col-xs-4">
                                        <small class="plg-small">
                                            <a href="#" id="plg-guardar" class="btn plg-btn btn-primary " role="button" >Guardar Dirección</a>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- / .formularioplugin -->
                </div> <!-- / .modal-body -->
            </div> <!-- / .modal-content -->
        </form>
    </div> <!-- / .modal-dialog -->
</div>

<input type="hidden" value="" id="hiden_direccion" name="hiden_direccion"/>
<input type="hidden" value="" id="hiden_direccion_observacion" name="hiden_direccion_observacion"/>
