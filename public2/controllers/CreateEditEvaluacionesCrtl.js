SeriesApp.controller('CreateEditEvaluacionesCrtl', function ($scope, $routeParams, $location, $http, $timeout, base_api, $q, $filter) {
    
    $scope.title = "Evaluación de Indicadores: " + $routeParams.tipo;
    $scope.subtitle = "Evaluación";
    $scope.ev = {};
    $scope.ev.criterios = [];
    $scope.resultadosEv = [];
    $scope.modoUpdate = false;
    $scope.tipo = $routeParams.tipo;
    $scope.wizIndex = 0;
    $scope.wizTotal = 0;

    if ($routeParams.id) {
        $scope.modoUpdate = true;

        $http.get(base_api + "/admin/postevaluaciones/get/" + $scope.tipo + "/" + $routeParams.id).then(function(res) {
            $scope.ev = res.data;
            $scope.ev.id_evplazoyperiodo = res.data.fk_tbl_dv_evaluaciones_plazosyperiodos.id;
            $scope.ev.periodo_inicial = res.data.fk_tbl_dv_evaluaciones_plazosyperiodos.periodo_inicial;
            $scope.ev.periodo_final = res.data.fk_tbl_dv_evaluaciones_plazosyperiodos.periodo_final;
            // console.log("ev: ", $scope.ev);

            $http.get(base_api + "/admin/postevaluaciones/getselect/TblDvCalificacionesEscala?tipo="+$scope.tipo).then(function(resCalf) {
                // console.log(resCalf);
                $scope.niveles_ev = resCalf.data;
                $scope.min = Math.min.apply(Math,$scope.niveles_ev.map(function(item){return item.numero;}));
                $scope.max = Math.max.apply(Math,$scope.niveles_ev.map(function(item){return item.numero;}));

                angular.forEach(res.data.fk_tbl_dv_evaluaciones_resultados, function(r) {
                    // this.push(key + ': ' + value);
                    // this[r.id_persona_beneficiario] = {r.id_indicador: $filter('filter')($scope.niveles_ev, {'id': r.id_calificacion})[0]};

                    if(!this[r.id_persona_beneficiario])
                        this[r.id_persona_beneficiario] = [];
                    
                    this[r.id_persona_beneficiario][r.id_indicador] = $filter('filter')($scope.niveles_ev, {'id': r.id_calificacion})[0];

                }, $scope.resultadosEv);

                // console.log($scope.resultadosEv);
            });

            $scope.grupos = [];
            $scope.grupos[0] = res.data.fk_tbl_dv_grupos;
    
            $scope.ev.grupo = $scope.ev.fk_tbl_dv_grupos;
            $scope.seleccionGrupo();

            if ($scope.tipo == 'PSICOSOCIAL') {

                $http.get(base_api + "/admin/postevaluaciones/getselect/TblDvEvplazosyperiodosXEjes?id_evplazoyperiodo="+$scope.ev.id_evplazoyperiodo).then(function(res) {
                    // console.log(res);
                    $scope.ejes_t = res.data;
                    $scope.wizTotal = $scope.ejes_t.length - 1;
                    $scope.seleccionEje($scope.wizIndex);
                });
            }
            
        });
    }
    else {
        /* $http.get(base_api + "/admin/postevaluaciones/getselect/TblDvGrupos?Auth=id_monitor").then(function(res) {
            // console.log(res);
            $scope.grupos = res.data;
        }); */

        $http.get(base_api + "/admin/postevaluaciones/get/" + $scope.tipo).then(function(res) {
            $scope.ev = res.data;
            $scope.ev.fecha = $filter('date')(new Date(), 'yyyy-MM-dd');
            $scope.ev.id_evplazoyperiodo = $scope.ev.id;
            $scope.grupos = res.data.grupos_pendientes;

            if ($scope.tipo == 'PSICOSOCIAL') {

                $http.get(base_api + "/admin/postevaluaciones/getselect/TblDvEvplazosyperiodosXEjes?id_evplazoyperiodo="+$scope.ev.id_evplazoyperiodo).then(function(res) {
                    // console.log(res);
                    $scope.ejes_t = res.data;
                    $scope.wizTotal = $scope.ejes_t.length - 1;
                    $scope.seleccionEje($scope.wizIndex);
                });
            }
        });

        $http.get(base_api + "/admin/postevaluaciones/getselect/TblDvCalificacionesEscala?tipo="+$scope.tipo).then(function(resCalf) {
            // console.log(resCalf);
            $scope.niveles_ev = resCalf.data;
            $scope.min = Math.min.apply(Math,$scope.niveles_ev.map(function(item){return item.numero;}));
            $scope.max = Math.max.apply(Math,$scope.niveles_ev.map(function(item){return item.numero;}));
        });
    }

    

    
    $scope.seleccionGrupo = function() {
        // console.log('Grupo: ',$scope.ev.grupo);
        // $scope.grupo = JSON.parse($scope.ev.grupo);
        const gr = $scope.ev.grupo;
        const mo = gr.fk_view_dv_monitores;
        $scope.ev.monitor = mo.per_mon_nombre_primero + " " + mo.per_mon_nombre_segundo + " " + mo.per_mon_apellido_primero + " " + mo.per_mon_apellido_segundo;
        $scope.ev.escenario = gr.fk_tbl_dv_escenarios.nombre_escenario;
        $scope.ev.disciplina = gr.fk_tbl_dv_disciplinas.descripcion;
        $scope.ev.nivel = gr.fk_tbl_dv_niveles.descripcion;

        $http.get(base_api + "/admin/postevaluaciones/getselect/ViewDvFichasBeneficiarios?fich_id_grupo="+gr.id).then(function(res) {
            // console.log(res);
            $scope.ev.beneficiarios = res.data;
        });

        if ($scope.tipo == 'TECNICO') {

            $http.get(base_api + "/admin/postevaluaciones/getselect/TblDvIndicadores?id_nivel="+gr.fk_tbl_dv_niveles.id+"&id_disciplina="+gr.fk_tbl_dv_disciplinas.id).then(function (res) {
                $scope.ev.indicadores = res.data;
            })
        }
    }

    $scope.seleccionEje = function(index) {
        // console.log($scope.resultadosEv);
        
        $scope.wizIndex = index;
        $scope.ev.ejeT = $scope.ejes_t[$scope.wizIndex];
        
        // $scope.ev.indicadores = $scope.ev.ejeT.fk_tbl_dv_indicadores;
        $http.get(base_api + "/admin/postevaluaciones/getselect/TblDvIndicadores?id_eje="+$scope.ev.ejeT.id_eje).then(function (res) {
            $scope.ev.indicadores = res.data;
        })
    }

    $scope.guardarEvaluacion = function(valid) {

        if (valid) {
            // console.log('Guardar');
            // console.log($scope.resultadosEv);
    
            let resultadosEvData = [];
            angular.forEach($scope.resultadosEv, function(indicadores, id_beneficiario) {
                // this.push(key + ': ' + value);
                let self = this;
                angular.forEach(indicadores, function(resultados, id_indicador) {
                    self.push({
                        'id_persona_beneficiario': id_beneficiario,
                        'id_indicador': id_indicador,
                        'id_calificacion': resultados.id
                    });
                });
            }, resultadosEvData);

            let encabezadoEvData = [{
                'id_grupo':$scope.ev.grupo.id,
                'fecha': $scope.ev.fecha,
                'id_evplazoyperiodo': $scope.ev.id_evplazoyperiodo,
            }];

            const evaluacionResultadoData = {'encabezadoEvData': encabezadoEvData, 'resultadosEvData': resultadosEvData}; 

            // console.log(evaluacionResultadoData);
    
            $http.post(base_api + "/admin/postevaluaciones/create", evaluacionResultadoData).then(function(res) {
                // console.log(res);

                if (res.data) {
                    swal("Almacenado!", "Evaluación de Indicadores guardada.", "success");
                    $scope.volver();
                }
                else{
                    swal("Error!", "Ocurrio un error al intentar guardar!, intente nuevamente...", "error");
                }
            });
    
        }

    }

    $scope.volver = function () {
        if ($scope.tipo == 'PSICOSOCIAL') {
            $location.path('/admin/postevaluacionpsicosocial');
        } else {
            $location.path('/admin/postevaluaciontecnica');
        }
    }


});
    
    
    