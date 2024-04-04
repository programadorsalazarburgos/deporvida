<template>
<main class="main">
	<div class="clearfix"></div>
	<br>
	<div class="row">dddddsssdxxddx</div>
	<template v-if="listado==1">
		<div id="table-action" class="row">
			<div class="col-lg-12">
				<ul id="tableactiondTab" class="nav nav-tabs">
					<li class="active"><a href="#table-table-tab" data-toggle="tab">Información</a></li>
				</ul>
				<div id="tableactionTabContent" class="tab-content">
					<div id="table-table-tab" class="tab-pane fade in active">
						<div class="row">
							<div class="col-lg-12">
								<h4 class="box-heading">Paginación</h4>
								<div class="table-container">
									<div class="row mbm">
										<div class="col-lg-6"></div>
									</div>
									<div class="table-responsive">
										<!--Inicia Boton Nuevo -->
										<div class="portlet-body">
											<div class="actions">
												<a   class="btn btn-info" @click="abrirModal('rol','registrar')"><i class="fa fa-plus"></i>&nbsp;Nuevo</a>&nbsp;
											</div>
											<div class="clearfix"></div>
											<br>
											<div class="container-fluid">
												<div class="row">
													<div class="col-md-12">
														<div class="row">
															<div class="col-md-4">
																<select class="form-control col-md-3" v-model="criterio">
																	<option value="name">Nombre</option>
																	<option value="description">Descripción</option>
																</select>
															</div>
															<div class="col-md-4">
																<input type="text" v-model="buscar" @keyup.enter="listarRol(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
															</div>
															<div class="col-md-4">
																<button type="button" class="btn btn-primary" @click="listarRol(1,buscar,criterio)"><i class="fa fa-search"></i> Buscar</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
										<br>
										<br>
										<table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter">
											<thead style="background-color: #5bc0de;">
												<th scope="col" style="color: white;">NOMBRE ROL&nbsp;</th>
												<th scope="col" style="color: white;">DESCRIPCIÓN ROL&nbsp;</th>
												<th scope="col" style="width:320px;"></th>
											</thead>
											<tbody>
												<tr v-for="rol in arrayRol" :key="rol.id">
													<td v-text="rol.display_name"></td>
													<td v-text="rol.display_name"></td>
													<td style="text-align: center;">
														<div class="btn-group pull-center">
															<a class="btn btn-success" @click="permisos(rol.id, rol.name)"><i class="fa fa-check-circle"></i>&nbsp;Permisos</a>
															<a class="btn btn-warning" @click="abrirModal('rol','actualizar',rol)"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
										<nav>
											<ul class="pagination">
												<li class="page-item" v-if="pagination.current_page > 1">
													<a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
												</li>
												<li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
													<a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
												</li>
												<li class="page-item" v-if="pagination.current_page < pagination.last_page">
													<a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
												</li>
											</ul>
										</nav>
										<div class="col-md-12"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--Inicio del modal agregar/actualizar-->
			<div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none; height: 10000px;" aria-hidden="true">
				<div class="modal-dialog modal-primary modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header" style="background-color: #f4f4f4;">
							<h4 class="modal-title" v-text="tituloModal"></h4>
							<button type="button" class="close" @click="cerrarModal()" aria-label="Close">
							<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
								<div class="form-group row">
									<label class="col-md-3 form-control-label" for="text-input">Nombre Rol(*)</label>
									<div class="col-md-9">
										<input type="text" v-model="nombre" class="form-control" placeholder="Nombre Rol">                           
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 form-control-label" for="email-input">Descripción</label>
									<div class="col-md-9">
										<textarea type="text" v-model="descripcion" class="form-control" placeholder="Descripción Rol"></textarea>
									</div>
								</div>
								<div v-show="errorPersona" class="form-group row div-error">
									<div class="text-center text-error">
										<div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error"></div>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" @click="cerrarModal()">Cerrar</button>
							<button type="button" v-if="tipoAccion==1" class="btn btn-success" @click="registrarRol()">Guardar</button>
							<button type="button" v-if="tipoAccion==2" class="btn btn-success" @click="actualizarRol()">Actualizar</button>
						</div>
					</div>
				</div>
			</div>
			<!--Fin del modal-->
		</div>
	</template>
	<template v-else-if="listado==2">	
		<div id="table-action" class="row">
			<div class="col-lg-12">
				<ul id="tableactiondTab" class="nav nav-tabs">
					<li class="active"><a href="#table-table-tab" data-toggle="tab">Asignación de permisos por Rol</a></li>
				</ul>
				<div id="tableactionTabContent" class="tab-content">
					<div id="table-table-tab" class="tab-pane fade in active">
                        <div class="wrap">
						<div class="clearfix"></div><br>						
						<a  type="submit" class="btn btn-orange" @click="Atras()"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
						<h5>Elije los permisos para el rol {{name_rol}}</h5>
						 <div class='row'>
                          <div class="col-md-12">
                            <div class='form-group'>
                             <ul>
                                    <li v-for="task in arrayPermisos" :key="task.id" class="col-md-4">
                                        <input type="checkbox" :id="task.id" :value="task" v-model="selectedTasks" @change="handleTasks(task)" class="option-input checkbox">
                                        <label :for="task.name" style="position: absolute;top: 19px;left: 41px;">{{task.name}}</label>
                                    </li>
                                </ul>	
                            </div>
                          </div>
                        </div>
                        </div>
                        </div>
                        <div class="clearfix"></div>
                        <br><br>
                    <div class="form-group">
                    <div class="col-sm-6">                 
                     	<button type="button"  class="btn btn-success" @click="guardarPermisos(rol_id)">Guardar</button>
	
	                     <a  type="submit" class="btn btn-orange" @click="Atras()"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                    </div>
                    <div class="clearfix"></div><br>
                  </div>
        			</div>
    				</div>
					</div>
				</div>
			</div>
		</div>

	</template>
</main>
</template>
<script>



import Vue from 'vue'
import VueSweetalert2 from 'vue-sweetalert2';

export default {
    data() {
        return {
            base:'',

      tasks: [
        {id:1, title: 'generar-factura' },
        {id:2, title: 'crear-reserva' },
        {id:3, title: 'editar-reserva' },
        {id:4, title: 'eliminar-reserva' },
        {id:5, title: 'crear-usuario' },
        {id:6, title: 'editar-usuario' },
      ],
      selectedTasks: [],
            rol_id: 0,
            nombre : '',
            descripcion : '',
            arrayRol : [],
            arrayPermisos : [],
            arrayPermisosAsignados : [],
            nombre: '',
            modal: 0,
            modal2: 0,
            tituloModal: '',
            tipoAccion: 0,
            errorPersona: 0,
            errorMostrarMsjPersona: [],
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0,
            },
            offset: 3,
            criterio: 'nombre',
            buscar: '',
            listado:1,
            name_rol: ''
        };
    },

 watch: {
    selectedUsers: function (newVal, oldVal) {
      // Do what you want with the selected objects:
      console.log(newVal)
    }
  },
    
    computed: {
        isActived: function() {
            return this.pagination.current_page;
        },
        //Calcula los elementos de la paginación
        pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }

            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
    },
    methods: {
         listarRol (page,buscar,criterio){

         		console.log(buscar)
         		console.log(criterio)
                let me=this;
                var url= '/listar_rol?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(me.base+url).then(function (response) {
                	console.log(response);
                    var respuesta= response.data;
                    me.arrayRol = respuesta.roles.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    // var response = error.response.data;
                    // console.log(response.message, 
                    //     response.exception, 
                    //     response.file, 
                    //     response.line);
                });
            },

            handleTasks(task) {
              // Do what you want with the selected objects:
              let me = this;
               axios
                .post(me.base+'/quitar/permiso', {
                     permiso: task,
                     rol_id: me.rol_id
                   
                })
                .then(function(response) {
                  
                 

                })
                .catch(function(error) {
                    var response = error.response.data;
                    console.log(response.message, response.exception, response.file, response.line);
                });

    },

    guardarPermisos()
    {
       let me = this;

       axios
        .post(me.base+'/asignar/permisos', {
             permisos: me.selectedTasks,
             rol_id: me.rol_id
           
        })
        .then(function(response) {
         
           me.modal2 = 0;
           me.listado = 1;
           Swal.fire({
					  position: 'top-end',
					  type: 'success',
					  title: 'Registro almacenado',
					  showConfirmButton: false,
					  timer: 1500
					})

        })
        .catch(function(error) {
            var response = error.response.data;
            console.log(response.message, response.exception, response.file, response.line);
        });
    },
    
    obtenerPermisos()
    {

       let me = this;
       axios
        .get(me.base+'/obtener/permisos', {
            
           
        })
        .then(function(response) {

            var respuesta= response.data;
            me.arrayPermisos = respuesta.permisos;            
            console.log(me.arrayPermisos)

        })
        .catch(function(error) {
            var response = error.response.data;
            console.log(response.message, response.exception, response.file, response.line);
        });
    },

    simulateAjax() {
      let me = this;
      this.selectedTasks = me.arrayPermisos;
      console.log(this.selectedTasks)
    },



    clear() {

      let me = this;
               axios
                .post(me.base+'/quitar/permisos_all', {
                     permisos: me.selectedTasks,
                     rol_id: me.rol_id
                   
                })
                .then(function(response) {
                  me.selectedTasks = []
                 

                })
                .catch(function(error) {
                    var response = error.response.data;
                    console.log(response.message, response.exception, response.file, response.line);
                });


    },
      
        cambiarPagina(page, buscar, criterio) {
            let me = this;
            //Actualiza la página actual
            me.pagination.current_page = page;
            //Envia la petición para visualizar la data de esa página
            me.listarRol(page, buscar, criterio);
        },
        registrarRol() {
     
            let me = this;

            axios
                .post(me.base+'/rol/registrar', {
                    nombre: this.nombre,
                    descripcion: this.descripcion,
                   
                })
                .then(function(response) {
                    me.cerrarModal();
                    me.listarRol(1, '', 'nombre');
                    Swal.fire({
					  position: 'top-end',
					  type: 'success',
					  title: 'Registro almacenado',
					  showConfirmButton: false,
					  timer: 1500
					})
					                })
                .catch(function(error) {
                	
                    var response = error.response.data;
                });
        },
        actualizarRol() {
    

            let me = this;

            axios
                .put('/rol/actualizar', {
                    nombre: this.nombre,
                    descripcion: this.descripcion,
                    id: this.rol_id,
                })
                .then(function(response) {
                    me.cerrarModal();
                    me.listarRol(1, '', 'nombre');
                })
                .catch(function(error) {
                    var response = error.response.data;
                    console.log(response.message, response.exception, response.file, response.line);
                });
        },
        validarPersona() {
            this.errorPersona = 0;
            this.errorMostrarMsjPersona = [];

            if (!this.nombre) this.errorMostrarMsjPersona.push('El nombre de la pesona no puede estar vacío.');
            if (!this.usuario) this.errorMostrarMsjPersona.push('El nombre de usuario no puede estar vacío.');
            if (!this.password) this.errorMostrarMsjPersona.push('La password del usuario no puede estar vacía.');
            if (this.idrol == 0) this.errorMostrarMsjPersona.push('Seleccione una Role.');
            if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

            return this.errorPersona;
        },
        cerrarModal() {
            this.modal = 0;
            this.tituloModal = '';
            this.nombre = '';
            this.tipo_documento = 'DNI';
            this.num_documento = '';
            this.direccion = '';
            this.telefono = '';
            this.email = '';
            this.usuario = '';
            this.password = '';
            this.idrol = 0;
            this.errorPersona = 0;
        },

        cerrarModal2() {
            this.modal2 = 0;
            this.tituloModal = '';
            
        },
        abrirModal(modelo, accion, data = []) {
            
            switch (modelo) {
                case 'rol': {
                    switch (accion) {
                        case 'registrar': {
                            this.modal = 1;
                            this.tituloModal = 'Registrar Rol';
                            this.nombre = '';
                            this.descripcion = '';
                            this.tipoAccion = 1;
                            break;
                        }
                        case 'actualizar': {
                            console.log(data);
                            this.modal = 1;
                            this.tituloModal = 'Actualizar Rol';
                            this.tipoAccion = 2;
                            this.rol_id = data['id'];
                            this.nombre = data['name'];
                            this.descripcion = data['description'];
                            break;
                        }
                    }
                }
            }
        },

        abrirModal2(id) {

            
            this.modal2 = 1;
            this.tituloModal = 'Asignar Permisos';
            this.tipoAccion = 1;
            this.rol_id = id;
            this.obtenerPermisos();
            this.permisosAsignados(this.rol_id);




        },


        permisos(id, name)
        {

        	let me = this;
        	me.listado = 2;
        	this.rol_id = id;
        	me.obtenerPermisos();
		    this.permisosAsignados(this.rol_id);
		    this.name_rol = name;
        },

        permisosAsignados(rol_id)
        {

            let me=this;
                var url= '/obtener/permiso_asignado?rol_id=' + rol_id;
                axios.get(me.base+url).then(function (response) {
                  
                    var respuesta= response.data;
                    me.selectedTasks = respuesta.permisos;
                    console.log(me.selectedTasks)
                 
                })
                .catch(function (error) {
                    var response = error.response.data;
                    console.log(response.message, 
                        response.exception, 
                        response.file, 
                        response.line);
                });

    
        },

        Atras()
        {

        	let me = this;
        	me.listado = 1;

        },
        desactivarRol(id) {
           
            swal({
                title: 'Esta seguro de desactivar este rol?',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true,
            }).then(result => {
                if (result.value) {
                    let me = this;

                    axios
                        .put('/rol/desactivar', {
                            id: id,
                        })
                        .then(function(response) {
                            me.listarRol(1, '', 'nombre');
                            swal('Desactivado!', 'El registro ha sido desactivado con éxito.', 'success');
                        })
                        .catch(function(error) {
                            var response = error.response.data;
                            console.log(response.message, response.exception, response.file, response.line);
                        });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                }
            });
        },


		alertSuccess({title = "Success!", text = "That's all done!", timer = 1000, showConfirmationButton = false} = {}) {
		  this.alert({
		    title: title,
		    text: text,
		    timer: timer,
		    showConfirmButton: showConfirmationButton,
		    type: 'success'
		  });
		},


        activarRol(id) {
            swal({
                title: 'Esta seguro de activar este rol?',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true,
            }).then(result => {
                if (result.value) {
                    let me = this;

                    axios
                        .put('/rol/activar', {
                            id: id,
                        })
                        .then(function(response) {
                            me.listarRol(1, '', 'nombre');
                            swal('Activado!', 'El registro ha sido activado con éxito.', 'success');
                        })
                        .catch(function(error) {
                            var response = error.response.data;
                            console.log(response.message, response.exception, response.file, response.line);
                        });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                }
            });
        },
    },
    mounted() {
        this.base=base;
        this.listarRol(1, this.buscar, this.criterio);
    },
};
</script>
<style>
.modal-content {
    width: 100% !important;
    position: absolute !important;
}
.mostrar {
    display: block !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: #3c29297a !important;
    height: 100vh;
}
.div-error {
    display: flex;
    justify-content: center;
}
.text-error {
    color: red !important;
    font-weight: bold;
}

@media (max-width: 768px) {
    .mostrar {
        height: 150%;
    }
}

.gradient-mint {
    background-image: linear-gradient(45deg, #23BCBB, #45E994);
    background-repeat: repeat-x;
}



@-webkit-keyframes click-wave {
  0% {
    height: 20px;
    width: 20px;
    opacity: 0.35;
    position: relative;
  }
  100% {
    height: 100px;
    width: 100px;
    margin-left: -80px;
    margin-top: -80px;
    opacity: 0;
  }
}
@-moz-keyframes click-wave {
  0% {
    height: 20px;
    width: 20px;
    opacity: 0.35;
    position: relative;
  }
  100% {
    height: 100px;
    width: 100px;
    margin-left: -80px;
    margin-top: -80px;
    opacity: 0;
  }
}
@keyframes click-wave {
  0% {
    height: 20px;
    width: 20px;
    opacity: 0.35;
    position: relative;
  }
  100% {
    height: 100px;
    width: 100px;
    margin-left: -80px;
    margin-top: -80px;
    opacity: 0;
  }
}
.option-input {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  -o-appearance: none;
  appearance: none;
  position: relative;
  top: 13.3333333333px;
  right: 0;
  bottom: 0;
  left: 0;
  height: 20px;
  width: 20px;
  -webkit-transition: all 0.15s ease-out 0s;
  -moz-transition: all 0.15s ease-out 0s;
  transition: all 0.15s ease-out 0s;
  background: #cbd1d8;
  border: none;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  margin-right: 0.5rem;
  outline: none;
  position: relative;
  z-index: 1000;
}
.option-input:hover {
  background: #9faab7;
}
.option-input:checked {
  background: #40e0d0;
}
.option-input:checked::before {
  height: 20px;
  width: 20px;
  position: absolute;
  content: '\2714';
  display: inline-block;
  font-size: 26.6666666667px;
  text-align: center;
  line-height: 20px;
}
.option-input:checked::after {
  -webkit-animation: click-wave 0.65s;
  -moz-animation: click-wave 0.65s;
  animation: click-wave 0.65s;
  background: #40e0d0;
  content: '';
  display: block;
  position: relative;
  z-index: 100;
}
.option-input.radio {
  border-radius: 50%;
}
.option-input.radio::after {
  border-radius: 50%;
}




</style>
