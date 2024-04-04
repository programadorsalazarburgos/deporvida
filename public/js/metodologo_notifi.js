function notifi_load()
{
	$.ajax(
	{
		url: base + '/notifi/load',
		dataType: 'json',
		success: function (data)
		{
			if (data.validate)
			{
				if (data.sin_leer)
				{
					$('#counter').html(data.sin_leer);
					$('#counter').addClass('counter');
				}
				var html = '';
				$.each(data.data, function (index, value)
				{
					html += '<li' + (parseInt(value.leido_monitor) == 1 ? ' class="jewelItemNew"' : '') + '>' +
						'<a href="' + base + '/novedad/registro' + value.id + '">' +
						'<div direction="left" class="clearfix">' +
						'</div>' +
						'<div class="">' +
						'<div class="_42ef clearfix" direction="right">' +
						'<div class="_ohf rfloat"><div><span></span><div class="x_div">' +
						'<div aria-label="Marcar como leído" class="_5c9q" data-hover="tooltip" data-tooltip-alignh="center" data-tooltip-content="Marcar como leído" role="button" tabindex="0"></div></div></div></div><div class="">' +
						'<div class="content"><div class="author"><strong><span>' +
						value.monitor + '</span></strong><span class="presenceIndicator"><span class="accessible_elem"></span></span></div><div class="_1iji"><div class="_1ijj"><span class="_3jy5"></span><span><span>' + value.nombre + '</span></span></div><div></div></div><div class="time"><abbr class="timestamp" title="value.fecha_creacion">' + value.fecha_creacion + '</abbr></div></div></div></div></div></div></a></li>';
				});
				html += '<li class="notifi-all"><a href="' + base + '/novedad/listmonitor">Ver todas las novedades</li>';
				$('#notifi-list').html(html);
			}
		}
	});
}
$(function ()
{
	notifi_load();
})