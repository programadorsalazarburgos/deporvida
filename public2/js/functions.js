function convertToCSV(objArray) 
{
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';
    for (var i = 0; i < array.length; i++) 
    {
        var line = '';
        for (var index in array[i]) 
        {
            if (line != '') 
            {line += ';';}
            try
            {
                line += array[i][index];
                //line += utf8_decode(array[i][index]);
            }
            catch(Exception)
            {
                line += array[i][index];
            }
        }
        line=line.replace(/\á/g, 'a').replace(/\é/g, 'e').replace(/\í/g, 'i').replace(/\ó/g, 'o').replace(/\ú/g, 'u');
        line=line.replace(/\Á/g, 'A').replace(/\É/g, 'E').replace(/\Í/g, 'I').replace(/\Ó/g, 'O').replace(/\Ú/g, 'U');
        str += line + '\r\n';
    }
    return str;
}

function exportCSVFile(headers, items, fileTitle) 
{
    if (headers) 
    {
        items.unshift(headers);
    }
    var jsonObject = JSON.stringify(items);
    var csv = this.convertToCSV(jsonObject);
    var exportedFilenmae = fileTitle + '.csv' || 'export.csv';
    var blob = new Blob([csv], { type: 'text/plain;charset=ANSI'});
    if (navigator.msSaveBlob) 
    {
        navigator.msSaveBlob(blob, exportedFilenmae);
    }
    else
    {
        var link = document.createElement("a");
        if (link.download !== undefined) 
        {
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", exportedFilenmae);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}
function required_form()
{

    if ($('.alertrequired').length>0)
    {
        var data=$('.alertrequired');
        $('html,body').animate({
            scrollTop: data.offset().top
        }, 200);
        return false;
    }
    else
    {
        return true;
    }
}
function validar_form()
{
    $('.required-label').hide();
    var required_data='';
    $('.required-label').each(function(index,value)
    {
        var tempid=$.trim($(this).attr('data-required'));
        required_data=(required_data==='') ? '#'+tempid: required_data+',#' + tempid;
        if($('#'+tempid).val()==='')
        {
            $(this).show();
            $(this).addClass('alertrequired');

        }
    });
    $(required_data).change(function()
    {
        var name='[data-required="'+$(this).attr('id')+'"]';
        if($(this).val()==='')
        {
            $(name).show();
            $(name).addClass('alertrequired');
        }
        else
        {
            $(name).removeClass('alertrequired');
            $(name).hide();   
        }
    });
}
function calcularEdad(fecha)
{
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }
    return edad;
}
try
{
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
}
catch(E)
{
    //console.log(E);
}
function inputmaskini()
{
    try{
        $('.only_number').inputmask({alias: 'decimal',allowMinus: false, rightAlign: true, groupSeparator: ',', digits: 0, autoGroup: true});
    }
    catch(E)
    {
        //console.log(E);
    }
}
$.fn.select = function(attr) 
{
    var html='<option value="">Selecione</option>';
    $.each(attr.data,function(index,value)
    {
        html+='<option value="'+value[attr.value]+'">'+value[attr.name]+'</option>';
    })
    $(this).html(html);
};
function fecha_datepiker()
{
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $('.fecha').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: "-150:+0",
    }).attr('readonly', 'readonly').attr('style','background-color:#FFF;cursor:text');
    $('.fecha_next').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: "0:+100",
    }).attr('readonly', 'readonly').attr('style','background-color:#FFF;cursor:text');

}

function datatableSpanish()
{
    return {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "NingÃºn dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Ãšltimo",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    };
}
function fechahoy()
{
    var f = new Date();
    var dia=(f.getDate()<10)?'0'+f.getDate():f.getDate();
    var mes=((f.getMonth() +1)<10)?'0'+(f.getMonth() +1):(f.getMonth() +1);
    var anno=f.getFullYear();
    var ultimoDia = new Date(f.getFullYear(), f.getMonth() + 1, 0);
    var dia_fin=ultimoDia.getDate();
    data={dia:dia,dia_fin:dia_fin,mes:mes,anno:anno};
    return data;
}
$.fn.fecha_hoy=function(attr)
{
    var data=fechahoy();
    $(this).val(data.anno+'-'+data.mes+'-'+data.dia);
}
$.fn.finmes=function(attr)
{
    var data=fechahoy();
    $(this).val(data.anno+'-'+data.mes+data.dia_fin);
}
$.fn.iniciomes=function(attr)
{
    var data=fechahoy();
    $(this).val(data.anno+'-'+data.mes+'-01');
}

$(function()
{
    $(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });
    $('form').on('focus', 'input[type=number]', function (e) {
      $(this).on('mousewheel.disableScroll', function (e) {
        e.preventDefault()
      })
    })
    $('form').on('blur', 'input[type=number]', function (e) {
      $(this).off('mousewheel.disableScroll')
    })
    try{
        fecha_datepiker();
    }
    catch(Exception)
    {
        console.log(Exception);
    }
    try{
        inputmaskini();
    }
    catch(Exception)
    {
        console.log(Exception)
    }
});