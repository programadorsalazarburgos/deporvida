function LoadData()
{
		table = $('#mytable').DataTable ({
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/cpd/allcuentascobro',
                    columns : 
                    [
                        {
                            data: 'id', "title": "Ver", 
                            render:function (id,type,row) 
                            {
                                var html=
                                '<a href="'+base+'/cdp/inf1/'+id+'" class="btn btn-default">Documento equivalente</a><br>'+
                                '<a href="'+base+'/cdp/inf2/'+id+'" class="btn btn-default">inf 2</a><br>'+
                                '<a href="'+base+'/cdp/inf3/'+id+'" class="btn btn-default">Informe mensual</a><br>';
                                return html;
                            }
                        },
                        {
                            data: 'numero_documento', "title": "Documento", 
                            render:function (value,type,row) 
                            {
                                return value;
                            }
                        },
                        {
                            data: 'user', "title": "Contratista", 
                            render:function (value,type,row) 
                            {
                                return value;
                            }
                        },
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
                            data: 'fecha_transaccion', "title": "Fecha de transaccion", 
                            render:function (value,type,row) 
                            {
                                return value;
                            }
                        },
                        {
                            data: 'estado', "title": "Estado", 
                            render:function (value,type,row) 
                            {
                                return value;
                            }
                        }
                    ]
                });

}
$(function()
{
	LoadData();
})