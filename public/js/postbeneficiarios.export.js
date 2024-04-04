function export_all()
{
	$.ajax({
		url:base+'/api/v0/admin/postbeneficiarios',
		dataType:'json',
		success:function(data)
		{
			var headers = {
			    beneficiario_nombre: 'Nombre de beneficiario'.replace(/,/g, ''), // remove commas to avoid errors
			    beneficiario_documento: "Documento del beneficiario",
			    beneficiario_telefono: "Telefono del beneficiario",
			    acudiente_nombre: "Acudiente del beneficiario",
			    acudiente_documento: 'Documento del acudiente',
			    acudiente_telefono:'Telefono del acudiente',
			    

			};
			exportCSVFile(headers, data, 'Beneficiarios'); // call the exportCSVFile() function to process the JSON and trigger the download
		}
	})
}