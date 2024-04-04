
	var options={ 
		tableOverflow:true,
		tableHeight:'300px',
		onchange:function(obj, cell, val) {
			$('#save').attr('disabled','disabled');
			$(cell).css('background-color','#FFFF00');
		},
		columns:[
							//{ type: 'text', readOnly:true },//1 Nombre
							{ type: 'numeric'},//1 documento
							{ type: 'numeric'},//2 RPC
							{ type: 'numeric'},//3 CDP
							{ type: 'numeric'},//4 Número de contrato
							{ type: 'text'},//5 Valor del contrato
							{ type: 'numeric'},//6 Número de cuotas
							{ type: 'date',options: { format:'DD/MM/YYYY' }},//7 Fecha de inicio
							{ type: 'date',options: { format:'DD/MM/YYYY' }},//8 Fecha de terminación -> options: { format:'DD/MM/YYYY' }},
							{ type: 'date',options: { format:'DD/MM/YYYY' }},//9 Fecha plazo de ejecucion -> options: { format:'DD/MM/YYYY' }},
							{ type: 'text'}//10 Objeto del contrato
		],
		colWidths: [ 
						//150,
						80,//1
						50,//2
						50,//3
						150,//4
						100,//5
						100,//6
						100,//7
						100,//8
						100,//9
						150],//10
		colHeaders: [
							'Documento',
							'RPC',
							'CDP',
							'Contrato',
							'Valor contrato',
							'Cuotas',
							'Fecha de inicio',
							'Fecha de terminación',
							'Plazo de ejecución',
							'Objeto del contrato'
		]
	};
		function cdp()
		{
			$('body').loading();
			$.ajax({
				url:base+'/cdp/data',
				success:function(data)
				{
					options.data=data;
					$('#mytable').jexcel(options);
					$('body').loading('stop');
				},
				error:function()
				{
					$('body').loading('stop');
				}
			});
		}		
		function Validar()
		{
			$('body').loading({message: 'Validando, este proceso puede demorar.'});
			$.ajax({
				url:base+'/cdp/validatedata',
				type:'POST',
				data:{data:$('#mytable').jexcel('getData')},
				dataType:'json',
				success:function(data)
				{
					$.each(data.validations,function(y,value)
					{
					  	$.each(value,function(x,validate)
					  	{
					   		var cell=$('#'+x+'-'+y);
					    	if(validate)
					    	{
								$(cell).css('background-color', 'white');  
					      	}
					      	else
					      	{
					   			$(cell).css('background-color', '#FF0000');  
					      	}
					    });  
					});
					if(data.validate)
					{
						swal("Validado", "Los datos han sido validados con exito. Ahora puede guardarlos en el sistema");
						$('#save').removeAttr('disabled');
					}
					else
					{
						$('#save').attr('disabled','disabled');
						var error="Se ha registrado " +data.rows_fails+' error' +((data.rows_fails>1)?'es':'');
						swal(error, "Existen inconsistencias en la información. Por favor actualice los campos en rojo y vuelva a validar la información. Tener en cuenta que las fechas deben llevar el formato DD/mm/YYYY",'warning');
					}
					$('body').loading('stop');
				},
				error:function(data)
				{
					$('#save').attr('disabled','disabled');
					swal("Se ha registrado un error", "No se ha podido cargar los datos desde el excel. Intente con la carga manual.",'warning');
					console.log(data);
					$('body').loading('stop');
				}
			})
		}
		function LoadData()
		{

			var data = $('#mytable').jexcel('getData');
			$.ajax({
				url:base+'/cdp/loaddata',
				type:'POST',
				data:{getdata:	JSON.stringify(data)},
				success:function(data)
				{
					//console.log(data);
				}
			});
		}
		function saveContratos()
		{
			$.ajax({
				url:base+'/cdp/savecontratos',
				type:'POST',
				data:{data:$('#mytable').jexcel('getData')},
				dataType:'json',
				success:function(data)
				{
					$('#save').attr('disabled','disabled');
					$('body').loading('stop');
					swal("Guardado", "Los datos han sido guardados con exito.");
				},
				error:function(data)
				{
					$('#save').attr('disabled','disabled');
					$('body').loading('stop');
					swal("Error", "Se ha presentado un error al guardar los datos.",'warning');
					console.log(data);
				}

			})
		}
		$(function()
		{
			$('#save').attr('disabled','disabled');
			$('#save').click(function(){$('body').loading({message: 'Guardando datos. Este proceso puede demorarse'});saveContratos()});
			cdp();
			loadxlsx('LoadData');
			$('#Validar').click(function () 
			{
				Validar();
			});
		});
//======================================================================
		function loadxlsx(id_component)
		{
			oFileIn = document.getElementById(id_component);
			if (oFileIn.addEventListener)
			{
				oFileIn.addEventListener('change',filePicked, false);
			}
		}
		function datavalue(data)
		{
			var jqXHR = $.ajax({
				url:base+'/cdp/orderdata',
				type:'POST',
				async:false,
				data:{data:JSON.stringify(data)}
			});
			return JSON.parse(jqXHR.responseText);
		}
		function filedata()
		{
			filefinish
		}
		function filePicked(oEvent) 
		{
			$('body').loading({message: 'Cargando datos de excel'});
			var oFile = oEvent.target.files[0];
			var sFilename = oFile.name;
			var reader = new FileReader();
			reader.onload = function(e) 
			{
				var data = e.target.result;
				var cfb = XLSX.read(data, {type: 'binary'});
				cfb.SheetNames.forEach(function(sheetName) 
				{
					var oJS = XLS.utils.sheet_to_json(cfb.Sheets[sheetName]);
					var html = XLS.utils.sheet_to_html(cfb.Sheets[sheetName]);
					var filefinish = datavalue(oJS);
					options.data=filefinish;
					$('#mytable').jexcel(options);
					$('body').loading('stop');
				});
			};
			reader.readAsBinaryString(oFile);
			$('body').loading('stop');
		}
//======================================================================
		