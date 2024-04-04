<template>
<main class="main">
  <div class="clearfix"></div>
  <br>
  <div class="row"></div>
  <template v-if="listado==1">
  <div class="container-fluid">
    <div class="col-md-12">
      <div id="tableactionTabContent" class="tab-content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <label for="id_grupo">Rango Fecha Inicial</label>
                  <datepicker v-model="fecha_inicial" :language="es" class="form-control border-primary"></datepicker>
                </div>
                <div class="col-md-6">
                  <label for="id_grupo">Rango Fecha Final</label>
                  <div class="con-monitores">
                    <datepicker v-model="fecha_final" :language="es" class="form-control border-primary"></datepicker>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <label for="id_grupo">Seleccione Comuna</label>
                  <select class="form-control" v-model="comuna" @change="seleccionComuna(comuna)">
                    <option value="0" disabled>Seleccione</option>
                    <option v-for="comuna in arrayComunas" :key="comuna.id" :value="comuna.id" v-text="comuna.nombre_comuna"></option>
                  </select>
                </div>
              <!--   <div class="col-md-6">
                  <label for="id_grupo">Seleccione Monitor</label>
                  <div class="con-monitores">
                  <select class="form form-control" id="id_grupo"></select>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div><br>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
            <!--   <div class="col-md-6">
                <button id="buscar" class="btn btn-primary">Buscar</button>
              </div> -->
              <div class="col-md-6">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</template>
<template v-if="reportes==2">
<div class="container-fluid">
 
<div class="col-md-12">
  <div id="tableactionTabContent" class="tab-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!--    <pre>{{reportesesiones}}</pre> -->
          <div class="row">
            <div class="card">
              <div class="card-header">
                 <h5>Rango Inicial: {{rango_inicial}}
   Rango Final: {{rango_final}}</h5>
              <!--   <h5 class="card-title">Pago Total <span class="badge badge-success mr-1">0</span> Saldo Pendiente: <span class="badge badge-danger mr-1">226</span>
                </h5> -->
              </div>
              <div class="card-body">
                <div class="card-block">
                  <table class="table table-responsive-md-md text-center">
                    <thead>
                      <tr>
                        <th><span class="badge badge-danger mr-1">Monitor</span></th>
                        <th><span class="badge badge-success mr-1">Grupo</span></th>
                        <th><span class="badge badge-info mr-1">Clases del Mes</span></th>
                        <th><span class="badge badge-danger mr-1">Clases Programadas</span></th>
                        <th><span class="badge badge-warning mr-1">Clases Asistencias</span></th>
                    
                       
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="session in reportesesiones" :key="session.id">
                        <td>{{ session.monitor.toUpperCase() }}</td>
                        <td v-text="session.id"></td>
                        <td v-text="session.total"></td>
                        <td v-text="session.clases_programadas"></td>
                        <td v-text="session.clases_asistencias"></td>
                        <td>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
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
import Datepicker from 'vuejs-datepicker';
import { es } from 'vuejs-datepicker/dist/locale';
// const VueValidationEs = require('vee-validate/dist/locale/es');
// from 'daypilot-pro-vue'
// 
// 

// import { extendMoment } from 'moment-range';

// const moment = extendMoment(Moment);

export default {
data() {
return {


rango_inicial: '',
rango_final: '',
fecha_inicial: new Date(),
es: es,
reportes:'',
mes:'',
comuna:'',
// fecha_inicial:'',
fecha_final:new Date(),
base:'',
totalPorGrupo2 : [],
arrayComunas : [],
Cadena : [],
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
reportesesiones: ''
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
components: {
Datepicker
},
methods: {
daysInMonth(humanMonth, year) {
return new Date(year || new Date().getFullYear(), humanMonth, 0).getDate();
},
calculoDiasMes()
{
},
convertiFecha(fecha)
{
let me = this;
var options = { weekday: 'long' };
fecha = new Date(fecha);
me.Cadena.push(fecha.toLocaleDateString("es-ES", options));
// console.log(me.Cadena)
var array2=new Array('lunes','martes');
// console.log(array2)
var iguales=0;
for(var i=0;i<me.Cadena.length;i++)
{
for(var j=0;j<me.Cadena.length;j++)
{
if(me.Cadena[i]==array2[j])
iguales++;
}
}
// console.log(iguales);
},

 convert(str) {
    var date = new Date(str),
        mnth = ("0" + (date.getMonth()+1)).slice(-2),
        day  = ("0" + date.getDate()).slice(-2);
    return [ date.getFullYear(), mnth, day ].join("-");
},




normalize() {
  var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç", 
      to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
      mapping = {};
 
  for(var i = 0, j = from.length; i < j; i++ )
      mapping[ from.charAt( i ) ] = to.charAt( i );
 
  return function( str ) {
      var ret = [];
      for( var i = 0, j = str.length; i < j; i++ ) {
          var c = str.charAt( i );
          if( mapping.hasOwnProperty( str.charAt( i ) ) )
              ret.push( mapping[ c ] );
          else
              ret.push( c );
      }      
      return ret.join( '' );
  }
 
},




seleccionComuna(comuna)
{



let me=this;
me.reportesesiones = '';

me.rango_inicial = me.convert(me.fecha_inicial);
me.rango_final = me.convert(me.fecha_final);




var url = '/obtener/reportemes?comuna=' + comuna + '&fecha_inicial=' + me.fecha_inicial + '&fecha_final=' + me.fecha_final;





axios.get(me.base+url).then(function (response) {

  // console.log(response)

me.reportesesiones = '';

me.reportes = 2;

let sinDiacriticos = (function(){
    let de = 'ÁÃÀÄÂÉËÈÊÍÏÌÎÓÖÒÔÚÜÙÛÑÇáãàäâéëèêíïìîóöòôúüùûñç',
         a = 'AAAAAEEEEIIIIOOOOUUUUNCaaaaaeeeeiiiioooouuuunc',
        re = new RegExp('['+de+']' , 'ug');

    return texto =>
        texto.replace(
            re, 
            match => a.charAt(de.indexOf(match))
        );
})();

 var fecha = '';
 var fechaInicio = new Date(me.rango_inicial);
 var fechaFin    = new Date(me.rango_final);
me.Cadena = [];
while(fechaFin.getTime() >= fechaInicio.getTime()){
fechaInicio.setDate(fechaInicio.getDate() + 1);


fecha = fechaInicio.getFullYear() + '-' + (fechaInicio.getMonth() + 1) + '-' + fechaInicio.getDate();
var options = { weekday: 'long' };
fecha = new Date(fecha);
console.log(fecha)

me.Cadena.push({ dia: sinDiacriticos(fecha.toLocaleDateString('es-CO', options)) });


}

// console.log(me.Cadena)

let grupos = 0;
grupos = response.data.data;
let repetidos = 0;
repetidos = grupos.map((grupo) => {

let rep = 0;
rep = grupo.horarios.reduce((prev, horario) => {
prev[horario.dia.toLowerCase()] = me.Cadena.filter((dia) => dia.dia == horario.dia.toLowerCase()).length;
return prev;
}, {});
let horarios = grupo.horarios.map((horario) => horario.dia.toLowerCase());
let total = 0;
total = Object.keys(rep).reduce((prev, k) => prev + rep[k], 0);
return {
id: grupo.id,
horarios: horarios,
repetidos: rep,
clases_programadas: grupo.clases_programadas,
clases_asistencias: grupo.clases_asistencias,
monitor: grupo.primer_nombre + ' ' + grupo.primer_apellido,
total: total
}
});
me.reportesesiones = '';
me.reportesesiones = repetidos;

console.log(me.reportesesiones)

me.fecha_inicial = '';
me.fecha_final = '';
me.comuna = '';



})
.catch(function (error) {
var response = error;
console.log(response.message,
response.exception,
response.file,
response.line);
});
},
obtenerComunas()
{
let me = this;
axios
.get(me.base+'/obtener/comunas', {
})
.then(function(response) {
var respuesta= response.data;
me.arrayComunas = respuesta.datos;
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
cerrarModal2() {
this.modal2 = 0;
this.tituloModal = '';
},
Atras()
{
let me = this;
me.listado = 1;
},
},
mounted() {
this.base=base;
this.obtenerComunas();
this.calculoDiasMes();
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
main {
width: 100%;
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
.multiselect__select:before {
top: 136% !important;
}
form.form-bordered .form-group > div {
padding: 0 !important;
border-left: 0 !important;
height: 39px;
}
.multiselect__tags {
position: relative;
top: 17px;
width: 337px;
}
.vdp-datepicker * {
/* box-sizing: border-box; */
/* border: 0; */
border-color: transparent !important;
}
.vdp-datepicker__calendar {
position: absolute;
z-index: 100;
background: #11a5c8 !important;
color: white;
width: 300px;
border: 1px solid #ccc;
}
.vdp-datepicker__calendar header .prev:not(.disabled):hover,
.vdp-datepicker__calendar header .next:not(.disabled):hover,
.vdp-datepicker__calendar header .up:not(.disabled):hover {
background: #ff586b !important;
}
input {
border: 0;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
-webkit-box-shadow: 0px 0px 4px #315f14;
-moz-box-shadow: 0px 0px 4px #4195fc;
box-shadow: 0px 0px 0px !important;
width: 400px;
}
</style>