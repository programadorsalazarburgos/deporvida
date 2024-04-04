$(function () {
	Guardar();
	$('#disciplinas').validate();
});
function Guardar() {
	$('form').submit(function (e) {
		e.preventDefault();
		if ($(this).valid()) {
			$.ajax({
				url: base + '/disciplinas/nuevo_registro',
				data: $(this).serialize(),
				type: 'POST',
				dataType: 'json',
				success: function (data) {
					if (data.validate) {
						swal("Guardado!", "Registro editado.", "success");
					}
					else {
						swal("Cancelado", "Se ha presentado un error inesperado", "error");
					}
				},
				error: function (data) {
					console.log(data);
					swal("Cancelado", "Se ha presentado un error inesperado", "error");
				}
			});
		}
	});
}