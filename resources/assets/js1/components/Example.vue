<template>
<main class="main">
    <div class="clearfix"></div>
    <br>
    <div class="row"></div>
    <h1>fff</h1>
   
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
