<user-modal-insert>
    <div id="user-modal-tag" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="color:#fbfdff">Registrar Multiples Afiliaciones</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>Codigo Empresa</th>
                                <th>Nombre Empresa</th>
                                <th style="width:60px;"></th>
                            </tr>
                            <!-- Formulario para agregar nuevos alumnos -->
                            <tr>
                                <td>
                                    <input id="codigo_empresa" type="text" placeholder="Codigo Empresa" class="form-control" />
                                </td>
                                <td>
                                    <input id="nombre_empresa" type="text" placeholder="Nombre Empresa" class="form-control" data-validacion-tipo="requerido|min:10" />
                                </td>
                                <td>
                                    <button class="btn btn-block btn-blue" type="button" onclick={agregar}><i class="fa fa-plus-circle"></i>&nbsp;Agregar</button>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr each={data}>
                                <td>
                                    {Codigo}
                                </td>
                                <td>
                                    {Nombre}
                                </td>

                                <td>
                                    <button class="btn btn-block btn-danger" type="button" onclick={retirar}><i class="fa fa-minus"></i>&nbsp;Retirar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button if={data.length > 0} type="button" class="btn btn-success" onclick={almacenar}><i class="fa fa-floppy-o"></i>&nbsp;Guardar</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-sign-out"></i>&nbsp;Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var self = this;
        self.ready = false;
        self.carreras = [];
        self.carreras2 = [];
        self.data = [];
//
        //
        retirar(e){
            var item = e.item;
            var index = self.data.indexOf(item);
            self.data.splice(index, 1);
        }
//

agregar() {
            var codigo_empresa = document.getElementById('codigo_empresa'),
                nombre_empresa = document.getElementById('nombre_empresa');

            var afiliacion = {
                Codigo: codigo_empresa.value,
                Nombre: nombre_empresa.value,
            };

            codigo_empresa.value = '';
            nombre_empresa.value = '';

            self.data.push(afiliacion);

        }

        almacenar(){
        $.ajax({
        url: base + '/api/v13/afiliaciones/crear',
        type: 'POST',
        dataType: 'JSON',
        data: {variable: self.data},
       success: function (data)
    {
    swal("Felicidades!", "Tus Datos han sido Almacenados!", "success",
        "timer: 5000",   "showConfirmButton: false");
    window.location.reload(true);
    },
       });
  }


cerrar(){

    alert(1);
}


        this.on('mount', function() {
            $("#user-modal-tag").modal();
        })
    </script>

</user-modal-insert>