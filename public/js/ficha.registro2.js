var editar_variable = false;
function fechas_menos18()
{
$('#id_persona_beneficiario_fecha_nacimiento').datepicker({
dateFormat: 'yy-mm-dd',
changeMonth: true,
changeYear: true,
showButtonPanel: true,
yearRange: "1910:+nn",
maxDate:("0")
//yearRange: "-18:-6",
}).attr('readonly', 'readonly').attr('style','background-color:#FFF;cursor:text');
}
function fechas_mas18()
{
$('#id_persona_beneficiario_fecha_nacimiento').datepicker({
dateFormat: 'yy-mm-dd',
changeMonth: true,
changeYear: true,
showButtonPanel: true,
yearRange: "-40:-6",
}).attr('readonly', 'readonly').attr('style','background-color:#FFF;cursor:text');
}
function SearchVeredas(idCorregimiento)
{
	if ($('#id_persona_beneficiario_id_residencia_corregimiento').val() != '')
	{
		$.ajax({
			url: base + '/veredas/corregimiento/' + $('#id_persona_beneficiario_id_residencia_corregimiento').val(),
			dataType: 'json',
			async: false,
			success: function (data, textStatus, jqXHR){
				var temp = '<option>Seleccione</option>';
				$.each(data, function (index, value){
					var selected = "";
					if(idCorregimiento != undefined && idCorregimiento != ""){
							selected = "selected";
					}
					temp += '<option value="' + value.id + '" '+selected+'>' + value.nombre + '</value>';
				});
				$('#id_persona_beneficiario_id_residencia_vereda').html(temp);
			}
		});
    }
}
    function corregimientos_veredas()
    {
		$('#id_persona_beneficiario_id_residencia_corregimiento').change(function ()
		{
			SearchVeredas();
		});
    }
    function search_data_pais(id_pais)
    {
    if (id_pais == '1')
    {
    $('#show_contry').hide();
    $('#other_contry').show();
    $('#id_persona_beneficiario_id_procedencia_municipio').attr('required', 'required');
    $.ajax({
    url: base + '/ubicacion/departamentos',
    data: {id: $('#id_persona_beneficiario_id_procedencia_pais').val()},
    type: 'POST',
    async: false,
    dataType: 'json',
    success: function (data)
    {
    $('#id_persona_beneficiario_id_procedencia_departamento').select({
    value: 'id',
    name: 'nombre_departamento',
    data: data
    });
    $('#id_persona_beneficiario_id_procedencia_departamento').val(76);
    search_municipios();
    $('#id_persona_beneficiario_id_procedencia_municipio').val(834);
    $('#id_persona_beneficiario_id_procedencia_municipio').trigger('change.select2');
    }
    });
    }
    else
    {
    $('#show_contry').show();
    $('#other_contry').hide();
    $('#id_persona_beneficiario_id_procedencia_departamento').val('');
    $('#id_persona_beneficiario_id_procedencia_municipio').val('');
    $('#id_persona_beneficiario_id_procedencia_municipio').removeAttr('required');
    }
    }
    function change_pais()
    {
    $('#show_contry').hide();
    $('#id_persona_beneficiario_id_procedencia_pais').change(function ()
    {
    search_data_pais($('#id_persona_beneficiario_id_procedencia_pais').val());
    });
    }
    function search_municipios()
    {
    $.ajax({
    url: base + '/ubicacion/municipios',
    data: {id: $('#id_persona_beneficiario_id_procedencia_departamento').val()},
    type: 'POST',
    async: false,
    dataType: 'json',
    success: function (data)
    {
    $('#id_persona_beneficiario_id_procedencia_municipio').select({
    value: 'id',
    name: 'nombre_municipio',
    data: data
    });
    }
    });
    }
    function change_departamento()
    {
    $('#id_persona_beneficiario_id_procedencia_departamento').change(function ()
    {
    search_municipios();
    });
    }
    function comuna()
    {
    var comuna = $('#id_persona_beneficiario_id_residencia_barrio option:selected').attr('data-comuna');
    var id_estrato = $('#id_persona_beneficiario_id_residencia_barrio option:selected').attr('data-id_estrato');
    $('#numero_comuna').html(comuna);
    $('#id_persona_beneficiario_residencia_estrato').val(id_estrato);
    }
    function direccion()
    {
    $('.formlista').change(function ()
    {
    var direccion = '';
    $.each($('.formlista'), function (index, value)
    {
    if ($(value).val() != '')
    {
    direccion = direccion + ' ' + $(value).val();
    }
    });
    direccion = $.trim(direccion);
    $('#id_persona_beneficiario_residencia_direccion').val(direccion);
    });
    }
    function otro_etnia()
    {
    $('.other').hide();
    $('.etnia_radio').click(function ()
    {
    if ($(this).val() == '7')
    {
    $('.other').show();
    $('#se_reconoce_como_cual').attr('required', 'required');
    $('#se_reconoce_como_cual').val('');
    } else
    {
    $('.other').hide();
    $('#se_reconoce_como_cual').removeAttr('required');
    }
    });
    }
    function enfermedad()
    {
    $('#ficha_enfermedad_padece_si').change(function ()
    {
    if ($('#ficha_enfermedad_padece_si').val() == 'si')
    {
    $('#ficha_enfermedad_padece_nombre').show();
    } else
    {
    $('#ficha_enfermedad_padece_nombre').hide();
    }
    })
    }
    function medicamentos()
    {
    $('#ficha_medicamentos_toma_si').change(function ()
    {
    if ($('#ficha_medicamentos_toma_si').val() == 'si')
    {
    $('#ficha_medicamentos_toma_nombre').show();
    } else
    {
    $('#ficha_medicamentos_toma_nombre').hide();
    }
    })
    ficha_medicamentos_toma_si
    }
    function registrar_datos(data)
    {
    if (data.beneficiario !== null)
    {
    $.each(data.beneficiario, function (index, value)
    {
    if (index === 'id_procedencia_pais')
    {
    search_data_pais(value);
    }
    var name = '#id_persona_beneficiario_' + index;
    $(name).val(value);
    $(name).trigger('change.select2');
    });
    }
    if (data.ficha !== null)
    {
    $.each(data.ficha, function (index, value)
    {
    $('#ficha_' + index).val(value);
    });
    }
    validate_discapacidades();
    if (data.acudiente !== null)
    {
    $.each(data.acudiente, function (index, value)
    {
    $('#id_persona_acudiente_' + index).val(value);
    });
    }
    if(data.grupo_poblacional!=null){
		$.each(data.grupo_poblacional, function(index,value){
			$('#id_grupo_poblacional_' + value).prop('checked', true);
		});
    }
    search_municipios();
    validateveredas();
    $('#id_persona_beneficiario_id_procedencia_municipio').val(data.beneficiario.id_procedencia_municipio);
    $('#id_persona_beneficiario_id_residencia_vereda').val(data.beneficiario.id_residencia_vereda);
    SearchVeredas();
    validate_ficha_padece_enfermedad();
    validate_ficha_medicamentos_toma_si();
    var edad = calcularEdad($('#id_persona_beneficiario_fecha_nacimiento').val())
    $('#id_persona_beneficiario_edad').html(
    edad + ' años');
    filter_regimen();
    }
    function Buscar_documentos()
    {
    $('#id_persona_acudiente_documento').change(function ()
    {
    $.ajax({
    url: base + '/persona/search', //'ficha_create',
    data: {documento: $('#id_persona_acudiente_documento').val()},
    type: 'POST',
    dataType: 'json',
    success: function (data)
    {
    $.each(data.beneficiario, function (index, value)
    {
    if (index === 'id_procedencia_pais')
    {
    search_data_pais(value);
    }
    $('#id_persona_acudiente_' + index).val(value);
    });
    }
    });
    })
    $('#persona_documento').change(function ()
    {
    if($('#change').val()=='false')
    {
    buscarDocumento();
    }
    });
    }
    function editar(id_ficha)
    {
    
    editar_variable = true;
    $.ajax({
		url: base + '/ficha/registrar/' + id_ficha,
		dataType: 'json',
		success: function (data, textStatus, jqXHR)
		{
			$.each(data, function (index, value)
			{
				
				$('#' + index).val(value);
				$('#' + index).trigger('change.select2');
				$('#' + index).prop('checked', true);
				
				// verificamos pais
				if(index == 'id_persona_beneficiario_id_procedencia_pais'){
					search_data_pais(value);
				}
				
				// verificamos corregimiento
				if(index == "id_persona_beneficiario_id_residencia_corregimiento"){
					SearchVeredas(value);
				}
				
				// verificamos comuna
				if(index == "id_persona_beneficiario_id_residencia_barrio"){
					comuna();
				}
				
				// verificamos años
				if(index == "id_persona_beneficiario_fecha_nacimiento"){
					$('#id_persona_beneficiario_fecha_nacimiento').change();
				}
				
				// verificamos orientacion sexual
				if(index == "tipo_orientacion_sexual"){
					if(parseInt(value)==13){
						$('#rowOtroOrientacionSexual').show();
					}
				} 
				
				// verificamos acudiente
				if(index == "id_persona_acudiente_documento"){
					if(parseInt(value)!=-1){
						$("#panelBodyAcudiente").show();
					}
				} 
				
				// verificamos grupo poblacional
				if(index.indexOf("id_grupo_poblacional") != -1){
					if(parseInt(index.split("_")[3]) == 10 || parseInt(index.split("_")[3]) == 11){
						$("#"+index).change();
					}
				}
				
				// verificamos discapacidad
				if(index.indexOf("id_discapacidad") != -1){
					
					$("#ficha_tiene_discapacidad").val("1");
					
					setTimeout(function(){
						$("#posee_discapacidad").show();
						$("#posee_discapacidad_otro").show();
					},2000);
				}
				
				// verificamos sexo acudiente
				if(index == "id_persona_acudiente_sexo"){
					if(parseInt(value)==3){
						$("#id_persona_acudiente_sexo_otro").show();
					}
				}
				
			}); // end each 
		}
    });
    }
    function buscarDocumento()
    {
    if ($('#persona_documento').val() != '')
    {
    $('input[type=text],input[type=number],input[type=email]').each(function (index, value)
    {
    if ($(value).attr('id') != 'persona_documento')
    {
    $(value).val('');
    }
    })
    $('input[type=checkbox]').prop('checked', false);
    $('#save_button').removeAttr('disabled');
    $.ajax({
    url: base + '/persona/search', //'ficha_create',
    data: {documento: $('#persona_documento').val()},
    type: 'POST',
    dataType: 'json',
    success: function (data)
    {
    if (typeof data.beneficiario.nombre_primero === "undefined")
    {
    $('#id_persona_beneficiario_nombre_primero,#id_persona_beneficiario_nombre_segundo,#id_persona_beneficiario_apellido_primero,#id_persona_beneficiario_apellido_segundo').removeAttr('readonly', 'readonly');
    }
    else if ($.trim(data.beneficiario.nombre_primero) !== "")
    {
    $('#id_persona_beneficiario_nombre_primero,#id_persona_beneficiario_nombre_segundo,#id_persona_beneficiario_apellido_primero,#id_persona_beneficiario_apellido_segundo').attr('readonly', 'readonly');
    }
    var documento = $('#id_persona_acudiente_documento').val();
    $('form')[0].reset();
    $('#id_persona_acudiente_documento').val(documento);
    registrar_datos(data);
    if (data.grupos.cantidad_inscritos >= data.grupos.maximo)
    {
    var text='El beneficiario que intenta ingresar ya se encuentra inscrito en ' + data.grupos.cantidad_inscritos +  ' grupos:';
    text+='<table id="table_beneficiarios">';
        text+='<tr id="table_beneficiarios_head">'+
            '<th style="width: 10%;">Monitor</th>'+
            '<th style="width: 10%;">Comuna</th>'+
            '<th style="width: 10%;">Disciplina</th>'+
            '<th style="width: 10%;">Codigo</th>'+
            '<th style="width: 60%;">Horario</th></tr>';
            $.each(data.grupos.data,function(index,value)
            {
            value.horario=value.horario.replace(/,/g, "<br/>");
            text+='<tr>';
                text+='<td>'+value.monitor+'</td>';
                text+='<td>'+value.comuna+'</td>';
                text+='<td>'+value.disciplina+'</td>';
                text+='<td>'+value.codigo_grupo+'</td>';
                text+='<td>'+value.horario+'</td>';
            text+='</tr>';
            });
        text+='</table>';
        //                   swal("Error", "<table><tr><td>123</td><td>123</td><td>123</td></tr><tr><td>123</td><td>123</td><td>123</td></tr></table>Este beneficiario ya se encuentra registrado en otros grupos. El numero máximo de registro por beneficiario es de " + data.grupos.maximo + " grupos", "warning");
        swal({
        title: text,
        type: 'error',
        html: text,
        showCloseButton: true,
        focusConfirm: false,
        });
        $('#save_button').attr('disabled', 'disabled');
        }
        }
        });
        }
        }
        function check_other()
        {
        $('#hide_cual').hide();
        $('#ocupacion_8').click(function ()
        {
        if (!$(this).is(':checked'))
        {
        $('#hide_cual').hide();
        } else
        {
        $('#hide_cual').show();
        }
        })
        }
        function discapacidad()
        {
			$('#posee_discapacidad').hide();
			$('#ficha_tiene_discapacidad').change(function (){
				validate_discapacidades();
			});
			$('#id_discapacidad_12').click(function (){
				$("#condicion_discapacidad_otro").val("");
				if($(this).is(":checked")){
					$("#posee_discapacidad_otro").show(500, "");
				}else{
					$("#posee_discapacidad_otro").hide();
				}
			});
        }
        function validate_discapacidades()
        {
        $('#id_persona_beneficiario_fecha_nacimiento').val('');
        $('#id_persona_beneficiario_fecha_nacimiento').datepicker( "destroy" );
        if ($('#ficha_tiene_discapacidad').val() == '1')
        {
        fechas_mas18();
        $('#posee_discapacidad').show();
        }
        else
        {
        fechas_menos18();
        $('#posee_discapacidad').hide();
        }
        }
        function validate_ficha_padece_enfermedad()
        {
        if ($('#ficha_enfermedad_padece_si').val() == 'si')
        {
        $('#div_enfermedad').show();
        $('#ficha_enfermedad_padece_nombre').attr('required', 'required');
        }
        else
        {
        $('#div_enfermedad').hide();
        $('#ficha_enfermedad_padece_nombre').removeAttr('required');
        }
        }
        function ficha_padece_enfermedad()
        {
        $('#div_enfermedad').hide();
        $('#ficha_enfermedad_padece_si').change(function ()
        {
        validate_ficha_padece_enfermedad();
        });
        }
        function validate_ficha_medicamentos_toma_si()
        {
        if ($('#ficha_medicamentos_toma_si').val() == 'si')
        {
        $('#div_ficha_medicamentos_toma_si').show();
        $('#ficha_medicamentos_toma_nombre').attr('required', 'required');
        }
        else
        {
        $('#div_ficha_medicamentos_toma_si').hide();
        $('#ficha_medicamentos_toma_nombre').removeAttr('required');
        }
        }
        function ficha_medicamentos_toma_si()
        {
        $('#div_ficha_medicamentos_toma_si').hide();
        $('#ficha_medicamentos_toma_si').change(function ()
        {
        validate_ficha_medicamentos_toma_si();
        });
        }
        function validateveredas()
        {
        if ($.trim($('#id_persona_beneficiario_id_residencia_vereda').val()) == '')
        {
        $('#direcciones_rurales').show();
        $('#id_persona_beneficiario_residencia_direccion_observacion').attr('readonly', 'true');
        }
        else
        {
        $('#direcciones_rurales').hide();
        $('#id_persona_beneficiario_residencia_direccion_observacion').removeAttr('readonly');
        }
        }
        function change_veredas()
        {
        $('#id_persona_beneficiario_id_residencia_vereda').change(function ()
        {
        validateveredas();
        });
        }
        function validaciones()
        {
        change_veredas();
        discapacidad();
        ficha_padece_enfermedad();
        ficha_medicamentos_toma_si();
        }
        function filter_regimen()
        {
        $('.regimenes').attr('style', 'display:none');
        $('.regimen_' + $('#ficha_id_salud_regimen').val()).removeAttr('style');
        }
        function EPS_regimen()
        {
        $('#ficha_id_salud_regimen').change(function ()
        {
        $('#ficha_id_eps').val('');
        filter_regimen();
        });
        }
        function required(){
			var result=true;
			$('form').validate();
			result=$('form').valid()?result:false;
			if($('#id_persona_beneficiario_fecha_nacimiento').val()==''){
				result=false;
				$("#id_persona_beneficiario_fecha_nacimiento").focus();
			}
			if($('#direcciones_rurales').attr('style')!=='display: none;'){
				if($('#id_persona_beneficiario_residencia_direccion').val()==''){
					result=false;
					$("#id_persona_beneficiario_residencia_direccion").focus();
				}
			}
			return result;
        }
        $(function ()
        {
			// evento de tiene acudiente
			$("#chkTieneAcudiente").click(function(){
				$("#panelBodyAcudiente").hide();
				
				$("#id_documento_tipo").val("1").removeAttr("required");
				$("#id_persona_acudiente_documento").val("-1").removeAttr("required");
				$("#id_persona_acudiente_nombre_primero, #id_persona_acudiente_apellido_primero").val("").removeAttr("required");
				$("#id_persona_acudiente_fecha_nacimiento, #id_persona_beneficiario_sexo").val("").removeAttr("required");
				$("#ficha_id_persona_acudiente_parentesco, #ficha_id_persona_vive_con_parentesco").val("").removeAttr("required");
				if($(this).is(":checked")){
					$("#panelBodyAcudiente").show(500,"");
					$("#id_documento_tipo, #id_persona_acudiente_documento").val("").attr("required", true);
					$("#id_persona_acudiente_nombre_primero, #id_persona_acudiente_apellido_primero").val("").attr("required", true);
					$("#id_persona_acudiente_fecha_nacimiento, #id_persona_beneficiario_sexo").val("").attr("required", true);
					$("#ficha_id_persona_acudiente_parentesco, #ficha_id_persona_vive_con_parentesco").val("").attr("required", true);
				}
			});
			
			// change de cambio de orientacion sexual
			$("#tipo_orientacion_sexual").change(function(){
				$("#rowOtroOrientacionSexual").hide();
				$("#rowOtroOrientacionSexual").val("");
				$("#orientacion_sexual_otro").val("N/A").change();
				if(parseInt($(this).val()) == 13){
					$("#rowOtroOrientacionSexual").show(500,"");
					$("#orientacion_sexual_otro").val("").change();
				}
			});
			
			fechas_menos18();
			$('.select2_create').select2();
			EPS_regimen();
			
			// ocultamos campos de otros y club
			$('#grupo_poblacional_otro').hide();
			$('#grupo_poblacional_club').hide();
			// evento chk otro
			$('#id_grupo_poblacional_10').change(function (){
				if ($('#id_grupo_poblacional_10').is(':checked')){
					$('#grupo_poblacional_otro').show();
					$('#grupo_poblacional_otro').attr('required', 'required');
				} else{
					$('#grupo_poblacional_otro').hide();
					$('#grupo_poblacional_otro').val('');
					$('#grupo_poblacional_otro').removeAttr('required');
				}
			});
			// evento chk club
			$('#id_grupo_poblacional_11').change(function (){
				if ($('#id_grupo_poblacional_11').is(':checked')){
					$('#grupo_poblacional_club').show();
					$('#grupo_poblacional_club').attr('required', 'required');
				} else{
					$('#grupo_poblacional_club').hide();
					$('#grupo_poblacional_club').val('');
					$('#grupo_poblacional_club').removeAttr('required');
				}
			});
			
			corregimientos_veredas();
			$('#hide_cual').hide();
			$('#panel_participado_antes').hide();
			$('#participado_antes').change(function (){
			if ($(this).val() == 'si')
			{
			$('#panel_participado_antes').show();
			} else
			{
			$('#panel_participado_antes').hide();
			}
			});
			//check_other();
			otro_etnia();
			comuna();
			direccion();
			enfermedad();
			medicamentos();
			Buscar_documentos();
			change_pais();
			change_departamento();
			$('input').keyup(function (){
			//$(this).val($(this).val().toUpperCase());
			});
			$('#id_persona_beneficiario_id_residencia_barrio').change(function ()
			{
			comuna();
			});
			$('#id_persona_acudiente_fecha_nacimiento').change(function ()
			{
			$('#id_persona_acudiente_edad').html(calcularEdad($('#id_persona_acudiente_fecha_nacimiento').val()));
			});
		
			$('#id_persona_beneficiario_fecha_nacimiento').change(function (){
				$('#id_persona_beneficiario_edad').html(calcularEdad($('#id_persona_beneficiario_fecha_nacimiento').val()) + ' años');
			});
		
        $('form').submit(function (e)
        {

            if ($('#id_persona_acudiente_documento').val() == $('#persona_documento').val()){
				swal("Error", "Documento no puede ser el mismo del beneficiario", "warning");
				$('#id_persona_acudiente_documento').val('');
			}
			else{
				//$('button').attr('disabled','disabled');
				e.preventDefault();
				if (editar_variable){
					var url = base + '/ficha/editar';
				}
				else{
					var url = base + '/ficha/create';
				}
				if(required()){
				if ($('#persona_documento').val() == '')
				{
					swal("Error", "Documento no puede estar vacio", "warning");
				}
				else{
					
					if ( $("#chkTieneAcudiente").is(":checked") && 
					($('#id_persona_acudiente_documento').val() == "" || 
					$('#id_persona_acudiente_nombre_primero').val() == "" || $('#id_persona_acudiente_apellido_primero').val() == "" || 
					$('#id_persona_acudiente_fecha_nacimiento').val() == "" ||
					$('#ficha_id_persona_acudiente_parentesco').val() == "" || $('#ficha_id_persona_vive_con_parentesco').val() == "" || 
					
					$('#id_persona_acudiente_documento').val() == undefined || 
					$('#id_persona_acudiente_nombre_primero').val() == undefined || $('#id_persona_acudiente_apellido_primero').val() == undefined || 
					$('#id_persona_acudiente_fecha_nacimiento').val() == undefined ||
					$('#ficha_id_persona_acudiente_parentesco').val() == undefined || $('#ficha_id_persona_vive_con_parentesco').val() == undefined)
					){
						swal("Error", "Debe diligenciar todos los campos obligatorios del acudiente", "warning");
					}else{
							$.ajax({
								url: url, //'ficha_create',
								data: $('form').serialize(),
								type: 'post',
								dataType: 'json',
								success: function (data)
								{
									
									if (data.validacion == 1){
										swal("Error!", "Este beneficiario ya esta en su grupo "+data.datos[0].codigo_grupo+" .", "warning");
									}
									if(data.validacion == 2)
									{
										if (data.validate)
										{        
											swal({
											title: "Ficha No " +  data.ficha+" .",
											text: "Guardado con exito",
											type: "success",
											closeOnConfirm: false,
											showLoaderOnConfirm: true
											}, function () {
												location.href = base + '/admin/postgrupos#/admin/postgrupos/misbeneficiarios/' + data.grupo;
											});
										}
										else{
											$('button').removeAttr('disabled');
										}
									}
								},
								error: function (jqXHR, textStatus, errorThrown){
								$.ajax({
									url: base + '/error/notificar',
									type: 'POST',
								data: {
									responsetexto: jqXHR.responseText,
									data_form: $('form').serializeArray(),
									url_system: window.location.href
								},
								success: function (){
									swal("Error", "Se presento un error inesperado", "warning");
								}
								});
							}
							});
							// END ajax
					}		
				}
        }
}
        });
        $('#id_persona_beneficiario_documento').addClass('only_number');
        $('#id_persona_beneficiario_documento').inputmask({alias: 'decimal', rightAlign: true, groupSeparator: ',', digits: 0, autoGroup: true});
        $('#id_persona_beneficiario_id_documento_tipo').change(function ()
        {
        if ($(this).val() == '5')
        {
        $('#id_persona_beneficiario_documento').removeClass('only_number');
        $('#id_persona_beneficiario_documento').inputmask('remove');
        } else
        {
        $('#id_persona_beneficiario_documento').addClass('only_number');
        $('#id_persona_beneficiario_documento').inputmask({alias: 'decimal', rightAlign: true, groupSeparator: ',', digits: 0, autoGroup: true});
        }
        });
        $('#id_persona_acudiente_documento').inputmask({alias: 'decimal', rightAlign: true, groupSeparator: ',', digits: 0, autoGroup: true});
        $('#id_documento_tipo').change(function ()
        {
        if ($(this).val() == '5')
        {
        $('#id_persona_acudiente_documento').removeClass('only_number');
        $('#id_persona_acudiente_documento').inputmask('remove');
        } else
        {
        $('#id_persona_acudiente_documento').addClass('only_number');
        $('#id_persona_acudiente_documento').inputmask({alias: 'decimal', rightAlign: true, groupSeparator: ',', digits: 0, autoGroup: true});
        }
        });
        $('#id_persona_beneficiario_residencia_direccion').add_generator({
        direccion: 'id_persona_beneficiario_residencia_direccion',
        complemento: 'id_persona_beneficiario_residencia_direccion_complemento',
        });
        $('#discapacidad_hide').change(function ()
        {
        if ($(this).val() == '1')
        {
        $('#discapacidad_div').show();
        $('#tiempo_meses').val('');
        } else
        {
        $('#discapacidad_div').hide();
        }
        });
        otros_parentescos();
        $('#form_ficha').validate();
		
        });
        function otros_parentescos()
        {
        $('#other_parentesco,#other_vive_con').hide();
        $('#ficha_id_parentesco').change(function ()
        {
        if ($(this).val() == '6')
        {
        $('#other_parentesco').show();
        $('#ficha_persona_acudiente_parentesco_otro').attr('required', 'required');
        $('#ficha_persona_acudiente_parentesco_otro').val('');
        } else
        {
        $('#other_parentesco').hide();
        $('#ficha_persona_acudiente_parentesco_otro').removeAttr('required');
        }
        });
		
		// parentezco
        $('#ficha_id_persona_acudiente_parentesco').change(function (){
			if ($(this).val() == '6')
			{
				$('#other_parentesco').show();
				$('#ficha_persona_acudiente_parentesco_otro').attr('required', 'required');
				$('#ficha_persona_acudiente_parentesco_otro').val('');
			} else{
				$('#other_parentesco').hide();
				$('#ficha_persona_acudiente_parentesco_otro').removeAttr('required');
			}
        });
		
		// cambia vive con parentezco
        $('#ficha_id_persona_vive_con_parentesco').change(function (){
			if ($(this).val() == '6')
			{
				$('#other_vive_con').show();
				$('#ficha_persona_vive_con_parentesco_otro').attr('required', 'required');
				$('#ficha_persona_vive_con_parentesco_otro').val('');
			} else{
				$('#other_vive_con').hide();
				$('#ficha_persona_vive_con_parentesco_otro').removeAttr('required');
			}
        });
		
		// evento chk otro
        $('#id_grupo_poblacional_10').change(function (){
			if ($(this).is(':checked')){
				$('#ficha_grupo_poblacional_otro').show();
				$('#ficha_grupo_poblacional_otro').attr('required', 'required');
				$('#ficha_grupo_poblacional_otro').val('');
			} else{
				$('#ficha_grupo_poblacional_otro').hide();
				$('#ficha_grupo_poblacional_otro').removeAttr('required');
				$('#ficha_grupo_poblacional_otro').val('');
			}
        });
		$('#id_grupo_poblacional_11').change(function (){
			if ($(this).is(':checked')){
				$('#ficha_grupo_poblacional_club').show();
				$('#ficha_grupo_poblacional_club').attr('required', 'required');
				$('#ficha_grupo_poblacional_club').val('');
			} else{
				$('#ficha_grupo_poblacional_club').hide();
				$('#ficha_grupo_poblacional_club').removeAttr('required');
				$('#ficha_grupo_poblacional_club').val('');
			}
        });
        $('#ficha_grupo_poblacional_otro').hide();
		$('#ficha_grupo_poblacional_club').hide();
        search_municipios();
        $('#id_persona_beneficiario_id_procedencia_municipio').val(834);
        $('#id_persona_beneficiario_id_procedencia_municipio').trigger('change.select2');
        validaciones();
		
		// validacion de sexo otro acudiente
		$("#id_persona_acudiente_sexo").change(function(){
			$("#id_persona_acudiente_sexo_otro").hide();
			if(parseInt($(this).val()) == 3){
				$("#id_persona_acudiente_sexo_otro").val("").show(500,"");
			}
		});
	}