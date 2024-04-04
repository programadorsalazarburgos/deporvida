var newvalueid = 0;

function newid() {
    newvalueid = newvalueid + 1;
    var fecha = new Date();
    return newvalueid;
}



function deleteform(ids, tipo, form) {
    var id = $('#id_' + ids).val();
    swal({
            title: "Estas seguro?",
            text: "Está a punto de borrar este archivo!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                $('#' + form).html('');
                $.ajax({
                    url: base + '/hoja_vida/borrar',
                    type: 'POST',
                    data: {
                        id: id,
                        tipo: tipo
                    },
                    success: function() {
                        swal("Eliminado!", "Registro eliminado.", "success");

                    }
                });
            } else {
                swal("Cancelado", "No elimino su registro :)", "error");
            }
        });
}

function createfile(name) {
    $(name).fileinput({
        'showUpload': true,
        'previewFileType': 'any',
        initialPreviewAsData: true,
        maxFileSize: 5000,
        language: 'es',
        initialCaption: "Adjunte aqui sus documentos"
    });
}

function verestudiante(id) {
    $('.estudiante_' + id).show();
    $('.graduado_' + id).hide();
    $('.graduado_' + id + ' input').val('');
}

function vergraduado(id) {
    $('.graduado_' + id).show();
    $('.estudiante_' + id).hide();
    $('.estudiante_' + id + ' input').val('');
}

function estado_estudio() {
    $('.estado_estudio').change(function() {
        var id = $(this).attr('data-id');
        switch ($('#estado_' + id).val()) {
            case 'Estudiante':
                verestudiante(id);
                break;
            case 'Graduado':
                vergraduado(id);
                break;
        }
    });
}

function new_file(file, replace, newfile) {
    var res = newid();
    var display = 'display_' + res;
    var html = $(file).html();
    html = html.replace(replace, "" + res + "");
    $(newfile).after('<div id="' + display + '" style="display:none;">' + html + '</div>');
    $('#' + display).show('slow');
    return res;
}

function fechaui(id) {
    $('.fecha_' + id).datepicker(
        /*{
              format:'yyyy-mm-dd',
              language:'es',
              changeMonth: true,
              changeYear: true,
          });*/
        {
            dateFormat: 'yy-mm-dd',
            showOn: 'focus',
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
            closeText: 'Borrar',
            yearRange: "-150:+0",
        }
    ).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
}

function instituciones(id, name) {
    name = name + id;
    $(name).autocomplete({
        source: base + '/universidades/get'
    });
}

function nuevo_estudio(load_file) {

    var res = new_file('#data_estudios', /{new_studio}/g, '#new_estudio')
    vergraduado(res);
    estado_estudio();
    //createfile("#file-" + res);
    //if(typeof load_file === "undefined"){}
    fechaui(res);
    var name = '#name_institucion_educativa_';
    var carrera = '#carrera_';
    instituciones(res, name);
    return res;
}

function nuevo_estudio_no_formal(load_file) {
    var res = new_file('#data_estudios_no_formales', /{new_estudio_no_formal}/g, '#new_estudio_no_formal');
    if (typeof load_file === "undefined") {
        //createfile("#file-" + res);
    }
    fechaui(res);
    var name = '#cursos_institucion_educativo_';
    var titulo = '#titulo_';
    instituciones(res, name);
    return res;
}

function direcciones(id) {
    var name = 'experiencia_direccion_' + id;
    $('#' + name).add_generator({
        direccion: name
    });
}

function nueva_experiencia_profesional(load_file) {

    var res = new_file('#data_experiencia_profesional', /{new_experiencia_profesional}/g, '#new_experiencia_profesional');
    fechaui(res);
    direcciones(res);
    if (typeof load_file === "undefined") {
        //createfile("#file-" + res);
    }
    //inputmaskini();
    return res;
}

function guardar() {
    $('#empleado_form').submit(function(e) {
        e.preventDefault();
        $('#save').attr('disabled', 'disabled');
        if ($('#empleado_form').valid()) {
            $.ajax({
                url: base + '/personal/savehv',
                data: new FormData($(this)[0]),
                type: 'POST',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.validate) {
                        swal("Almacenado!", "Registro Guardado.", "success");
                        window.location = "/personal/hojavida";
                        //$('#save').removeAttr('disabled');
                    } else {
                        $.ajax({
                            url: base + '/error/notificar',
                            type: 'POST',
                            data: {
                                responsetexto: data,
                                data_form: $('form').serializeArray(),
                                url_system: window.location.href
                            },
                            success: function() {
                                swal("Error", "Se presento un error inesperado", "warning");
                            }
                        });
                    }
                },
                error: function(jqXHR) {
                    $.ajax({
                        url: base + '/error/notificar',
                        type: 'POST',
                        data: {
                            responsetexto: jqXHR.responseText,
                            data_form: $('form').serializeArray(),
                            url_system: window.location.href
                        },
                        success: function() {
                            swal("Error", "Se presento un error inesperado", "warning");
                        }
                    });
                }

            })
        } else {
            $('#save').removeAttr('disabled');
        }
    });
}

function type_file(file) {
    var return_data = '';
    file = file.split('.');
    var ext = (file[(file.length - 1)].toLowerCase());
    switch (ext) {
        case 'doc':
            return_data = 'office';
            break;
        case 'docx':
            return_data = 'office';
            break;
        case 'xls':
            return_data = 'office';
            break;
        case 'xlsx':
            return_data = 'office';
            break;
        case 'ppt':
            return_data = 'office';
            break;
        case 'pptx':
            return_data = 'office';
            break;
        case 'pdf':
            return_data = 'pdf';
            break;
        case 'zip':
            return_data = 'zip';
            break;
        case 'rar':
            return_data = 'zip';
            break;
        case 'tar':
            return_data = 'zip';
            break;
        case 'gzip':
            return_data = 'zip';
            break;
        case 'gz':
            return_data = 'zip';
            break;
        case '7z':
            return_data = 'zip';
            break;
        case 'htm':
            return_data = 'html';
            break;
        case 'html':
            return_data = 'html';
            break;
        case 'txt':
            return_data = 'text';
            break;
        case 'ini':
            return_data = 'text';
            break;
        case 'csv':
            return_data = 'text';
            break;
        case 'java':
            return_data = 'text';
            break;
        case 'php':
            return_data = 'text';
            break;
        case 'js':
            return_data = 'text';
            break;
        case 'css':
            return_data = 'text';
            break;
        case 'bmpr':
            return_data = 'text';
            break;
        case 'mov':
            return_data = 'video';
            break;
        case 'avi':
            return_data = 'video';
            break;
        case 'wmv':
            return_data = 'video';
            break;
        case 'mpg':
            return_data = 'video';
            break;
        case 'mkv':
            return_data = 'video';
            break;
        case 'mp4':
            return_data = 'video';
            break;
        case '3gp':
            return_data = 'video';
            break;
        case 'mp3':
            return_data = 'mp3';
            break;
        case 'wav':
            return_data = 'mp3';
            break;
        case 'wav':
            return_data = 'mp3';
            break;
        case 'wav':
            return_data = 'mp3';
            break;
        default:
            return_data = 'image';
            break;
    }
    return return_data;
}

function size_file(url) {
    var jqXHR = $.ajax({
        async: false,
        data: {
            file: url
        },
        url: base + '/size',
        type: 'POST',
        dataType: 'json'
    });
    var data = (JSON.parse(jqXHR.responseText));
    return data.validate ? data.size : 0;
}

function archivos_listado(id, archivos, tipo, id_file) {
    var data = JSON.parse(archivos);
    if (data != null) {
        if (data.length > 0) {
            var url = [];
            var names = [];
            var confi_files = [];
            var name = '#file-' + id;
            $(name).removeAttr('required');
            for (var i = 0; i < data.length; i++) {
                var temp = data[i];
                if ($.trim(temp['nombre']) != '') {
                    url.push(base + '/' + temp['url']);
                    confi_files.push({
                        type: type_file(temp['nombre']),
                        size: size_file(temp['url']),
                        caption: temp['nombre'],
                        downloadUrl: base + '/' + temp['url'],
                        key: temp['url']
                    });
                }
            }
            $(name).fileinput({
                overwriteInitial: false,
                initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
                maxFileSize: 5000,
                initialPreview: url,
                initialPreviewConfig: confi_files,
                initialPreviewFileType: 'any', // image is the default and can be overridden in config below
                language: 'es',
                initialCaption: "Adjunte aqui sus documentos",
                deleteUrl: base + "/personal/file_delete?tipo=" + tipo + "&id=" + id_file
            });
        } else {
            createfile('#file-' + id);
        }
    } else {
        createfile('#file-' + id);
    }
}

function loadcursos(data) {
    if (data.length > 0) {
        $.each(data, function(index, value) {
            var id = nuevo_estudio_no_formal(true);
            archivos_listado(id, value.archivos, 'curso', value.id);
            $('#id_' + id).val(value.id);
            $('#titulo_' + id).val(value.titulo);
            $('#cursos_institucion_educativo_' + id).val(value.institucion_educativo);
            $('#curso_tipo_' + id).val(value.curso_tipo);
            $('#horas_' + id).val(value.horas_cursadas);
        });
    } else {
        //nuevo_estudio_no_formal();
    }
}

function loadestudios(data) {
    if (data.length > 0) {
        $.each(data, function(index, value) {
            var id = nuevo_estudio(true);

            archivos_listado(id, value.archivos, 'estudios', value.id);
            $('#id_' + id).val(value.id);
            console.log(value.estado_estudio)
            $('#estado_' + id).val(value.estado_estudio)
            $('#estado_estudio_' + id).val(value.estado_estudio);
            $('#estado_estudio_' + id).change(function() {
                var id = $(this).attr('data-id');
                
                    console.log($('#estado_' + id).val())
                switch ($('#estado_' + id).val()) {
                    case 'Estudiante':
                        verestudiante(id);
                        break;
                    case 'Graduado':
                        vergraduado(id);
                        break;
                }
            });

            $('#name_institucion_educativa_' + id).val(value.institucion_educativo);
            $('#number_tarjeta_profesional_' + id).val(value.tarjeta_profesional);
            console.log($('#number_tarjeta_profesional_' + id).val());
            $('#nivel_escolaridad_' + id).val(value.id_gen_escolaridad_nivel);
            $('#horario_clases_' + id).val(value.horario_clases);
            $('#fecha_graduado_' + id).attr('value', value.fecha_grado);
            //$('#semestres_'+id).val(value.);
            $('#carrera_' + id).val(value.id_carrera);
            $('#id_pais_' + id).val(value.id_pais);
        });
    } else {
        //nuevo_estudio();
    }
}

function loadexperiencia(data) {
    if (data.length > 0) {
        $.each(data, function(index, value) {
            var id = nueva_experiencia_profesional(true);
            archivos_listado(id, value.archivos, 'experiencia', value.id);
            $('#id_' + id).val(value.id);
            $('#empresa_experiencia_tipo_' + id).val(value.tipo_experiencia);
            $('#empresa_fecha_ingreso_' + id).val(value.fecha_ingreso);
            $('#empresa_fecha_retiro_' + id).val(value.fecha_retiro);
            $('#empresa_jefe_nombre_' + id).val(value.jefe_inmediato);
            $('#experiencia_direccion_' + id).val(value.direccion);
            $('#empresa_correo_' + id).val(value.correo_empresa);
            $('#empresa_telefono_' + id).val(value.telefono);
            $('#empresa_nombre_' + id).val(value.empresa);
            $('#empresa_cargo_' + id).val(value.cargo);
        });
    } else {
        //nueva_experiencia_profesional();
    }
}

function loadidiomas(data) {
    var selectedValues = new Array();
    for (var i = 0; i < data.length; i++) {
        selectedValues[i] = data[i];
    }
    $('.js-example-responsive').select2('val', selectedValues);
}

function iniciando() {
    $.ajax({
        url: base + '/personal/mihojavida',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.validate) {
                loadestudios(data.data.estudios);
                loadcursos(data.data.cursos);
                loadidiomas(data.data.idiomas);
                loadexperiencia(data.data.experiencia);
                if (data.data.documentos != null) {
                    archivos_listado('other', data.data.documentos, 'documentos', data.data.id);
                }

            } else {
                createfile('#file-other');
            }
        },
        error: function(data) {

        }
    })
}

function new_row() {
    $('#nuevo_estudio').click(function() {
        createfile("#file-" + nuevo_estudio());
        $('#empleado_form').validate();
    });
    $('#nuevo_estudio_no_formal').click(function() {
        createfile("#file-" + nuevo_estudio_no_formal());
        $('#empleado_form').validate();
    });
    $('#nueva_experiencia_profesional').click(function() {
        createfile("#file-" + nueva_experiencia_profesional());
        $('#empleado_form').validate();
    });

}
$(function() {
    $('input[required]').on('invalid', function(e) {
        if ($.trim($('#file-other').val()) === '') {
            swal("NO GUARDADO", "Si no sube el documento de identidad no podrá guardar y perderá la información.", "error");
        } else {
            swal("NO GUARDADO", "Por favor valide que todos campos requeridos esten completos.", "error");
        }
    });
    iniciando();
    guardar();
    $(".js-example-responsive").select2({
        width: 'resolve'
    });
    new_row();
    $('#empleado_form').validate();
});