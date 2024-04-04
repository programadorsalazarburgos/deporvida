/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/controllers/grupos/BeneficiarioGrupoCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("BeneficiarioGrupoCtrl", function ($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
    $scope.title = "Beneficiario Grupo";
    $scope.series = [];
    $scope.getData = function () {
        $scope.serie = GrupoService.get({ id: $routeParams.id });
    };

    $scope.serie = {};
    $scope.getData();

    function calcularEdad(birthday) {
        var birthday_arr = birthday.split("/");
        var birthday_date = new Date(birthday_arr[2], birthday_arr[1] - 1, birthday_arr[0]);
        var ageDifMs = Date.now() - birthday_date.getTime();
        var ageDate = new Date(ageDifMs);
        return Math.abs(ageDate.getUTCFullYear() - 1970);
    }

    Date.prototype.addDays = function (days) {
        var dat = new Date(this.valueOf());
        dat.setDate(dat.getDate() + days);
        return dat;
    };

    function init() {
        $scope.startDate = new Date();
        $scope.endDate = $scope.startDate.addDays(14);
        $scope.startDateParentesco = new Date();
        $scope.startDateInscripcion = new Date();
        $scope.endDatep = $scope.startDateParentesco.addDays(14);
        $scope.endDateInscripcion = $scope.startDateInscripcion.addDays(14);
    }

    function load() {

        $scope.fecha_nacimiento = $scope.startDate;
        var d = new Date($scope.fecha_nacimiento);
        var fecha = $.datepicker.formatDate('dd/mm/yy', d);
        var n = fecha.toString();
        $scope.edad_beneficiario = calcularEdad(n);
    }

    function load_parentesco() {

        $scope.fecha_nacimiento_pariente = $scope.startDateParentesco;
        var d_pariente = new Date($scope.fecha_nacimiento_pariente);
        var fecha_pariente = $.datepicker.formatDate('dd/mm/yy', d_pariente);
        var n_pariente = fecha_pariente.toString();
        $scope.edad_pariente = calcularEdad(n_pariente);
    }

    init();
    // public methods
    $scope.load = load;
    $scope.load_parentesco = load_parentesco;
    $scope.setStart = function (date) {
        $scope.startDate = date;
    };

    $scope.setStartInscripcion = function (date) {
        $scope.startDateInscripcion = date;
    };

    $scope.setStartParentesco = function (date) {
        $scope.startDateParentesco = date;
    };

    $scope.setEnd = function (date) {
        $scope.endDate = date;
        $scope.endDatep = date;
        $scope.endDateInscripcion = date;
    };

    $scope.tipo_documento = [{ id: '1', nombre: 'Registro Civil' }, { id: '2', nombre: 'Tarjeta Identidad' }, { id: '3', nombre: 'Cédula de Ciudadanía' }, { id: '4', nombre: 'Pasaporte' }, { id: '5', nombre: 'Sin Información' }];

    $scope.sexo = [{ id: '1', nombre: 'Femenino' }, { id: '2', nombre: 'Masculino' }];

    $scope.estado_civil_beneficiario = [{ id: '1', nombre: 'Casado' }, { id: '2', nombre: 'Soltero' }, { id: '3', nombre: 'Unión Libre' }, { id: '4', nombre: 'Viudo' }];

    $scope.tipo_sangre = [{ id: '1', nombre: 'O+' }, { id: '2', nombre: 'O-' }, { id: '3', nombre: 'A+' }, { id: '4', nombre: 'A-' }, { id: '5', nombre: 'B+' }, { id: '6', nombre: 'B-' }, { id: '7', nombre: 'AB+' }, { id: '8', nombre: 'AB-' }];

    $scope.ocupaciones = [{ id: '1', nombre: 'Ama de casa' }, { id: '2', nombre: 'Empleado' }, { id: '3', nombre: 'Estudiante' }, { id: '4', nombre: 'Desempleado' }, { id: '5', nombre: 'Independiente' }, { id: '6', nombre: 'Pensionado-Jubilado' }, { id: '7', nombre: 'Servidor Público' }, { id: '8', nombre: 'Otro' }];

    $scope.escolaridades = [{ id: '1', nombre: 'Educación inicial' }, { id: '2', nombre: 'Preescolar' }, { id: '3', nombre: 'Primaria' }, { id: '4', nombre: 'Secundaria' }, { id: '5', nombre: 'Técnico' }, { id: '6', nombre: 'Tecnológico' }, { id: '7', nombre: 'Universitario' }, { id: '8', nombre: 'Posgrado' }, { id: '9', nombre: 'Ninguno' }];

    $scope.culturas = [{ id: '1', nombre: 'Negro' }, { id: '2', nombre: 'Blanco' }, { id: '3', nombre: 'Índigena' }, { id: '4', nombre: 'Mestizo' }, { id: '5', nombre: 'Mulato' }, { id: '6', nombre: 'ROM, Gitano' }, { id: '7', nombre: 'Palenquero' }, { id: '8', nombre: 'Raizal' }, { id: '9', nombre: 'No sabe-No responde' }, { id: '10', nombre: 'Otro' }];

    $scope.grupos_poblacionales = [{ id: '1', nombre: 'Adulto Mayor' }, { id: '2', nombre: 'Afrodescendiente/Afrocolombiano' }, { id: '3', nombre: 'Víctimas del conflicto armado' }, { id: '4', nombre: 'Habitante calle' }, { id: '5', nombre: 'LGBTI' }, { id: '6', nombre: 'Persona con discapacidad' }, { id: '7', nombre: 'Grupo organizado de Mujeres' }, { id: '8', nombre: 'Indígenas' }, { id: '9', nombre: 'Reinsertado' }, { id: '10', nombre: 'Junta de acción comunal (JAC)' }, { id: '11', nombre: 'Grupo organizado de Jóvenes' }, { id: '12', nombre: 'Ninguno' }, { id: '13', nombre: 'Recluido' }, { id: '14', nombre: 'Junta de administradora local (JAL)' }, { id: '15', nombre: 'Otro grupo' }];

    $scope.selected = {
        poblacionales: []
    };

    $scope.hijos = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

    $scope.discapacidades = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

    $scope.discapacidad_otra = [{ id: '1', nombre: 'Auditiva' }, { id: '2', nombre: 'Cognitiva' }, { id: '3', nombre: 'Mental' }, { id: '4', nombre: 'Motriz' }, { id: '5', nombre: 'Oral' }, { id: '6', nombre: 'Visual' }];

    $scope.enfermedades = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

    $scope.medicamentos = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

    $scope.medicamentos = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

    $scope.seguridad_social = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

    $scope.salud_sgsss = [{ id: '1', nombre: 'Regimen Contributivo (EPS)' }, { id: '2', nombre: 'Regimen Subsidiado (SISBEN-EPS-S)' }, { id: '3', nombre: 'Especial (FFMM, Policia, etc)' }];

    $scope.parentescos = [{ id: '1', nombre: 'Madre/Padre' }, { id: '2', nombre: 'Hermana/Hermano' }, { id: '3', nombre: 'Tia/Tio' }, { id: '4', nombre: 'Abuela/Abuelo' }, { id: '5', nombre: 'Cuidador' }, { id: '6', nombre: 'Otro' }];

    $http.get(base_api + "/obtener/programas").success(function (response) {

        $scope.programas = response;
    });

    $http.get(base_api + "/obtener/paises").success(function (response) {

        $scope.paises = response;
    });

    $scope.selectedPais = function (item) {

        $http.get(base_api + "/obtener/departamentos/" + item).success(function (response) {

            $scope.departamentos = response;
        });
    };

    $scope.selectedDepartamento = function (item) {

        $http.get(base_api + "/obtener/municipios/" + item).success(function (response) {

            $scope.municipios = response;
        });
    };

    $http.get(base_api + "/obtenerselect/comunas").success(function (response) {

        $scope.comunas = response;
    });

    $scope.selectedComuna = function (item) {

        $http.get(base_api + "/obtener/barrios/" + item).success(function (response) {

            $scope.barrios = response;
        });
    };

    $scope.isDisabled = true;
    $scope.isDisabledOcupacion = true;
    $scope.isDisabledCultura = true;
    $scope.isDisabledDiscapacidad = true;
    $scope.isDisabledEnfermedad = true;
    $scope.isDisabledMedicamento = true;
    $scope.isDisabledSeguridad = true;
    $scope.isDisabledParentesco = true;

    $scope.selectedHijos = function (item) {

        if (item == 1) {
            $scope.isDisabled = false;
        } else {

            $scope.isDisabled = true;
        }
    };

    $scope.selectedOcupacion = function (item) {

        if (item == 8) {
            $scope.isDisabledOcupacion = false;
        } else {

            $scope.isDisabledOcupacion = true;
        }
    };

    $scope.selectedCultura = function (item) {

        if (item == 10) {
            $scope.isDisabledCultura = false;
        } else {

            $scope.isDisabledCultura = true;
        }
    };

    $scope.selectedDiscapacidad = function (item) {

        if (item == 1) {
            $scope.isDisabledDiscapacidad = false;
        } else {

            $scope.isDisabledDiscapacidad = true;
        }
    };

    $scope.selectedEnfermedad = function (item) {

        if (item == 1) {
            $scope.isDisabledEnfermedad = false;
        } else {

            $scope.isDisabledEnfermedad = true;
        }
    };

    $scope.selectedMedicamento = function (item) {

        if (item == 1) {
            $scope.isDisabledMedicamento = false;
        } else {

            $scope.isDisabledMedicamento = true;
        }
    };

    $scope.selectedSeguridad = function (item) {

        if (item == 1) {
            $scope.isDisabledSeguridad = false;
        } else {

            $scope.isDisabledSeguridad = true;
        }
    };

    $scope.selectedParentesco = function (item) {

        if (item == 6) {
            $scope.isDisabledParentesco = false;
        } else {

            $scope.isDisabledParentesco = true;
        }
    };

    $scope.selection = [];

    $scope.today = function () {
        $scope.dt = new Date();
    };
    $scope.today();

    $scope.openCalendar = function ($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.opened = true;
    };

    $scope.openCalendarNacimiento = function ($event) {

        $event.preventDefault();
        $event.stopPropagation();
        $scope.opened = true;
    };

    $scope.keyup = function (IsActive) {
        if (!IsActive) {
            $scope.IsActive = true;
            // alert($scope.firstName);
            // var age = calcularEdad("26/11/1986");
            // alert( age );
        } else {
            $scope.IsActive = false;
        }
    };

    $scope.formsubmit = function (id, isValid) {
        $scope.fecha_iscrip = $scope.startDateInscripcion;
        var d_inscripcion_date = new Date($scope.fecha_iscrip);
        var fecha_inscripcion_date = $.datepicker.formatDate('yy/mm/dd', d_inscripcion_date);
        $scope.fecha_nac_benef = $scope.startDate;
        var d_nacimiento_beneficiario = new Date($scope.fecha_nac_benef);
        var fecha_nacimiento_beneficiario = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_beneficiario);
        $scope.fecha_nac_acud = $scope.startDateParentesco;
        var d_nacimiento_acudiente = new Date($scope.fecha_nac_acud);
        var fecha_nacimiento_acudiente = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_acudiente);
        var SelectPoblacional = $scope.selected.poblacionales;

        if (isValid) {

            var datos = {
                fecha_inscripcion: fecha_inscripcion_date,
                no_ficha: $scope.numero_ficha,
                programa_id: $scope.programa,
                modalidad: $scope.modalidad,
                punto_atencion: $scope.punto_atencion,
                nombres_beneficiario: $scope.nombres_beneficiario,
                apellidos_beneficiario: $scope.apellidos_beneficiario,
                tipo_documento_beneficiario: $scope.tipo_documento_beneficiario,
                no_documento_beneficiario: $scope.no_documento_beneficiario,
                sexo_beneficiario: $scope.sexo_beneficiario,
                fecha_nac_beneficiario: fecha_nacimiento_beneficiario,
                edad_beneficiario: $scope.edad_beneficiario,
                telefono_beneficiario: $scope.telefono_beneficiario,
                correo_beneficiario: $scope.correo_beneficiario,
                pais_id: $scope.pais,
                departamento_id: $scope.departamento,
                municipio_id: $scope.municipio,
                direccion_beneficiario: $scope.residencia_beneficiario,
                estrato_beneficiario: $scope.estrato,
                comuna_id: $scope.comuna,
                barrio_id: $scope.barrio,
                corregimiento_beneficiario: $scope.corregimiento,
                vereda_beneficiario: $scope.vereda,
                estado_civil_beneficiario: $scope.est_beneficiario,
                hijos_beneficiario: $scope.hijo,
                cantidad_hijos_beneficiario: $scope.cantidad_hijos,
                tipo_sangre_beneficiario: $scope.tip_sangre,
                ocupacion_beneficiario: $scope.ocupacion,
                otra_ocupacion_beneficiario: $scope.ocupacion_otra,
                escolaridad_beneficiario: $scope.escolaridad,
                cultura_beneficiario: $scope.cultura,
                otra_cultura_beneficiario: $scope.cultura_otro,
                discapacidad_beneficiario: $scope.discapacidad,
                discapacidad_select_beneficiario: $scope.discapacidad_otro,
                otra_discapacidad_beneficiario: $scope.otra_discapacidad,
                enfermedad_permanente_beneficiario: $scope.enfermedad,
                enfermedad_beneficiario: $scope.otra_enfermedad,
                medicamentos_permanente_beneficiario: $scope.medicamento,
                medicamentos_beneficiario: $scope.medicamento_otro,
                seguridad_social_beneficiario: $scope.seguridad,
                salud_sgsss_beneficiario: $scope.salud,
                nombre_seguridad_beneficiario: $scope.nombre_entidad,
                nombres_acudiente: $scope.nombres_familiar,
                apellidos_acudiente: $scope.apellidos_familiar,
                tipo_doc_acudiente: $scope.tipo_familiar,
                documento_acudiente: $scope.no_documento_pariente,
                sexo_acudiente: $scope.sex_pariente,
                fecha_nac_acudiente: fecha_nacimiento_acudiente,
                edad_acudiente: $scope.edad_pariente,
                telefono_acudiente: $scope.telefono_pariente,
                correo_acudiente: $scope.email_pariente,
                parentesco_acudiente: $scope.parentesco,
                otro_parentesco_acudiente: $scope.otro_parentesco
            };

            $.ajax({
                url: base_api + '/postbeneficiario/create/' + id,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    datos: datos,
                    SelectPoblacional: SelectPoblacional
                }

            }).success(function () {

                toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
                window.location = "/admin/postgrupos#/admin/postgrupos";
            }).error(function () {
                console.log("success");
            });
        }
    };
});

/***/ }),

/***/ "./resources/assets/controllers/grupos/CreateGrupoCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("CreateGrupoCtrl", function ($scope, GrupoService, fileUpload, $http, $location, base_api, $q) {
  $scope.title = "Agregar Grupo";
  $scope.disable_submit = false;

  $scope.serie = {};

  $scope.disabled = undefined;

  $scope.enable = function () {
    $scope.disabled = false;
  };

  $scope.disable = function () {
    $scope.disabled = true;
  };

  $scope.clear = function () {
    $scope.person.selected = undefined;
    $scope.address.selected = undefined;
    $scope.country.selected = undefined;
  };

  $scope.person = {};

  $http.get(base_api + "/obtenercount/grupos").success(function (response) {

    var numero = [response];

    var largo_numero = numero.length;
    var largo_maximo = 4;
    var agregar = largo_maximo - largo_numero;

    for (i = 0; i < agregar; i++) {
      numero = "0" + numero;
      // console.log(numero);
    }

    $http.get(base_api + "/obtener/monitores").success(function (response) {
      $scope.monitores = response;
      console.log($scope.monitores);
    });

    $scope.codigo_grupo = numero;
  });

  $http.get(base_api + "/obtenerselect/sedes").success(function (response) {

    $scope.people = response;
  });

  $scope.address = {};
  $scope.refreshAddresses = function (address) {
    var params = { address: address, sensor: false };
    return $http.get('http://maps.googleapis.com/maps/api/geocode/json', { params: params }).then(function (response) {
      $scope.addresses = response.data.results;
    });
  };

  $scope.addItem = function () {
    $scope.items.push({ id: $scope.items.length, text: 'item ' + $scope.items.length });
  };

  $scope.removeItem = function () {
    $scope.items.pop();
  };

  $scope.changeItems = function () {
    //$scope.items[0].id = 123;
    $scope.items[0].text = 'item 123';
    $scope.items1[0] = 'item 123';
  };

  $scope.reorder = function () {
    var t = $scope.items[2];
    $scope.items[2] = $scope.items[3];
    $scope.items[3] = t;
  };

  $scope.check = function () {
    $scope.user.values1 = [1, 4];
  };

  $scope.dias = [{ id: 'lunes' }, { id: 'martes' }, { id: 'miercoles' }, { id: 'jueves' }, { id: 'viernes' }];

  $scope.time1 = new Date();

  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);
  $scope.showMeridian = true;

  $scope.disabled = false;

  $scope.formsubmit = function (isValid) {

    if (isValid) {
      var dias_horario = [];
      $scope.dias.forEach(function (dia) {
        if (dia.inicio || dia.final) {
          dias_horario.push(dia);
        }
      });

      console.log($scope);
      var observaciones = $scope.observaciones;

      $.ajax({
        url: base_api + '/postgrupo/create',
        type: 'POST',
        dataType: 'JSON',
        data: {
          codigo_grupo: $scope.codigo_grupo,
          id_monitor: $scope.id_monitor,
          observaciones: observaciones,
          dias_horario: dias_horario
        }

      }).success(function () {

        toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
        window.location = "/admin/postgrupos#/admin/postgrupos";
      }).error(function () {
        console.log("success");
      });
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/grupos/EditarGrupoCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("EditarGrupoCtrl", function ($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
  $scope.title = "Editar Grupo";
  $scope.series = [];
  $scope.getData = function () {
    $scope.serie = GrupoService.get({ id: $routeParams.id });

    // console.log($scope.serie);
  };

  $scope.serie = {};
  $scope.getData();

  $scope.disabled = undefined;

  $scope.enable = function () {
    $scope.disabled = false;
  };

  $scope.disable = function () {
    $scope.disabled = true;
  };

  $scope.clear = function () {
    $scope.person.selected = undefined;
    $scope.address.selected = undefined;
    $scope.country.selected = undefined;
  };

  $scope.person = {};

  $http.get(base_api + "/obtenerselect/SedeGrupo/" + $routeParams.id).success(function (response) {

    $scope.dataSede = response;
    console.log($scope.dataSede);
  });

  $http.get(base_api + "/obtenerselect/sedes").success(function (response) {

    $scope.people = response;
    console.log($scope.people);
  });

  $scope.address = {};
  $scope.refreshAddresses = function (address) {
    var params = { address: address, sensor: false };
    return $http.get('http://maps.googleapis.com/maps/api/geocode/json', { params: params }).then(function (response) {
      $scope.addresses = response.data.results;
    });
  };

  $scope.dias = [{ id: 'lunes' }, { id: 'martes' }, { id: 'miercoles' }, { id: 'jueves' }, { id: 'viernes' }];

  $http.get(base_api + "/obtener/GrupoHorario/" + $routeParams.id).success(function (response) {

    response.forEach(function (element) {
      var dia = $scope.dias.find(function (d) {
        return d.id == element.dia;
      });
      if (dia) {

        dia.checked = true;
        dia._id = element.id;
        dia.inicio = new Date();
        dia.inicio.setHours(element.hora_inicio.split(":")[0]);
        dia.inicio.setMinutes(element.hora_inicio.split(":")[1]);
        //dia.inicio = element.hora_inicio;
        dia.fin = new Date();
        dia.fin.setHours(element.hora_fin.split(":")[0]);
        dia.fin.setMinutes(element.hora_fin.split(":")[1]);
        //dia.fin = element.hora_fin;
      }
    });
  });

  $scope.time1 = new Date();

  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);

  $scope.showMeridian = true;

  $scope.disabled = false;

  $scope.avisar = function (dia) {

    if (dia.checked) {}
  };

  $scope.formsubmit = function (id, isValid) {

    if (isValid) {

      var codigo_grupo = $scope.serie.codigo_grupo;
      var obt_sede = $scope.person.id;
      var observaciones = $scope.serie.observaciones;

      if (obt_sede == undefined) {

        obt_sede = 0;
        var sede = obt_sede;
      } else {
        var sede = obt_sede['id'];
      }

      var datos = {
        codigo_grupo: codigo_grupo,
        sede: sede,
        observaciones: observaciones
      };

      var dias_horario = [];

      $scope.dias.forEach(function (dia) {
        if (dia.inicio || dia.final) {
          dias_horario.push(dia);
        }
      });

      $.ajax({
        url: base_api + '/postgrupo/actualizar/' + id,
        type: 'POST',
        dataType: 'JSON',
        data: {

          dias_horario: dias_horario,
          datos: datos
        }

      }).success(function () {

        toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
        window.location = "/admin/postgrupos#/admin/postgrupos";
      }).error(function () {
        console.log("successs");
      });
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/grupos/EditarMiBeneficiarioCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("EditarMiBeneficiarioCtrl", function ($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
  $scope.title = "Editar Beneficiario";
  $scope.series = [];
  $scope.getData = function () {

    $http.get(base_api + "/admin/postbeneficiarios/" + $routeParams.id).success(function (response) {

      $scope.serie = response;

      console.log($scope.serie);
      var n = $scope.serie.fecha_inscripcion.toString();
      $scope.fecha_inscripcions = new Date(n);

      var nac_beneficiario = $scope.serie.fecha_nac_beneficiario.toString();
      $scope.fecha_nac = new Date(nac_beneficiario);

      var na = $scope.serie.fecha_nac_acudiente.toString();
      $scope.fecha_acudiente = new Date(na);
    });
  };

  $scope.serie = {};
  $scope.getData();
  $http.get(base_api + "/obtenerselect/SedeGrupo/" + $routeParams.id).success(function (response) {
    $scope.dataSede = response;
  });

  $http.get(base_api + "/obtener/programa/" + $routeParams.id).success(function (response) {
    $scope.data_programa = {
      'id': 1,
      'unit': response.id
    };
  });

  $http.get(base_api + "/obtener/programas").success(function (response) {
    $scope.programas = response;
  });

  $http.get(base_api + "/obtener/pais/" + $routeParams.id).success(function (response) {
    $scope.data = {
      'id': 1,
      'unit': response.id
    };

    $http.get(base_api + "/obtener/departamentos/" + $scope.data.unit).success(function (response) {
      $scope.departamentos = response;
    });
  });

  $http.get(base_api + "/obtener/paises").success(function (response) {
    $scope.paises = response;
  });

  $scope.selectedPais = function (item) {

    $http.get(base_api + "/obtener/departamentos/" + item).success(function (response) {
      $scope.departamentos = response;
    });
  };

  $scope.selectedDepartamento = function (item) {

    $http.get(base_api + "/obtener/municipios/" + item).success(function (response) {
      $scope.municipios = response;
    });
  };

  $http.get(base_api + "/obtener/departamento/" + $routeParams.id).success(function (response) {
    $scope.datas = {
      'id': 1,
      'unit': response.id
    };

    $http.get(base_api + "/obtener/municipios/" + $scope.datas.unit).success(function (response) {
      $scope.municipios = response;
    });
  });

  $http.get(base_api + "/obtener/municipio/" + $routeParams.id).success(function (response) {
    $scope.data_municipio = {
      'id': 1,
      'unit': response.id
    };
  });

  $http.get(base_api + "/obtenerselect/comunas").success(function (response) {
    $scope.comunas = response;
    // console.log($scope.comunas);
  });

  $http.get(base_api + "/obtener/comuna/" + $routeParams.id).success(function (response) {
    $scope.data_comuna = {
      'id': 1,
      'unit': response.id
    };

    $http.get(base_api + "/obtener/barrios/" + $scope.data.unit).success(function (response) {
      $scope.barrios = response;
    });
  });

  $http.get(base_api + "/obtener/barrio/" + $routeParams.id).success(function (response) {
    $scope.data_barrio = {
      'id': 1,
      'unit': response.id
    };
  });

  $scope.selectedComuna = function (item) {

    $http.get(base_api + "/obtener/barrios/" + item).success(function (response) {

      $scope.barrios = response;
    });
  };

  $http.get(base_api + "/obtener/tipodocumento/" + $routeParams.id).success(function (response) {

    $scope.obtener = {};
    $scope.obtener.documentoId = response.id.toString();

    $scope.obtener.documentos = [{ id: '1', nombre: 'Registro Civil' }, { id: '2', nombre: 'Tarjeta Identidad' }, { id: '3', nombre: 'Cédula de Ciudadanía' }, { id: '4', nombre: 'Pasaporte' }, { id: '5', nombre: 'Sin Información' }];
  });

  $http.get(base_api + "/obtener/sexo/" + $routeParams.id).success(function (response) {

    $scope.obsexo = {};
    $scope.obsexo.sexoId = response.id.toString();

    $scope.obsexo.sexo = [{ id: '1', nombre: 'Femenino' }, { id: '2', nombre: 'Masculino' }];
  });

  $http.get(base_api + "/obtener/civil/" + $routeParams.id).success(function (response) {

    $scope.obcivil = {};
    $scope.obcivil.civilId = response.id.toString();

    $scope.obcivil.civil = [{ id: '1', nombre: 'Casado' }, { id: '2', nombre: 'Soltero' }, { id: '3', nombre: 'Unión Libre' }, { id: '4', nombre: 'Viudo' }];
  });

  $http.get(base_api + "/obtener/hijos/" + $routeParams.id).success(function (response) {

    $scope.obhijos = {};
    $scope.obhijos.hijosId = response.id.toString();

    $scope.obhijos.hijos = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];
  });

  $http.get(base_api + "/obtener/tiposangre/" + $routeParams.id).success(function (response) {

    $scope.obtipo_sangre = {};
    $scope.obtipo_sangre.tipo_sangreId = response.id.toString();

    $scope.obtipo_sangre.tipo_sangre = [{ id: '1', nombre: 'O+' }, { id: '2', nombre: 'O-' }, { id: '3', nombre: 'A+' }, { id: '4', nombre: 'A-' }, { id: '5', nombre: 'B+' }, { id: '6', nombre: 'B-' }, { id: '7', nombre: 'AB+' }, { id: '8', nombre: 'AB-' }];
  });

  $http.get(base_api + "/obtener/ocupacion/" + $routeParams.id).success(function (response) {

    $scope.obocupacion = {};
    $scope.obocupacion.ocupacionId = response.id.toString();

    $scope.obocupacion.ocupacion = [{ id: '1', nombre: 'Ama de casa' }, { id: '2', nombre: 'Empleado' }, { id: '3', nombre: 'Estudiante' }, { id: '4', nombre: 'Desempleado' }, { id: '5', nombre: 'Independiente' }, { id: '6', nombre: 'Pensionado-Jubilado' }, { id: '7', nombre: 'Servidor Público' }, { id: '8', nombre: 'Otro' }];
  });

  $http.get(base_api + "/obtener/escolaridad/" + $routeParams.id).success(function (response) {

    $scope.obescolaridad = {};
    $scope.obescolaridad.escolaridadId = response.id.toString();

    $scope.obescolaridad.escolaridad = [{ id: '1', nombre: 'Educación inicial' }, { id: '2', nombre: 'Preescolar' }, { id: '3', nombre: 'Primaria' }, { id: '4', nombre: 'Secundaria' }, { id: '5', nombre: 'Técnico' }, { id: '6', nombre: 'Tecnológico' }, { id: '7', nombre: 'Universitario' }, { id: '8', nombre: 'Posgrado' }, { id: '9', nombre: 'Ninguno' }];
  });

  $http.get(base_api + "/obtener/cultura/" + $routeParams.id).success(function (response) {

    $scope.obcultura = {};
    $scope.obcultura.culturaId = response.id.toString();

    $scope.obcultura.cultura = [{ id: '1', nombre: 'Negro' }, { id: '2', nombre: 'Blanco' }, { id: '3', nombre: 'Índigena' }, { id: '4', nombre: 'Mestizo' }, { id: '5', nombre: 'Mulato' }, { id: '6', nombre: 'ROM, Gitano' }, { id: '7', nombre: 'Palenquero' }, { id: '8', nombre: 'Raizal' }, { id: '9', nombre: 'No sabe-No responde' }, { id: '10', nombre: 'Otro' }];
  });

  $http.get(base_api + "/obtener/discapacidad/" + $routeParams.id).success(function (response) {

    $scope.obdiscapacidad = {};
    $scope.obdiscapacidad.discapacidadId = response.id.toString();

    $scope.obdiscapacidad.discapacidad = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];
  });

  $http.get(base_api + "/obtener/DiscapacidadOtra/" + $routeParams.id).success(function (response) {

    $scope.obdiscapacidadotro = {};
    $scope.obdiscapacidadotro.discapacidadotroId = response.id.toString();

    $scope.obdiscapacidadotro.discapacidadotro = [{ id: '1', nombre: 'Auditiva' }, { id: '2', nombre: 'Cognitiva' }, { id: '3', nombre: 'Mental' }, { id: '4', nombre: 'Motriz' }, { id: '5', nombre: 'Oral' }, { id: '6', nombre: 'Visual' }];
  });

  $http.get(base_api + "/obtener/enfermedadpermanente/" + $routeParams.id).success(function (response) {

    console.log(response);
    $scope.obenfermedad = {};
    $scope.obenfermedad.enfermedadId = response.id.toString();

    $scope.obenfermedad.enfermedad = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];
  });

  $http.get(base_api + "/obtener/medicamentopermanente/" + $routeParams.id).success(function (response) {

    console.log(response);
    $scope.obmedicamento = {};
    $scope.obmedicamento.medicamentoId = response.id.toString();

    $scope.obmedicamento.medicamento = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];
  });

  $http.get(base_api + "/obtener/seguridadsocial/" + $routeParams.id).success(function (response) {

    console.log(response);
    $scope.obseguridadsocial = {};
    $scope.obseguridadsocial.seguridadsocialId = response.id.toString();

    $scope.obseguridadsocial.seguridadsocial = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];
  });

  $http.get(base_api + "/obtener/saludsgss/" + $routeParams.id).success(function (response) {

    $scope.obsaludsgss = {};
    $scope.obsaludsgss.saludsgssId = response.id.toString();

    $scope.obsaludsgss.saludsgss = [{ id: '1', nombre: 'Regimen Contributivo (EPS)' }, { id: '2', nombre: 'Regimen Subsidiado (SISBEN-EPS-S)' }, { id: '3', nombre: 'Especial (FFMM, Policia, etc)' }];
  });

  $http.get(base_api + "/obtener/documentoacudiente/" + $routeParams.id).success(function (response) {

    $scope.obdoc_acudiente = {};
    $scope.obdoc_acudiente.doc_acudienteId = response.id.toString();

    $scope.obdoc_acudiente.doc_acudiente = [{ id: '1', nombre: 'Registro Civil' }, { id: '2', nombre: 'Tarjeta Identidad' }, { id: '3', nombre: 'Cédula de Ciudadanía' }, { id: '4', nombre: 'Pasaporte' }, { id: '5', nombre: 'Sin Información' }];
  });

  $http.get(base_api + "/obtener/sexo_acudiente/" + $routeParams.id).success(function (response) {

    $scope.obsexo_acudiente = {};
    $scope.obsexo_acudiente.sexo_acudienteId = response.id.toString();

    $scope.obsexo_acudiente.sexo_acudiente = [{ id: '1', nombre: 'Femenino' }, { id: '2', nombre: 'Masculino' }];
  });

  $http.get(base_api + "/obtener/parentesco/" + $routeParams.id).success(function (response) {

    $scope.obparentesco = {};
    $scope.obparentesco.parentescoId = response.id.toString();

    $scope.obparentesco.parentesco = [{ id: '1', nombre: 'Madre/Padre' }, { id: '2', nombre: 'Hermana/Hermano' }, { id: '3', nombre: 'Tia/Tio' }, { id: '4', nombre: 'Abuela/Abuelo' }, { id: '5', nombre: 'Cuidador' }, { id: '6', nombre: 'Otro' }];
  });

  Array.prototype.indexOfObjectWithProperty = function (propertyName, propertyValue) {
    for (var i = 0, len = this.length; i < len; i++) {
      if (this[i][propertyName] === propertyValue) return i;
    }

    return -1;
  };

  Array.prototype.containsObjectWithProperty = function (propertyName, propertyValue) {
    return this.indexOfObjectWithProperty(propertyName, propertyValue) != -1;
  };

  $scope.allGrupos_poblacionales = [{ id: 1, name: 'Adulto Mayor' }, { id: 2, name: 'Afrodescendiente/Afrocolombiano' }, { id: 3, name: 'Víctimas del conflicto armado' }, { id: 4, name: 'Habitante calle' }, { id: 5, name: 'LGBTI' }, { id: 6, name: 'Persona con discapacidad' }, { id: 7, name: 'Grupo organizado de Mujeres' }, { id: 8, name: 'Indígenas' }, { id: 9, name: 'Reinsertado' }, { id: 10, name: 'Junta de acción comunal (JAC)' }, { id: 11, name: 'Grupo organizado de Jóvenes' }, { id: 12, name: 'Ninguno' }, { id: 13, name: 'Recluido' }, { id: 14, name: 'Junta de administradora local (JAL)' }, { id: 15, name: 'Otro grupo' }];

  $http.get(base_api + "/obtener/poblacionales/" + $routeParams.id).success(function (response) {

    $scope.selectedPoblacionales = response;
  });

  $scope.toggleSelection = function toggleSelection(seleccion) {

    var index = $scope.selectedPoblacionales.indexOfObjectWithProperty('id', seleccion.id);

    if (index > -1) {
      $scope.selectedPoblacionales.splice(index, 1);
    } else {
      $scope.selectedPoblacionales.push(seleccion);
      console.log($scope.selectedPoblacionales);
    }
  };

  $scope.time1 = new Date();
  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);
  $scope.showMeridian = true;
  $scope.disabled = false;

  $scope.formsubmit = function (id, isValid) {

    $scope.fecha_iscrip = $scope.fecha_inscripcions;
    var d_inscripcion_date = new Date($scope.fecha_iscrip);
    var fecha_inscripcion_date = $.datepicker.formatDate('yy/mm/dd', d_inscripcion_date);
    var d_nacimiento_beneficiario = new Date($scope.fecha_nac);
    var fecha_nacimiento_beneficiario = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_beneficiario);
    $scope.fecha_nac_acud = $scope.fecha_acudiente;
    var d_nacimiento_acudiente = new Date($scope.fecha_nac_acud);
    var fecha_nacimiento_acudiente = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_acudiente);

    if (isValid) {

      var datos = {

        grupo_id: $scope.serie.grupo_id,
        fecha_inscripcion: fecha_inscripcion_date,
        no_ficha: $scope.serie.no_ficha,
        programa_id: $scope.data_programa.unit,
        modalidad: $scope.serie.modalidad,
        punto_atencion: $scope.serie.punto_atencion,
        nombres_beneficiario: $scope.serie.nombres_beneficiario,
        apellidos_beneficiario: $scope.serie.apellidos_beneficiario,
        tipo_documento_beneficiario: $scope.obtener.documentoId,
        no_documento_beneficiario: $scope.serie.no_documento_beneficiario,
        sexo_beneficiario: $scope.obsexo.sexoId,
        fecha_nac_beneficiario: fecha_nacimiento_beneficiario,
        edad_beneficiario: $scope.serie.edad_beneficiario,
        telefono_beneficiario: $scope.serie.telefono_beneficiario,
        correo_beneficiario: $scope.serie.correo_beneficiario,
        pais_id: $scope.data.unit,
        departamento_id: $scope.datas.unit,
        municipio_id: $scope.data_municipio.unit,
        direccion_beneficiario: $scope.serie.direccion_beneficiario,
        estrato_beneficiario: $scope.serie.estrato_beneficiario,
        comuna_id: $scope.data_comuna.unit,
        barrio_id: $scope.data_barrio.unit,
        corregimiento_beneficiario: $scope.serie.corregimiento_beneficiario,
        vereda_beneficiario: $scope.serie.vereda_beneficiario,
        estado_civil_beneficiario: $scope.obcivil.civilId,
        hijos_beneficiario: $scope.obhijos.hijosId,
        cantidad_hijos_beneficiario: $scope.serie.cantidad_hijos_beneficiario,
        tipo_sangre_beneficiario: $scope.obtipo_sangre.tipo_sangreId,
        ocupacion_beneficiario: $scope.obocupacion.ocupacionId,
        otra_ocupacion_beneficiario: $scope.serie.ocupacion_beneficiario,
        escolaridad_beneficiario: $scope.obescolaridad.escolaridadId,
        cultura_beneficiario: $scope.obcultura.culturaId,
        otra_cultura_beneficiario: $scope.serie.otra_cultura_beneficiario,
        discapacidad_beneficiario: $scope.obdiscapacidad.discapacidadId,
        discapacidad_select_beneficiario: $scope.obdiscapacidadotro.discapacidadotroId,
        otra_discapacidad_beneficiario: $scope.serie.otra_discapacidad_beneficiario,
        enfermedad_permanente_beneficiario: $scope.obenfermedad.enfermedadId,
        enfermedad_beneficiario: $scope.serie.enfermedad_beneficiario,
        medicamentos_permanente_beneficiario: $scope.obmedicamento.medicamentoId,
        medicamentos_beneficiario: $scope.serie.medicamentos_beneficiario,
        seguridad_social_beneficiario: $scope.obseguridadsocial.seguridadsocialId,
        salud_sgsss_beneficiario: $scope.obsaludsgss.saludsgssId,
        nombre_seguridad_beneficiario: $scope.serie.nombre_seguridad_beneficiario,
        nombres_acudiente: $scope.serie.nombres_acudiente,
        apellidos_acudiente: $scope.serie.apellidos_acudiente,
        tipo_doc_acudiente: $scope.obdoc_acudiente.doc_acudienteId,
        documento_acudiente: $scope.serie.documento_acudiente,
        sexo_acudiente: $scope.obsexo_acudiente.sexo_acudienteId,
        fecha_nac_acudiente: fecha_nacimiento_acudiente,
        edad_acudiente: $scope.serie.edad_acudiente,
        telefono_acudiente: $scope.serie.telefono_acudiente,
        correo_acudiente: $scope.serie.correo_acudiente,
        parentesco_acudiente: $scope.obparentesco.parentescoId,
        otro_parentesco_acudiente: $scope.serie.otro_parentesco_acudiente
      };

      var poblacionales = $scope.selectedPoblacionales;

      $.ajax({
        url: base_api + '/postbeneficiario/actualizar/' + id,
        type: 'POST',
        dataType: 'JSON',
        data: {

          datos: datos,
          poblacionales: poblacionales
        }
      }).success(function () {
        toastr.success("Su registro ha sido exitoso", "Registro Actualizado");
        window.location = "/admin/postgrupos#/admin/postgrupos/misbeneficiarios/" + $scope.serie.grupo_id;
      }).error(function () {
        console.log("success");
      });
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/grupos/GruposCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('GruposCrtl', function ($scope, $routeParams, $location, GrupoService, $http, $timeout, base_api) {
    $scope.title = "Grupos";
    $scope.series = [];
    $scope.getData = function () {
        $http.get(base_api + "/admin/postgrupos").success(function (response) {
            $scope.list = response;
            console.log($scope.list);
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 50; //max no of items to display in a page
            $scope.filteredItems = $scope.list.length; //Initially for no filter
            $scope.totalItems = $scope.list.length;
        });
    };
    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function () {
        $timeout(function () {
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function (predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
    $scope.getData();
    $scope.series = GrupoService.query();
    $scope.eliminar = function (id) {
        swal({
            title: "Estas seguro?",
            text: "No podrá recuperar este archivo!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Eliminado!",
            cancelButtonText: "No, lo Elimines!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base + '/grupos/eliminar/' + id,
                    type: 'GET',
                    dataType: 'JSON'
                }).success(function (response) {
                    swal("Eliminado!", "Registro Eliminado.", "success");
                    $scope.getData();
                }).error(function () {
                    swal("Cancelado", "No puede eliminar este grupo tiene asociado beneficiarios :)", "error");
                });
            } else {
                swal("Cancelado", "No elimino su registro :)", "error");
            }
        });
    };
});

/***/ }),

/***/ "./resources/assets/controllers/grupos/MisBeneficiariosGrupoCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("MisBeneficiariosGrupoCtrl", function ($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
    $scope.title = "Mis Beneficiarios";
    $scope.series = [];

    $scope.getData = function () {
        $scope.series_grupos = GrupoService.get({ id: $routeParams.id });

        $scope.grupo = $routeParams.id;
        $http.get(base_api + "/obtener/misbeneficiarios/" + $routeParams.id).success(function (response) {
            $scope.list = response;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 50; //max no of items to display in a page
            $scope.filteredItems = $scope.list.length; //Initially for no filter
            $scope.totalItems = $scope.list.length;
        });
    };

    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function () {
        $timeout(function () {
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function (predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };

    $scope.getData();
    $scope.series = GrupoService.query();

    $http.get(base_api + "/obtenerselect/comunas").success(function (response) {

        $scope.comunas = response;
    });

    $scope.toggle = function (modalstate, id) {
        $scope.modalstate = modalstate;
        switch (modalstate) {

            case 'CambiarGrupo':
                $scope.form_contenido = "GRUPOS";
                $scope.form_title = "obtener";
                $scope.id = id;

                break;
            default:
                break;
        }

        $('#myModal').modal('show');
    };

    $http.get(base_api + "/obtener/allgruposmonitor").success(function (response) {
        $scope.grupos = response;
    });

    $scope.formCambiar = function (isValid, id) {

        if (isValid) {

            $.ajax({
                url: base_api + '/postbeneficiario/asociargrupo/' + id,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    grupo_id: $scope.grupo
                }

            }).success(function () {

                $scope.getData();
                toastr.success("Su registro ha sido exitoso", "Grupo Asociado");
                window.location = "/admin/postgrupos#/admin/postgrupos/misbeneficiarios/" + $routeParams.id;
                $('#myModal').modal('hide');
            }).error(function () {
                console.log("success");
            });
        }
    };

    $scope.formsubmit = function (id, isValid) {
        $scope.fecha_iscrip = $scope.startDateInscripcion;
        var d_inscripcion_date = new Date($scope.fecha_iscrip);
        var fecha_inscripcion_date = $.datepicker.formatDate('yy/mm/dd', d_inscripcion_date);
        $scope.fecha_nac_benef = $scope.startDate;
        var d_nacimiento_beneficiario = new Date($scope.fecha_nac_benef);
        var fecha_nacimiento_beneficiario = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_beneficiario);
        $scope.fecha_nac_acud = $scope.startDateParentesco;
        var d_nacimiento_acudiente = new Date($scope.fecha_nac_acud);
        var fecha_nacimiento_acudiente = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_acudiente);
        var SelectPoblacional = $scope.selected.poblacionales;

        if (isValid) {

            var datos = {
                fecha_inscripcion: fecha_inscripcion_date,
                no_ficha: $scope.numero_ficha,
                programa_id: $scope.programa,
                modalidad: $scope.modalidad,
                punto_atencion: $scope.punto_atencion,
                nombres_beneficiario: $scope.nombres_beneficiario,
                apellidos_beneficiario: $scope.apellidos_beneficiario,
                tipo_documento_beneficiario: $scope.tipo_documento_beneficiario,
                no_documento_beneficiario: $scope.no_documento_beneficiario,
                sexo_beneficiario: $scope.sexo_beneficiario,
                fecha_nac_beneficiario: fecha_nacimiento_beneficiario,
                edad_beneficiario: $scope.edad_beneficiario,
                telefono_beneficiario: $scope.telefono_beneficiario,
                correo_beneficiario: $scope.correo_beneficiario,
                pais_id: $scope.pais,
                departamento_id: $scope.departamento,
                municipio_id: $scope.municipio,
                direccion_beneficiario: $scope.residencia_beneficiario,
                estrato_beneficiario: $scope.estrato,
                comuna_id: $scope.comuna,
                barrio_id: $scope.barrio,
                corregimiento_beneficiario: $scope.corregimiento,
                vereda_beneficiario: $scope.vereda,
                estado_civil_beneficiario: $scope.est_beneficiario,
                hijos_beneficiario: $scope.hijo,
                cantidad_hijos_beneficiario: $scope.cantidad_hijos,
                tipo_sangre_beneficiario: $scope.tip_sangre,
                ocupacion_beneficiario: $scope.ocupacion,
                otra_ocupacion_beneficiario: $scope.ocupacion_otra,
                escolaridad_beneficiario: $scope.escolaridad,
                cultura_beneficiario: $scope.cultura,
                otra_cultura_beneficiario: $scope.cultura_otro,
                discapacidad_beneficiario: $scope.discapacidad,
                discapacidad_select_beneficiario: $scope.discapacidad_otro,
                otra_discapacidad_beneficiario: $scope.otra_discapacidad,
                enfermedad_permanente_beneficiario: $scope.enfermedad,
                enfermedad_beneficiario: $scope.otra_enfermedad,
                medicamentos_permanente_beneficiario: $scope.medicamento,
                medicamentos_beneficiario: $scope.medicamento_otro,
                seguridad_social_beneficiario: $scope.seguridad,
                salud_sgsss_beneficiario: $scope.salud,
                nombre_seguridad_beneficiario: $scope.nombre_entidad,
                nombres_acudiente: $scope.nombres_familiar,
                apellidos_acudiente: $scope.apellidos_familiar,
                tipo_doc_acudiente: $scope.tipo_familiar,
                documento_acudiente: $scope.no_documento_pariente,
                sexo_acudiente: $scope.sex_pariente,
                fecha_nac_acudiente: fecha_nacimiento_acudiente,
                edad_acudiente: $scope.edad_pariente,
                telefono_acudiente: $scope.telefono_pariente,
                correo_acudiente: $scope.email_pariente,
                parentesco_acudiente: $scope.parentesco,
                otro_parentesco_acudiente: $scope.otro_parentesco
            };

            $.ajax({
                url: base_api + '/postbeneficiario/create/' + id,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    datos: datos,
                    SelectPoblacional: SelectPoblacional
                }

            }).success(function () {

                toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
                window.location = "/admin/postgrupos#/admin/postgrupos";
            }).error(function () {
                console.log("success");
            });
        }
    };

    $scope.GuardarMotivo = function (isValid, ficha) {

        if (isValid) {

            $.ajax({
                url: base + '/beneficiario/desvincular?ficha=' + ficha + '&motivo=' + $scope.motivo,
                type: 'GET',
                dataType: 'JSON'
            }).success(function (response) {
                swal("Desvinculado!", "Registro Desvinculado.", "success");
                $scope.getData();
                $('#myModal2').modal('toggle');
            }).error(function () {});
        } else {
            alert('rellene los campos');
        }
    };

    $scope.eliminar = function (id) {
        swal({
            title: "Va a desvincular este beneficiario",
            text: "¿Desea continuar?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Desvincular!",
            cancelButtonText: "No, lo Elimines!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {

                $http.get(base_api + "/obtener/motivos").success(function (response) {
                    $scope.motivos = response;
                    $scope.ficha = id;
                });

                swal("Porque deseas desvincular este beneficiario", "Elije tu opción");
                $("#myModal2").modal();
            } else {
                swal("Cancelado", "No desvinculo su beneficiario :)", "error");
            }
        });
    };
});

/***/ }),

/***/ 1:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/controllers/grupos/GruposCrtl.js");
__webpack_require__("./resources/assets/controllers/grupos/CreateGrupoCtrl.js");
__webpack_require__("./resources/assets/controllers/grupos/EditarGrupoCtrl.js");
__webpack_require__("./resources/assets/controllers/grupos/BeneficiarioGrupoCtrl.js");
__webpack_require__("./resources/assets/controllers/grupos/MisBeneficiariosGrupoCtrl.js");
module.exports = __webpack_require__("./resources/assets/controllers/grupos/EditarMiBeneficiarioCtrl.js");


/***/ })

/******/ });