function LoadData()
{
		table = $('#mytable').DataTable ({
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/cpd/miscuentas',
                    columns : 
                    [
	                    {
                            data: 'cuota_numero', "title": "Cuota", 
                            render:function (value,type,row) 
                            {
                                return value;
                            }
                        },
                        {
                            data: 'valor_saldo', "title": "Valor saldo", 
                            render:function (value,type,row) 
                            {
                                return '$'+value;
                            }
                        },
                        {
                            data: 'valor_cuota', "title": "Valor cuota", 
                            render:function (value,type,row) 
                            {
                                return '$'+value;
                            }
                        },
                        {
                            data: 'fecha_transaccion', "title": "Fecha de<br>transaccion", 
                            render:function (value,type,row) 
                            {
                                return value;
                            }
                        },
                        {
                            data: 'estado', "title": "Estado", 
                            render:function (value,type,row) 
                            {
                                var label = '';
                                switch(row.id_estado)
                                {
                                    case 1:label ='<label class="label label-success">'+value+'</label>';break;
                                    case 2:label ='<label class="label label-danger">'+value+'</label>';break;
                                    case 3:label ='<label class="label label-warning">'+value+'</label>';break;
                                }
                                return label;
                            }
                        },
                        {
                            data: 'id', "title": "Ver", 
                            render:function (value,type,row) 
                            {
                                var html =  
                                            '<div class="btn-group">\n\
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n\
                                              Documentos <span class="caret"></span>\n\
                                            </button>\n\
                                            <ul class="dropdown-menu">\n\
                                            <li><a href="'+base+'/cdp/inf1/'+row.id+'" target="_blank"><i class="glyphicon glyphicon-file"></i> Documento equivalente</a></li>\n\
                                            <li><a href="'+base+'/cdp/inf2/'+row.id+'" target="_blank"><i class="glyphicon glyphicon-file"></i> Informe parcial</a></li>\n\
                                            <li><a href="'+base+'/cdp/inf3/'+row.id+'" target="_blank"><i class="glyphicon glyphicon-file"></i> Informe mensual</a></li>';
                                    if(row.id_estado==3 || row.id_estado==2)
                                    {
                                        html=html+'<li role="separator" class="divider"></li>\n\
                                                    <li><a href="'+base+'/cdp/editar/'+row.id+'"><i class="glyphicon glyphicon-pencil"></i> Editar documento</a></li>';
                                    }
                                    html=html+'</ul></div>';

                                return html;
                            }
                        }
                        /*
                        ,{
                            data: 'id', "title": "Editar", 
                            render:function (value,type,row) 
                            {
                                var html='';
                                if(row.estado=="Pendiente")
                                {

                                    html =  '<a href="'+base+'/editcdp/inf1/'+row.id+'" target="_blank" class="btn btn-default"><i class="fa fa-search-plus"></i> Documento equivalente</a><br/>'+
                                            '<a href="'+base+'/editcdp/inf2/'+row.id+'" target="_blank" class="btn btn-default"><i class="fa fa-search-plus"></i> Informe parcial</a><br/>'+
                                            '<a href="'+base+'/editcdp/inf3/'+row.id+'" target="_blank" class="btn btn-default"><i class="fa fa-search-plus"></i> Informe mensual</a><br/>'
                                    ;
                                }
                                else
                                {
                                    html='<h2>No se puede editar</h2>';    
                                }
                                return html;
                            }
                        }
                        */
                    ]
                });

}
$(function()
{
	LoadData();
})