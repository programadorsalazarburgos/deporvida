<?php

Route::group(["prefix" => "null"], function ()
{
    Route::get('{text}', function($text)
    {
        return view('errors.503');
    });
    Route::get('/', function()
    {
        return view('errors.503');
    });

});



Route::get('/deporvida/{any}', 'SinglePageController@index')->where('any', '.*');
Route::get('/inactivacion', 'SinglePageController@inactivacion');


Route::get('/limpiar', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";

 });
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('server_processing.php', 'PostHojavidaController@example');
Route::get('pagination', function()
{
    return view('example.datatabless');
});


Route::get('hojavida/imp/{id}', 'PostHojavidaController@imp');
Route::get('documentos/update_file', 'PostHojavidaController@validar_documentos');
Route::get('borrarndorepetidos', 'PostHojavidaController@borrarndorepetidos');
Route::get('session',function(){
    if(isset(Auth::user()->id))
    {
        if(isset(Auth::user()->id))
        {
            $res= response()->json(['login'=>'start','validate'=>true]);
        }
        else
        {
            $res=response()->json(['login'=>'stop','validate'=>false]);
        }
    }
    else
    {
        $res=response()->json(['login'=>'stop','validate'=>false]);
    }
    return $res;
});
Route::get('mydata', function()
{
    echo '<pre>';
    var_dump(Auth::user());
    echo '<hr/>';
    if(isset(Auth::user()->id))
    {
        $data=App\TblDvEmpleado::where('id_usuario','=',Auth::user()->id)->get();
        if(isset($data[0]))
        {
            var_dump($data[0]);
        }
    }
    echo '</pre>';

});
//JERARQUIAS
Route::group(["prefix" => "jerarquias"], function ()
{
    Route::get('index','jerarquiasController@indexView');
    Route::get('indexData','jerarquiasController@indexData');
    Route::get('create','jerarquiasController@CreateView');
    Route::post('new/save','jerarquiasController@CreateSave');
});
//JERARQUIAS


//NOVEDADES

Route::get('novedad/accidentelaboral',   'NovedadController@accidentelaboral');
Route::get('novedades/index',   'NovedadController@index');
Route::get('novedad/registro{id}',   'NovedadController@novedades_monitor_metodologo');
Route::get('novedades/new', 'NovedadController@new_novedad');
Route::get('novedad/metodologos', 'NovedadController@novedades_de_monitores');
Route::get('novedad/metodologos2', 'NovedadController@novedades_de_monitores2');


Route::get('novedad/listmonitor', 'NovedadController@show_novedad_metodologo')->middleware('permission:novedades_mis_monitores');
Route::get('novedad/listmonitores', 'NovedadController@show_novedad_metodologos');
Route::get('Novedades/misnovedades','NovedadController@misnovedades');
Route::get('Novedades/reporte','NovedadController@ReporteImp');
Route::get('notifi/load','NovedadController@noticicaciones_metodologo');
Route::get('monitores','NovedadController@mismonitores');
Route::post('novedad/save', 'NovedadController@guardar');
Route::post('novedad/misgrupos', 'NovedadController@MisGrupos');
Route::post('novedad/informesave', 'NovedadController@reportessave');
Route::get('novedad/accidente/{id}', 'NovedadController@informaccidente');


//NOVEDADES

//REASIGNAR COMUNAS
Route::get('metodologos/reasignar', 'PostRolesController@reasignar')->middleware('permission:reasignar-metodologos');
Route::get('metodologos/data', 'PostRolesController@data_comunas_metodologo')->middleware('permission:reasignar-metodologos');
Route::post('reasignar/change', 'PostRolesController@cambiar')->middleware('permission:reasignar-metodologos');
//REASIGNAR COMUNAS
//============================SESSIONES============================
//Route::get('logout', 'TokenAuthController@logout');
Route::post('size', 'filesController@size');
//============================SESSIONES============================

//===========================MIS DOCUMENTOS========================
Route::get('documentos/index', 'filesController@mis_documentos');
Route::get('documentos/finder', 'filesController@data_finder');
Route::get('documentos/archivos', 'filesController@archivos');
//===========================MIS DOCUMENTOS========================

//=========================GEOREFERENCIACION=======================
Route::get('georreferenciacion/index', 'PostGeoreferenciacionController@index');
Route::get('georreferenciacion/datamap', 'PostGeoreferenciacionController@map');
Route::get('georreferenciacion/comunas/{id}', 'PostGeoreferenciacionController@comuna');


Route::get('georreferenciacion/comunasescenario/{id}', 'PostGeoreferenciacionController@ComunasEscenario');
Route::get('georreferenciacion/comunasxescenario/{id}', 'PostGeoreferenciacionController@ComunasxEscenario');



Route::get('georreferenciacion/comunasdisciplinas/{id}', 'PostGeoreferenciacionController@ComunasDisciplinas');

Route::get('beneficiarios/escenario/{id}', 'PostBeneficiariosController@beneficiario_x_escenario');

//=========================GEOREFERENCIACION=======================

//================================CDP==============================
Route::get('cdp/all','PostDCPController@allview');
Route::get('cdp/allCDP','PostDCPController@alldata');
Route::post('cdp/changeestado','PostDCPController@cambiarestado');
Route::get('cdp/imp/{id}', function () {  return view('cdp.imp');})->middleware('permission:cdp');
Route::get('cdp/carga', function () {  return view('cdp.load');})->middleware('permission:cdp');
Route::get('cdp/data', 'PostDCPController@index')->middleware('permission:cdp');
Route::get('cdp/index', 'PostDCPController@data')->middleware('permission:cdp');
Route::get('cdp/data_contratos', 'PostDCPController@data_contratos')->middleware('permission:cdp');
Route::get('cpd/new', 'PostDCPController@newcdp')->middleware('permission:cdp');
// Route::get('cpd/list', 'PostDCPController@miscuentas')->middleware('permission:cdp');
Route::get('cpd/list', 'PostDCPController@miscuentas');
Route::get('cpd/miscuentas', 'PostDCPController@dataMisCuentas');
Route::get('cdp/editar/{id}', 'PostDCPController@editarCuentaCobro')->middleware('permission:cdp');
Route::get('cdp/fotodelete', 'PostDCPController@fotodelete')->middleware('permission:cdp');

Route::get('cpd/cuentascobro', 'PostDCPController@todascuentas')->middleware('permission:cdp');
Route::get('cpd/allcuentascobro/{id_cuota_estado}', 'PostDCPController@revisarCuentasCobros')->middleware('permission:cdp');
Route::get('php/info', 'PostDCPController@phpini');
Route::get('php/hora', function(){echo date('Y-m-d H:i:s');});

Route::post('cdp/editar_empleado', 'PostDCPController@editar')->middleware('permission:cdp');
Route::post('cdp/loaddata', 'PostDCPController@load')->middleware('permission:cdp');
Route::post('cdp/validatedata', 'PostDCPController@Validar')->middleware('permission:cdp');
Route::post('cdp/savecuentacobro', 'PostDCPController@savecuentacobro')->middleware('permission:cdp');
Route::post('cdp/orderdata', 'PostDCPController@orderdata')->middleware('permission:cdp');
Route::post('cdp/savecontratos', 'PostDCPController@saveContratos')->middleware('permission:cdp');



Route::get('grupos/dias/{id}','PostDCPController@cdp1')->middleware('permission:cdp');

Route::get('cdp/inf1/{id}','PostDCPController@cdp1')->middleware('permission:cdp');
Route::get('cdp/inf2/{id}','PostDCPController@cdp2')->middleware('permission:cdp');
Route::get('cdp/inf3/{id}','PostDCPController@cdp3')->middleware('permission:cdp');

Route::get('cdp/editinf1/{id}','PostDCPController@editcdp1')->middleware('permission:cdp');
Route::get('cdp/editinf2/{id}','PostDCPController@editcdp2')->middleware('permission:cdp');
Route::get('cdp/editinf3/{id}','PostDCPController@editcdp3')->middleware('permission:cdp');


//================================CDP==============================

//DISCIPLINAS
Route::get('disciplinas/index',				'PostDisciplinasController@index')
->middleware('permission:ver-disciplinas');

Route::get('disciplinas/disciplinas',		'PostDisciplinasController@listado')
->middleware('permission:ver-disciplinas');

Route::get('disciplinas/crear',         	'PostDisciplinasController@create')->middleware('permission:ver-disciplinas');

Route::get('disciplinas/editar/{id}',   	'PostDisciplinasController@editar')
->middleware('permission:ver-disciplinas');

Route::post('disciplinas/editar_registro',  'PostDisciplinasController@editar_registro')
->middleware('permission:ver-disciplinas');

Route::post('disciplinas/nuevo_registro',   'PostDisciplinasController@nuevo_registro')
->middleware('permission:ver-disciplinas');

Route::get('disciplinas/borrar/{id}',      'PostDisciplinasController@borrar')
->middleware('permission:ver-disciplinas');



//INSTITUCIONES EDUCATIVAS
Route::get('institucioneseducativas/index',         'PostInstitucionesEducativasController@index')->middleware('permission:ver-instituciones');
Route::get('institucioneseducativas/instituciones', 'PostInstitucionesEducativasController@listado')->middleware('permission:ver-instituciones');
Route::get('institucioneseducativas/crear',         'PostInstitucionesEducativasController@create')->middleware('permission:ver-instituciones');
Route::get('institucioneseducativas/editar/{id}',   'PostInstitucionesEducativasController@editar')->middleware('permission:ver-instituciones');
Route::post('institucioneseducativas/editar_registro',  'PostInstitucionesEducativasController@editar_instituciones')->middleware('permission:ver-instituciones');
Route::post('institucioneseducativas/nuevo_registro',   'PostInstitucionesEducativasController@nuevo_registro')->middleware('permission:ver-instituciones');
Route::post('institucioneseducativas/name',             'PostInstitucionesEducativasController@datos')->middleware('permission:ver-instituciones');
Route::post('institucioneseducativas/change_name',      'PostInstitucionesEducativasController@combinar_nombres')->middleware('permission:ver-instituciones');





//=================================================================






Route::get('file/searchfiles', 'filesController@elfinder');

Route::get('file/search/{id}', 'PostHojavidaController@filemanager');
Route::post('personal/saveobservaciones', 'PostHojavidaController@saveobservaciones');
Route::get('personal/datos', 'HomeController@fichaempleado');
Route::get('personal/hojavida', 'PostHojavidaController@vista');
Route::get('personal/mihojavida', 'PostHojavidaController@mihojavida');
Route::get('personal/index', 'PostHojavidaController@listado')->middleware('permission:hojavida-list');
Route::get('personal/listado', 'PostHojavidaController@index');
Route::get('personal/verhojavida/{id}', 'PostHojavidaController@view_hojavida')->middleware('permission:hojavida-list');
Route::post('personal/savehv', 'PostHojavidaController@save');
Route::post('personal/file_delete', 'PostHojavidaController@deletefile'); #Borrar archivos
Route::post('hoja_vida/borrar', 'PostHojavidaController@delete');



//============================================================================
//Inicio Eps

Route::get('admin/posteps', 'PostEpsController@vista');
Route::get('/api/v0/admin/posteps/{id}', 'PostEpsController@ObtenerEps');
Route::post('eps_data', 'PostEpsController@eps_regimen');
Route::post('/api/v0/posteps/create', 'PostEpsController@CrearEps');
Route::post('/api/v0/posteps/editarEps/{id}', 'PostEpsController@EditarEps');
Route::post('/api/v0/eliminar/eps/{id}', 'PostEpsController@EliminarEps');

Route::get('index-eps', function () {
  return view('posteps.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/posteps", "PostEpsController@index");
});
Route::get('create-eps', function () {
  return view('posteps.create');
});

Route::get('editar-eps', function () {
  return view('posteps.editar');
});

//Fin Eps
//============================================================================





















//CAMILO
//Planeacion
Route::get('/Horarios/planeacion/{id}', 'PostHorariosController@imprimirPlanificacion'); //Editar por id
//Route::get('/planificacionesall', 'PostHorariosController@actualizarhorasplanificacion'); //Editar por id
Route::get('/Horarios1/planeacion/{id}', 'PostHorariosController@imprimirPlanificacion1'); //copia
Route::get('/Horarios/planeacionestotal/{fi}/{ff}', 'PostHorariosController@todasplaneaciones')->middleware('permission:ver-planificaciones'); //Editar por id
Route::get('/Horarios/planeaciones', 'PostHorariosController@planeaciones')->middleware('permission:ver-planificaciones'); //Editar por id

Route::post('/error/notificar', 'PostErrorController@notificar'); //Editar por id
Route::get('/error/listar', 'PostErrorController@listar'); //Editar por id
Route::get('/error/ver/{id}', 'PostErrorController@ver'); //Editar por id
Route::get('/Horarios/MisAsistencias', 'PostHorariosController@MisAsistencias'); //Editar por id


Route::get('/Horarios/informeasistencias', 'PostAsistencias@AsistenciasView')->middleware('permission:informeasistencias'); //Editar por id
Route::get('/Horarios/informeasistenciasajax', 'PostAsistencias@AsistenciasMesAjax')->middleware('permission:informeasistencias'); //Editar por id
Route::get('/Horarios/MisAsistencia/{fi}/{ff}', 'PostHorariosController@AsistenciasMonitor'); //Editar por id

Route::get('/Horario/eliminar/{id}', 'PostHorariosController@EliminarPlanificacion'); //Editar por id
//Cambiar mi contraseña
Route::get('/usuario/cambiar', 'PostPersonalController@cambiarmipass'); //Crear desde administrador
Route::post('/usuario/passguardar', 'PostPersonalController@savecambiarmipass'); //Crear desde administrador
//ficha empleado
Route::get('/postusuarios/create', 'PostPersonalController@CrearUsuario')->middleware('permission:crear-usuarios'); //Crear desde administrador
Route::get('/veredas/corregimiento/{id}', 'PostPersonalController@VercorregimientoXVereda'); //Editar por id
Route::get('personal/create', 'PostPersonalController@vista'); //CREAR la ficha desde el empleado sin loguearse
Route::get("/", "HomeController@vista"); //Si no existe que actualice
Route::get('postusuarios/editar/{id}', 'PostPersonalController@EditarUsuario'); //Editar por id
//Personal
Route::get('universidades/get', 'PostPersonalController@universidades');
Route::get('carreras/get', 'PostPersonalController@carreras');
Route::post('personal/save', 'PostPersonalController@guardarPersonal');
Route::post('personal/validate_doc', 'PostPersonalController@BuscarPorCC');
Route::post('personal/save_user', 'PostPersonalController@guardarPersonal_usuario');
Route::post('personal/search', 'PostPersonalController@BuscarPersonal');
Route::get('documento/tipos', 'PostPersonalController@documento_tipo');
Route::post('/user/validaremail', 'PostPersonalController@BuscarEmailUsuario');
Route::post('/asignar/roles', 'PostPersonalController@Asignar_roles');
Route::get('/postusuarios/asignar', 'PostPersonalController@Asignar');
Route::get('create-usuarios', function ()
{
    return view('postusuarios.create');
});
//Personal
//Asistencias
Route::get('/Asistencias/beneficiarios/{id_grupo}', 'PostAsistencias@VerAsistencias');
Route::get('/Asistencias/imprimir/{id_grupo}', 'PostAsistencias@imprimirasistencia');



//GRUPOS
Route::get('grupos/grupodia','PostDCPController@grupodia');
Route::get('grupos/dias/{id_grupo}/{mes}/{id_comuna}','PostDCPController@informedias');

Route::get('obtener/grupos','PostDCPController@obtener_grupos');
Route::get('obtener/monitores/{comuna}','PostDCPController@obtener_monitores');
Route::get('obtener/grupos_monitor/{monitor}','PostDCPController@obtener_grupos_monitores');

Route::get('grupos/dia/{mes}','PostDCPController@VerClasesMes');
Route::get('grupos/create', 'PostGruposController@IniciarCrearGrupo');
Route::get('codigo_grupo/generate', 'config@generate');
Route::get('roles/misroles', 'config@roles');
Route::post('grupos/ajaxcreate', 'PostGruposController@CrearGrupo');
Route::get('grupos/ProximaSemana', 'PostGruposController@SemanaPlaneacion');
Route::get('grupos/editando/{id}', 'PostGruposController@editarView');
Route::get('grupos/view_grupos/{id}', 'PostGruposController@view_grupos');
Route::post('grupos/ajaxedit', 'PostGruposController@editsave');
Route::post('grupos/DiasTrabajo', 'PostGruposController@DiasSemana');
Route::post('escenarios/equipamiento', 'PostGruposController@equipamientodeescenario');
Route::post('save/editar-escenario', 'PostEscenariosController@editarescenario');
Route::get('grupos/eliminar/{id}', 'PostGruposController@Desactivar');

//grupos
//Ubicaciones
Route::post('ubicacion/departamentos', 'PostUbicaciones@VerDepartamentos');
Route::post('ubicacion/municipios', 'PostUbicaciones@VerMunicipios');
//Ubicaciones
//Asistencias
Route::get('Horarios/planificacion/{id}', 'PostHorariosController@editPlanificacion');
Route::get('Horarios/newplanificacion', 'PostHorariosController@createPlanificacion')->middleware('permission:crear-planificacion');
Route::get('Horarios/misplanificaciones', 'PostHorariosController@misplanificaciones');
Route::get('Horarios/index', 'PostHorariosController@index');
Route::get('Horarios/AsignarAsistencias', 'PostHorariosController@ViewAsistencia')->middleware('permission:crear-asistencias');
Route::get('Horarios/Asistencias', 'PostHorariosController@ListAsistencia');
Route::get('Horarios/Asistencia', 'PostHorariosController@ListAsistenciaMetodologo');
Route::get('Metodologos/monitores_grupos', 'PostHorariosController@monitores_grupos');
Route::post('Horarios/Beneficiarios', 'PostHorariosController@Beneficiarios');
Route::post('Horarios/SaveBeneficiarios', 'PostHorariosController@SaveBeneficiarios');
Route::post('Horarios/Saveplanificacion', 'PostHorariosController@SavePlanificacion');
Route::post('Horarios/SaveEditPlanificacion', 'PostHorariosController@SaveEditPlanificacion');
Route::post('Horarios/FechasGrupos', 'PostHorariosController@viewfechasgrupo');

//Asistencias


Route::get('roles/class', 'PostRolesController@verroles');
Route::get('beneficiario/desvincular', 'PostBeneficiariosController@desactivar');

//CAMILO




//Route::get("/", "HomeController@index");
Route::get('items', 'ItemController@index');
Route::get('items/export', 'ItemController@export');

Route::get('index-sider', function ()
{
    return view('postsider.index');
});
Route::get('descripcion-programas', function ()
{
    return view('postsider.descripcion');
});
Route::get('/api/v0/programas', 'HomeController@ObtenerProgramas');
Route::get('/api/v0/{id}', 'HomeController@DescripcionPrograma');
Auth::routes();


//Inicio Roles y Permisos

Route::get('admin/postroles', 'PostRolesController@vista')->middleware('permission:ver-roles');
Route::get('index-roles', function ()
{
    return view('postroles.index');
});
Route::group(["prefix" => "api/v0"], function ()
{
    Route::get("admin/postroles", "PostRolesController@index");
});
Route::get('permisos-roles', function ()
{
    return view('postroles.permisos');
})->middleware('permission:ver-roles');
Route::get('twinList', function ()
{
    return view('postroles.twinList');
});
Route::get('/api/v0/admin/postroles/{id}', 'PostRolesController@ObtenerRol');
Route::get('/api/v0/ObtenerPermisos/Rol/{id}', 'PostRolesController@ObtenerPermisosId');
Route::get('/api/v0/ObtenerPermisos/Rol/', 'PostRolesController@ObtenerPermisosTotal');
Route::post('/creacionpermisos/rol/{id}', 'PostRolesController@CrearPermisosRole');
Route::post('/eliminarpermisos/rol/{id}', 'PostRolesController@EliminarPermisosRole');
Route::post('/api/v0/guardar/rol', 'PostRolesController@CrearRol');
Route::post('/api/v0/eliminar/rol/{id}', 'PostRolesController@EliminarRol');

//Fin Roles y Permisos
//Inicio Usuario

Route::get('admin/postusuarios', 'PostUsuariosController@vista')->middleware('permission:ver-usuarios');

Route::get('index-usuarios', function ()
{
    return view('postusuarios.index')->with(['permisos' => \App\Role::orderBy('name')->get()]);
}); //->middleware('permission:ver-usuarios');
Route::group(["prefix" => "api/v0"], function ()
{
    Route::get("admin/postusuarios", "PostUsuariosController@index");
});
Route::get('editar-usuarios', function ()
{
    return view('postusuarios.editar');
})->middleware('permission:editar-usuarios');
Route::get('mostrar-usuarios', function ()
{
    return view('postusuarios.mostrar');
});
Route::get('cambiar-clave', function ()
{
    return view('postusuarios.resetear');
});
Route::get('/api/v0/obtenerselect/roles/', 'PostUsuariosController@ObtenerRoles');
Route::post('/api/v0/guardar/usuario', 'PostUsuariosController@CrearUsuario');
Route::get('/api/v0/admin/postusuarios/{id}', 'PostUsuariosController@ObtenerUsuario');
Route::get('/api/v0/obtenerselect/rol/{id}', 'PostUsuariosController@ObtenerRolID');
Route::post('/api/v0/actualizar/usuario/{id}', 'PostUsuariosController@ActualizarUsuario');
Route::post('/api/v0/actualizar/clave/{id}', 'PostUsuariosController@ActualizarClave');
Route::post('/api/v0/eliminar/usuario/{id}', 'PostUsuariosController@EliminarUsuario');
Route::get('/api/v0/verificar/correo_usuario', 'PostUsuariosController@CorreoUsuario');
Route::get('/api/v0/verificar/documento_usuario/{id}', 'PostUsuariosController@DocumentoUsuario');
Route::get('/api/v0/obtener/tipodocumento_usuario/{id}', 'PostUsuariosController@ObtenerTipoDocumento');



//Fin Usuarios
//Inicio Programas

Route::get('admin/postprogramas', 'PostProgramasController@vista');
Route::get('index-programas', function ()
{
    return view('postprogramas.index');
});
Route::group(["prefix" => "api/v0"], function ()
{
    Route::get("admin/postprogramas", "PostProgramasController@index");
});
Route::get('create-programas', function ()
{
    return view('postprogramas.create');
});
Route::get('editar-programas', function ()
{
    return view('postprogramas.editar');
});
Route::post('/api/v0/postprograma/create', 'PostProgramasController@CrearPrograma');
Route::get('/api/v0/admin/postprogramas/{id}', 'PostProgramasController@ObtenerPrograma');
Route::post('/api/v0/postprogramas/editarPrograma/{id}', 'PostProgramasController@EditarPrograma');
Route::post('/api/v0/eliminar/programa/{id}', 'PostProgramasController@EliminarPrograma');
//Fin Programas
//Inicio Zonas

Route::get('admin/postzonas', 'PostZonasController@vista');
Route::get('index-zonas', function ()
{
    return view('postzonas.index');
});
Route::group(["prefix" => "api/v0"], function ()
{
    Route::get("admin/postzonas", "PostZonasController@index");
});
Route::get('create-zonas', function ()
{
    return view('postzonas.create');
});

Route::get('editar-zonas', function ()
{
    return view('postzonas.editar');
});
Route::post('/api/v0/postzona/create', 'PostZonasController@CrearZona');
Route::get('/api/v0/admin/postzonas/{id}', 'PostZonasController@ObtenerZona');
Route::post('/api/v0/postzonas/editarZona/{id}', 'PostZonasController@EditarZona');
Route::post('/api/v0/eliminar/zona/{id}', 'PostZonasController@EliminarZona');
//Fin Zonas
//Inicio Comunas

Route::get('admin/postcomunas', 'PostComunasController@vista');
Route::get('index-comunas', function ()
{
    return view('postcomunas.index');
});
Route::group(["prefix" => "api/v0"], function ()
{
    Route::get("admin/postcomunas", "PostComunasController@index");
});
Route::get('create-comunas', function ()
{
    return view('postcomunas.create');
});
Route::get('editar-comunas', function ()
{
    return view('postcomunas.editar');
});
Route::post('/api/v0/postcomuna/create', 'PostComunasController@CrearComuna');
Route::get('/api/v0/admin/postcomunas/{id}', 'PostComunasController@ObtenerComuna');
Route::post('/api/v0/postcomunas/editarComuna/{id}', 'PostComunasController@EditarComuna');
Route::post('/api/v0/eliminar/comuna/{id}', 'PostComunasController@EliminarComuna');
Route::get('/api/v0/obtenerselect/zonas/', 'PostComunasController@ObtenerZonas');
Route::get('/api/v0/obtenerselect/zona/{id}', 'PostComunasController@ObtenerZonaID');
//Fin Comunas
//Inicio Barrios

Route::get('admin/postbarrios', 'PostBarriosController@vista');
Route::get('index-barrios', function ()
{
    return view('postbarrios.index');
});
Route::group(["prefix" => "api/v0"], function ()
{
    Route::get("admin/postbarrios", "PostBarriosController@index");
});
Route::get('create-barrios', function ()
{
    return view('postbarrios.create');
});
Route::get('editar-barrios', function ()
{
    return view('postbarrios.editar');
});
Route::post('/api/v0/postbarrio/create', 'PostBarriosController@CrearBarrio');
Route::get('/api/v0/admin/postbarrios/{id}', 'PostBarriosController@ObtenerBarrio');
Route::post('/api/v0/postbarrios/editarBarrio/{id}', 'PostBarriosController@EditarBarrio');
Route::post('/api/v0/eliminar/barrio/{id}', 'PostBarriosController@EliminarBarrio');
Route::get('/api/v0/obtenerselect/comunas/', 'PostBarriosController@ObtenerComunas');
Route::get('/api/v0/obtenerselect/comuna/{id}', 'PostBarriosController@ObtenerComunaID');

//Fin Barrios
//Inicio Instituciones

Route::get('admin/postinstituciones', 'PostInstitucionesController@vista');
Route::get('index-instituciones', function ()
{
    return view('postinstituciones.index');
});
Route::group(["prefix" => "api/v0"], function ()
{
    Route::get("admin/postinstituciones", "PostInstitucionesController@index");
});
Route::get('create-instituciones', function ()
{
    return view('postinstituciones.create');
});
Route::get('editar-instituciones', function ()
{
    return view('postinstituciones.editar');
});
Route::post('/api/v0/postinstitucion/create', 'PostInstitucionesController@CrearInstitucion');
Route::get('/api/v0/admin/postinstituciones/{id}', 'PostInstitucionesController@ObtenerInstitucionId');
Route::post('/api/v0/postinstituciones/editarInstitucion/{id}', 'PostInstitucionesController@EditarInstitucion');
Route::get('/api/v0/obtenerselect/barrios/', 'PostInstitucionesController@ObtenerBarrios');
Route::get('/api/v0/obtenerselect/barrio/{id}', 'PostInstitucionesController@ObtenerBarrioID');
Route::post('/api/v0/eliminar/institucion/{id}', 'PostInstitucionesController@EliminarInstitucion');
Route::get('/api/v0/obtenerselect/barrios/{id}', 'PostInstitucionesController@obtenerbarriosID');
Route::get('/api/v0/obtenerselect/comunabarrio/{id}', 'PostInstitucionesController@obtenerBarrioComunaID');

//Fin Instituciones
//Inicio Sede

Route::get('admin/postsedes', 'PostSedesController@vista');
Route::get('index-sedes', function ()
{
    return view('postsedes.index');
});
Route::group(["prefix" => "api/v0"], function ()
{
    Route::get("admin/postsedes", "PostSedesController@index");
});
Route::get('create-sedes', function ()
{
    return view('postsedes.create');
});
Route::get('editar-sedes', function ()
{
    return view('postsedes.editar');
});
Route::post('/api/v0/postsede/create', 'PostSedesController@CrearSede');
Route::get('/api/v0/admin/postsedes/{id}', 'PostSedesController@ObtenerSede');
Route::post('/api/v0/postsedes/editarSede/{id}', 'PostSedesController@EditarSede');
Route::post('/api/v0/eliminar/sede/{id}', 'PostSedesController@EliminarSede');
Route::get('/api/v0/obtenerselect/instituciones/', 'PostSedesController@ObtenerInstituciones');
Route::get('/api/v0/obtenerselect/institucion/{id}', 'PostSedesController@ObtenerInstitucionID');
//Fin Sede
//Inicio Tipo Escenario

Route::get('admin/posttipoescenarios', 'PostTipoEscenariosController@vista');
Route::get('index-tipoescenarios', function ()
{
    return view('posttipoescenarios.index');
});
Route::group(["prefix" => "api/v0"], function ()
{
    Route::get("admin/posttipoescenarios", "PostTipoEscenariosController@index");
});
Route::get('create-tipoescenarios', function ()
{
    return view('posttipoescenarios.create');
});
Route::get('editar-tipoescenarios', function ()
{
    return view('posttipoescenarios.editar');
});
Route::get('/admin/posttipoescenarios/create',function()
{
    return view('posttipoescenarios.create');
});

Route::post('/api/v0/posttipoescenario/create/', 'PostTipoEscenariosController@CrearTipoEscenario');
Route::get('/api/v0/admin/posttipoescenarios/{id}', 'PostTipoEscenariosController@ObtenerTipoEscenario');
Route::post('/api/v0/posttipoescenarios/editarTipoEscenario/{id}', 'PostTipoEscenariosController@EditarTipoEscenario');
Route::post('/api/v0/eliminar/tipoescenario/{id}', 'PostTipoEscenariosController@EliminarTipoEscenario');
//Fin Tipo Escenario
//Inicio Escenario
Route::get('admin/postescenarios/editando/{id}', 'PostEscenariosController@editar');
Route::get('admin/postescenarios', 'PostEscenariosController@vista');
Route::get('index-escenarios', function ()
{
    return view('postescenarios.index');
})->middleware('permission:ver-escenarios');
Route::group(["prefix" => "api/v0"], function ()
{
    Route::get("admin/postescenarios", "PostEscenariosController@index");
});
Route::get('editar-escenarios', function ()
{
    return view('postescenarios.editar2')->with(['corregimiento' => \App\TblGenCorregimiento::orderBy('descripcion')->get()]);
})->middleware('permission:editar-escenarios');
Route::get('create-escenarios', function ()
{
    return view('postescenarios.create')->with(['corregimiento' => \App\TblGenCorregimiento::orderBy('descripcion')->get()]);
})->middleware('permission:crear-escenarios');

Route::get('/api/v0/postescenario/create', 'PostEscenariosController@CrearEscenario');
Route::get('/api/v0/admin/postescenarios/{id}', 'PostEscenariosController@ObtenerEscenario');
Route::post('/api/v0/postescenarios/EditarEscenario/{id}', 'PostEscenariosController@EditarEscenario');
Route::post('/api/v0/eliminar/escenario/{id}', 'PostEscenariosController@EliminarEscenario');
Route::get('/api/v0/obtenerselect/tipoescenarios/', 'PostEscenariosController@ObtenerTipoEscenarios');
Route::get('tipoesequipamientos', 'PostEscenariosController@ObtenerTipoEquipamientos');

Route::get('/api/v0/obtenerselect/tipoescenario/{id}', 'PostEscenariosController@ObtenerTipoEscenarioID');
Route::get('/api/v0/datostipoescenraio/search/{id}', 'PostEscenariosController@ObtenerDatosTipoEscenarioID');
Route::get('/api/v0/obtenerselect/sedes/', 'PostEscenariosController@ObtenerSedes');
Route::get('/api/v0/obtenerselect/sede/{id}', 'PostEscenariosController@ObtenerSedeID');
//Fin Escenario
//Inicio Grupos

Route::get('admin/postgrupos', 'PostGruposController@vista');
Route::get('index-grupos', function ()
{
    return view('postgrupos.index');
});
Route::group(["prefix" => "api/v0"], function ()
{
    Route::get("admin/postgrupos", "PostGruposController@index");
});
Route::get('create-grupos', function ()
{
    return view('postgrupos.create');
});
Route::get('editar-grupos', function ()
{
    return view('postgrupos.editar');
});
Route::get('beneficiario-grupos', function ()
{
    return view('postgrupos.beneficiario');
});
Route::get('misbeneficiarios-grupos', function ()
{
    return view('postgrupos.misbeneficiarios');
});

Route::get('editar-mibeneficiario', function ()
{
    return view('postgrupos.editarmibeneficiario');
});

Route::get('/api/v0/obtenercount/grupos', 'PostGruposController@ObtenerCountGrupos');
Route::get('/api/v0/obtenerusuario/monitor', 'PostGruposController@ObtenerMonitor');
Route::post('/api/v0/postgrupo/create', 'PostGruposController@CrearGrupo');
Route::get('/api/v0/admin/postgrupos/{id}', 'PostGruposController@ObtenerGrupo');
Route::get('/api/v0/obtenerselect/SedeGrupo/{id}', 'PostGruposController@ObtenerSedeGrupoID');
Route::get('/api/v0/obtener/GrupoHorario/{id}', 'PostGruposController@ObtenerGrupoHorarioID');
Route::get('/api/v0/obtener/programas', 'PostGruposController@ObtenerProgramas');
Route::get('/api/v0/obtener/paises', 'PostGruposController@ObtenerPaises');
Route::get('/api/v0/obtener/departamentos/{id}', 'PostGruposController@ObtenerDepartamentos');
Route::get('/api/v0/obtener/municipios/{id}', 'PostGruposController@ObtenerMunicipios');
Route::get('/api/v0/obtener/barrios/{id}', 'PostGruposController@ObtenerBarrios');
Route::post('/api/v0/postgrupo/actualizar/{id}', 'PostGruposController@ActualizarGrupo');
Route::post('/api/v0/postbeneficiario/create/{id}', 'PostGruposController@CrearBeneficiarioGrupo');
Route::get('/api/v0/obtener/misbeneficiarios/{id}', 'PostGruposController@ObtenerMisBeneficiarios');
Route::get('/api/v0/obtener/allgruposmonitor', 'PostGruposController@ObtenerAllGrupos');
Route::get('/api/v0/obtener/motivos', 'PostGruposController@motivos');
Route::post('/api/v0/eliminar/grupo_monitor/{id}', 'PostGruposController@EliminarGrupo');




Route::get('/api/v0/obtener/monitores', 'PostGruposController@Obtenermonitores'); //Opcional
//Fin Grupos
//Inicio Beneficiarios

Route::get('admin/postbeneficiarios', 'PostBeneficiariosController@vista');
Route::get('index-beneficiarios', function ()
{
    return view('postbeneficiarios.index');
});
Route::group(["prefix" => "api/v0"], function ()
{
    Route::get("admin/postbeneficiarios", "PostBeneficiariosController@index");
});
Route::post('persona/search', 'PostBeneficiariosController@searchficha');
Route::post('ficha/create', 'PostBeneficiariosController@savebeneficiarios');
Route::post('ficha/editar', 'PostBeneficiariosController@editarbeneficiarios');
Route::get('barrios/listado', 'PostEscenariosController@ListarBarrios');

Route::get('beneficiarios/create/{id}', 'PostBeneficiariosController@registro2')->middleware('permission:crear-beneficiarios');
Route::get('beneficiarios/editar/{id}', 'PostBeneficiariosController@editarregistro')->middleware('permission:crear-beneficiarios');
Route::get('ficha/registrar/{id}', 'PostBeneficiariosController@datos_ficha')->middleware('permission:crear-beneficiarios');
Route::get('postbeneficiarios/beneficiario-grupos', function ()
{
    return view('postgrupos.beneficiario');
});


Route::get('editar-beneficiarios', function ()
{
    return view('postbeneficiarios.editar');
});
//Route::post('/api/v0/postbeneficiario/create', 'PostBeneficiariosController@CrearBeneficiario');


Route::get('beneficiario/{id_ficha}','PostBeneficiariosController@detalle_ficha_beneficiario');


Route::get('/api/v0/admin/postbeneficiarios/{id}', 'PostBeneficiariosController@ObtenerBeneficiario');


Route::get('/api/v0/obtener/programa/{id}', 'PostBeneficiariosController@ObtenerPrograma');
Route::get('/api/v0/obtener/pais/{id}', 'PostBeneficiariosController@ObtenerPais');
Route::get('/api/v0/obtener/departamento/{id}', 'PostBeneficiariosController@ObtenerDepartamento');
Route::get('/api/v0/obtener/municipio/{id}', 'PostBeneficiariosController@ObtenerMunicipio');
Route::get('/api/v0/obtener/comuna/{id}', 'PostBeneficiariosController@ObtenerComuna');
Route::get('/api/v0/obtener/barrio/{id}', 'PostBeneficiariosController@ObtenerBarrio');
Route::get('/api/v0/obtener/tipodocumento/{id}', 'PostBeneficiariosController@ObtenerTipoDocumento');
Route::get('/api/v0/obtener/sexo/{id}', 'PostBeneficiariosController@ObtenerSexo');
Route::get('/api/v0/obtener/civil/{id}', 'PostBeneficiariosController@ObtenerCivil');
Route::get('/api/v0/obtener/hijos/{id}', 'PostBeneficiariosController@ObtenerHijos');
Route::get('/api/v0/obtener/tiposangre/{id}', 'PostBeneficiariosController@ObtenerTipoSangre');
Route::get('/api/v0/obtener/ocupacion/{id}', 'PostBeneficiariosController@ObtenerOcupacion');
Route::get('/api/v0/obtener/escolaridad/{id}', 'PostBeneficiariosController@ObtenerEscolaridad');
Route::get('/api/v0/obtener/cultura/{id}', 'PostBeneficiariosController@ObtenerCultura');
Route::get('/api/v0/obtener/poblacionales/{id}', 'PostBeneficiariosController@ObtenerPoblacionales');

Route::post('/api/v0/postbeneficiario/actualizar/{id}', 'PostBeneficiariosController@ActualizarBeneficiario');
Route::get('/api/v0/obtener/discapacidad/{id}', 'PostBeneficiariosController@ObtenerDiscapacidad');
Route::get('/api/v0/obtener/DiscapacidadOtra/{id}', 'PostBeneficiariosController@ObtenerDiscapacidadOtra');
Route::get('/api/v0/obtener/enfermedadpermanente/{id}', 'PostBeneficiariosController@ObtenerEnfermedad');
Route::get('/api/v0/obtener/medicamentopermanente/{id}', 'PostBeneficiariosController@ObtenerMedicamento');


Route::get('/api/v0/obtener/seguridadsocial/{id}', 'PostBeneficiariosController@ObtenerSeguridadSocial');
Route::get('/api/v0/obtener/saludsgss/{id}', 'PostBeneficiariosController@ObtenerSaludSgss');
Route::get('/api/v0/obtener/documentoacudiente/{id}', 'PostBeneficiariosController@ObtenerDocAcudiente');
Route::get('/api/v0/obtener/sexo_acudiente/{id}', 'PostBeneficiariosController@ObtenerSexAcudiente');
Route::get('/api/v0/obtener/parentesco/{id}', 'PostBeneficiariosController@ObtenerParentescoAcudiente');
Route::post('/api/v0/eliminar/grupo/{id}', 'PostBeneficiariosController@EliminarBeneficiarioGrupo');

Route::get('/api/v0/obtener/allmonitores', 'PostBeneficiariosController@ObtenerAllMonitores');

Route::get('/api/v0/obtener/gruposmonitor/{id}', 'PostBeneficiariosController@ObtenerGruposMonitor');
Route::post('/api/v0/postbeneficiario/asociargrupo/{id}', 'PostBeneficiariosController@AsociarGrupoBeneficiario');
Route::get('/api/v0/verificar/ficha_beneficiario
', 'PostBeneficiariosController@FichaBeneficiario');
Route::get('/api/v0/verificar/no_documento_beneficiario
', 'PostBeneficiariosController@DocumentoBeneficiario');


Route::post('/api/v0/eliminar/beneficiario/{id}', 'PostBeneficiariosController@EliminarBeneficiario');

//Fin Beneficiarios
//Inicio Geolocalizacion

Route::get('admin/postlocalizacion', 'PostLocalizacionController@vista');
Route::get('index-localizacion', function ()
{
    return view('postlocalizacion.index');
});
Route::group(["prefix" => "api/v0"], function ()
{
    Route::get("admin/postlocalizacion", "PostLocalizacionController@index");
});
Route::get('index-localizacion-institucion', function ()
{
    return view('postlocalizacion.instituciones');
});
Route::get('index-localizacion-institucion-sede', function ()
{
    return view('postlocalizacion.instituciones_sedes');
});
Route::get('index-localizacion-sede-beneficiario', function ()
{
    return view('postlocalizacion.instituciones_sedes_beneficiarios');
});
Route::get('index-localizacion-beneficiario', function ()
{
    return view('postlocalizacion.beneficiario');
});
Route::get('/api/v0/admin/postlocalizacion_institucion/{id}', 'PostLocalizacionController@index');
Route::get('/api/v0/admin/postlocalizacion_instituciones/{id}', 'PostLocalizacionController@instituciones');
Route::get('/api/v0/admin/postlocalizacion_institucion_sede/{id}', 'PostLocalizacionController@sede');
Route::get('/api/v0/admin/postlocalizacion/institucion/{id}', 'PostLocalizacionController@institucion');
Route::get('/api/v0/admin/postlocalizacion_sede_beneficiarios/{id}', 'PostLocalizacionController@SedeBeneficiario');


// Reporte Ficha de Caracterizacion
Route::get('admin/postreporteficha', 'PostReporteFichaController@vista');
Route::get('index-reporte-ficha', function () {
    return view('postreporteficha.index');
});
Route::post('export/excelreporteficha', 'PostReporteFichaController@exportExcel');
Route::post('export/excelreporteficha_corta', 'PostReporteFichaController@exportExcel_corta');
Route::group(["prefix" => "api/v0"], function () {
    Route::post("admin/postreporteficha", "PostReporteFichaController@consultaTabla");
    Route::get('admin/postreporteficha/getselect/{modelo}', 'PostReporteFichaController@getDataSelect');
});

// Reporte Ficha de Caracterizacion básica
Route::get('admin/postreportefichabasica', 'PostReporteFichaController@vistabasica');
Route::get('index-reporte-ficha-basica', function () {
    return view('postreporteficha.indexbasica');
});
Route::post('export/excelreporteficha', 'PostReporteFichaController@exportExcel');
Route::group(["prefix" => "api/v0"], function () {
    Route::post("admin/postreporteficha", "PostReporteFichaController@consultaTabla");
    Route::get('getselect/{modelo}', 'PostReporteFichaController@getDataSelect');
});








// Reporte Ficha de Caracterizacion
Route::get('admin/postreporteparrilla', 'PostReporteParrillaController@vista');
Route::get('admin/postreporteparrillabasica', 'PostReporteParrillaController@vista');
Route::get('index-reporte-parrilla', function () {
    return view('postreporteparrilla.index');
});
Route::post('export/excelreporteparrilla', 'PostReporteParrillaController@exportExcel');
Route::group(["prefix" => "api/v0"], function () {
    Route::post("admin/postreporteparrilla", "PostReporteParrillaController@consultaTabla");
    Route::post("admin/postreporteparrillabasica", "PostReporteParrillaController@consultaTablaBasica");
});

// Reporteador
// Route::get('admin/reporteador', 'PostReporteadorController@test');
Route::get('admin/testmenureportes', 'PostReporteadorController@menuReportesReporteador');

Route::get('admin/postreporteador', 'PostReporteadorController@vista');
Route::get('index-reporteador', function () {
    $jasperEnv = [
        'jasperServer' => env('JASPER_SERVER_URL'),
        'jasperUser' => env('JASPER_USER'),
        'jasperPass' => env('JASPER_PASSWORD'),
        'jasperDataSource' => env('JASPER_DATASOURCE'),
        'jasperTemplateDefault' => env('JASPER_TEMPLATEDEFAULT'),
    ];
    return view('postreporteador.index', $jasperEnv);
});
Route::group(["prefix" => "api/v0"], function () {
    Route::post("admin/postnuevoreporte", "PostReporteadorController@nuevoReporte");
    Route::post("admin/posteliminarreporte", "PostReporteadorController@eliminarReporte");
});


Route::get('admin/postreporteadorvisor', 'PostReporteadorController@visor');

Route::get('visor-reporteador', function () {
    $jasperEnv = [
        'jasperServer' => env('JASPER_SERVER_URL'),
        'jasperUser' => env('JASPER_USER'),
        'jasperPass' => env('JASPER_PASSWORD'),
    ];
    return view('postreporteador.visor', $jasperEnv);
});


// Modulo Ejes Tematicos
Route::get('admin/postejestematicos', 'postEjesTematicosController@vista');

Route::group(["prefix" => "api/v0"], function () {
    Route::get("admin/postejestematicos/{id?}", "postEjesTematicosController@index");
    Route::post("admin/postejestematicos/create", "postEjesTematicosController@guardar");
    Route::delete("admin/postejestematicos/delete/{id}", "postEjesTematicosController@eliminar");
    Route::put("admin/postejestematicos/edit/{id}", "postEjesTematicosController@editar");
    Route::get('admin/postejestematicos/getselect/{modelo}', 'postEjesTematicosController@getDataSelect');
});

Route::get('index-ejestematicos', function () {
    return view('postejestematicos.index');
});
Route::get('create-edit-ejestematicos', function () {
    return view('postejestematicos.create-edit');
});

// Modulo Niveles
Route::get('admin/postniveles', 'postNivelesController@vista');

Route::group(["prefix" => "api/v0"], function () {
    Route::get("admin/postniveles/{id?}", "postNivelesController@index");
    Route::post("admin/postniveles/create", "postNivelesController@guardar");
    Route::delete("admin/postniveles/delete/{id}", "postNivelesController@eliminar");
    Route::put("admin/postniveles/edit/{id}", "postNivelesController@editar");
    // Route::get('admin/postniveles/getselect/{modelo}', 'postNivelesController@getDataSelect');
});

Route::get('index-niveles', function () {
    return view('postniveles.index');
});
Route::get('create-edit-niveles', function () {
    return view('postniveles.create-edit');
});

// Modulo Indicadores
Route::get('admin/postindicadores', 'postIndicadoresController@vista');

Route::group(["prefix" => "api/v0"], function () {
    Route::get("admin/postindicadores/get/{tipo}/{id?}", "postIndicadoresController@index");
    Route::post("admin/postindicadores/create", "postIndicadoresController@guardar");
    Route::delete("admin/postindicadores/delete/{id}", "postIndicadoresController@eliminar");
    Route::put("admin/postindicadores/edit/{id}", "postIndicadoresController@editar");
    Route::get('admin/postindicadores/getselect/{modelo}', 'postIndicadoresController@getDataSelect');
});

Route::get('index-indicadores', function () {
    return view('postindicadores.index');
});
Route::get('create-edit-indicadores', function () {
    return view('postindicadores.create-edit');
});

// Modulo Calificaciones Escala
Route::get('admin/postcalificacionesescala', 'postCalificacionesEscalaController@vista');

Route::get("panelcontrol/datos", "PanelControlController@PanelControl")->middleware('auth');
Route::get("panelcontrol/index", "PanelControlController@index")->middleware('auth');

Route::group(["prefix" => "api/v0"], function () {
    Route::get("admin/postcalificacionesescala/get/{tipo}/{id?}", "postCalificacionesEscalaController@index");
    Route::post("admin/postcalificacionesescala/create", "postCalificacionesEscalaController@guardar");
    Route::delete("admin/postcalificacionesescala/delete/{id}", "postCalificacionesEscalaController@eliminar");
    Route::put("admin/postcalificacionesescala/edit/{id}", "postCalificacionesEscalaController@editar");
    Route::get('admin/postcalificacionesescala/getselect/{modelo}', 'postCalificacionesEscalaController@getDataSelect');
});

Route::get('index-calificacionesescala', function () {
    return view('postcalificacionesescala.index');
});
Route::get('create-edit-calificacionesescala', function () {
    return view('postcalificacionesescala.create-edit');
});


// Modulo Plazos y Periodos de Evaluación
Route::get('admin/postplazosyperiodosev', 'postPlazosyPeriodosevController@vista');

Route::group(["prefix" => "api/v0"], function () {
    Route::get("admin/postplazosyperiodosev/get/{tipo}/{id?}", "postPlazosyPeriodosevController@index");
    Route::post("admin/postplazosyperiodosev/create", "postPlazosyPeriodosevController@guardar");
    Route::delete("admin/postplazosyperiodosev/delete/{id}", "postPlazosyPeriodosevController@eliminar");
    Route::put("admin/postplazosyperiodosev/edit/{id}", "postPlazosyPeriodosevController@editar");
    Route::get('admin/postplazosyperiodosev/getselect/{modelo}', 'postPlazosyPeriodosevController@getDataSelect');
});

Route::get('index-plazosyperiodosev', function () {
    return view('postplazosyperiodosev.index');
});
Route::get('create-edit-plazosyperiodosev', function () {
    return view('postplazosyperiodosev.create-edit');
});


// Modulo Evaluación Psicosocial y Tecnica
Route::get('admin/postevaluaciones', 'PostEvaluacionesController@vista');

Route::group(["prefix" => "api/v0"], function () {
    Route::get("admin/postevaluaciones/get/{tipo}/{id?}", "PostEvaluacionesController@index");

    Route::get("admin/postevaluaciones/{id?}", "PostEvaluacionesController@index");
    Route::post("admin/postevaluaciones/create", "PostEvaluacionesController@guardarResultados");
    Route::delete("admin/postevaluaciones/delete/{id}", "PostEvaluacionesController@eliminarEv");
    Route::put("admin/postevaluaciones/edit/{id}", "PostEvaluacionesController@editarEv");
    Route::get('admin/postevaluaciones/getselect/{modelo}', 'PostEvaluacionesController@getDataSelect');
});

Route::get('index-evpsicosocial', function () {
    $tipo = [
        'tipo' => 'PSICOSOCIAL'
    ];
    return view('postevaluaciones.index', $tipo);
});

Route::get('index-evtecnica', function () {
    $tipo = [
        'tipo' => 'TECNICO'
    ];
    return view('postevaluaciones.index', $tipo);
});


Route::get('create-edit-evaluacion', function () {
    return view('postevaluaciones.create-edit');
});

Route::group(["prefix" => "admin"], function () {
//Proveedores de Inventario
    Route::get('proveedor/create', "PostProveedorController@create");
    Route::get("proveedor", "PostProveedorController@index");
    Route::get("proveedor/proveedores", "PostProveedorController@getProveedores");
    Route::post("proveedor/update/{proveedor}", "PostProveedorController@saveProveedor");
    Route::post("proveedor/save", "PostProveedorController@save");
    Route::get("proveedor/{proveedor}", "PostProveedorController@show");
    Route::delete("proveedor/{proveedor}", "PostProveedorController@eliminarProveedor");
    Route::get("proveedor/editar/{proveedor}", "PostProveedorController@edit");
    //Clasificacion
    Route::get("clasificaciones", "PostClasificacionImplementosController@index");
    Route::get("clasificaciones/create", "PostClasificacionImplementosController@create");
    Route::get("clasificaciones/listar", "PostClasificacionImplementosController@listarclasificaciones");
    Route::delete("clasificaciones/{clasificacion}", "PostClasificacionImplementosController@eliminarClasificacion");
    Route::post("clasificaciones/save", "PostClasificacionImplementosController@save");
    Route::get("clasificaciones/editar/{clasificacion}", "PostClasificacionImplementosController@edit");
    Route::post("clasificaciones/update/{clasificacion}", "PostClasificacionImplementosController@update");

    //Implementos
    Route::get("implementos", "PostImplementosController@index");
    Route::get("implementos/listar", "PostImplementosController@listarImplementos");
    Route::get("implementos/create", "PostImplementosController@create");
    Route::post("implementos/save", "PostImplementosController@save");
    Route::get("implementos/editar/{implemento}", "PostImplementosController@edit");
    Route::post("implementos/update/{implemento}", "PostImplementosController@update");
    Route::delete("implementos/{implemento}", "PostImplementosController@destroy");

    //Inventario Fisico
    Route::get("inventariofisico", "PostInventarioFisicoController@index");
    Route::get("inventariofisico/listar", "PostInventarioFisicoController@listarInventario");
    Route::get("inventariofisico/create", "PostInventarioFisicoController@create");
    Route::post("inventariofisico/save", "PostInventarioFisicoController@save");
    Route::get("inventariofisico/editar/{inventario}", "PostInventarioFisicoController@edit");
    Route::get("inventariofisico/reporte/{inventario}", "PostInventarioFisicoController@reporte");
    Route::post("inventariofisico/update/{inventario}", "PostInventarioFisicoController@update");
    Route::delete("inventariofisico/{inventario}", "PostInventarioFisicoController@destroy");
    Route::get("inventariofisico/reporte_inventario", "PostInventarioFisicoController@inventarioPDF");


    //Entradas Inventario
    Route::get("entradainventario", "PostEntradaInventarioController@index");
    Route::get("entradainventario/listar", "PostEntradaInventarioController@listarEntradas");
    Route::get("entradainventario/create", "PostEntradaInventarioController@create");
    Route::get("entradainventario/listarimplementos/{categoria}", "PostEntradaInventarioController@listarNombreImplementos");
    Route::post("entradainventario/save", "PostEntradaInventarioController@save");
    Route::get("entradainventario/editar/{entrada}", "PostEntradaInventarioController@edit");
    Route::post("entradainventario/update/{entrada}", "PostEntradaInventarioController@update");
    Route::delete("entradainventario/{entrada}", "PostEntradaInventarioController@destroy");

    //Prestamos Inventario
    Route::get("prestamoinventario", "PostPrestamoInventarioController@index");
    Route::get("prestamoinventario/listar", "PostPrestamoInventarioController@listarPrestamos");
    Route::get("prestamoinventario/create", "PostPrestamoInventarioController@create");
    Route::post("prestamoinventario/save", "PostPrestamoInventarioController@save");
    Route::get("prestamoinventario/editar/{prestamo}", "PostPrestamoInventarioController@edit");
    Route::post("prestamoinventario/update/{prestamo}", "PostPrestamoInventarioController@update");
    Route::delete("prestamoinventario/{prestamo}", "PostPrestamoInventarioController@destroy");
    Route::get("prestamoinventario/cancelar/{prestamo}", "PostPrestamoInventarioController@cancelar");
    Route::get("prestamoinventario/cambiarEstado/{prestamo}/{estado}", "PostPrestamoInventarioController@cambiarEstado");
    Route::get("prestamoinventario/reporte_prestamos", "PostPrestamoInventarioController@prestamosPDF");

    //Devoluciones
    Route::get("devolucioninventario", "PostDevolucionInventarioController@index");
    Route::get("devolucioninventario/listar", "PostDevolucionInventarioController@listarDevoluciones");
    Route::get("devolucioninventario/create", "PostDevolucionInventarioController@create");
    Route::post("devolucioninventario/save", "PostDevolucionInventarioController@save");
    Route::get("devolucioninventario/editar/{devolucion}", "PostDevolucionInventarioController@edit");
    Route::post("devolucioninventario/update/{devolucion}", "PostDevolucionInventarioController@update");
    Route::delete("devolucioninventario/{devolucion}", "PostDevolucionInventarioController@destroy");
    Route::get("devolucioninventario/prestamos/{user}", "PostDevolucionInventarioController@prestamos");
    Route::get("devolucioninventario/reporte_devoluciones", "PostDevolucionInventarioController@devolucionesPDF");
});

Route::get("admin/postreporte/indicadorestecnicos", "postIndicadoresController@vistareportesindicadores");
Route::get("postreporteindicadorestecnicos",        "postIndicadoresController@datavistareportesindicadores");
Route::group(["prefix" => "evaluaciones"], function () {
    Route::get('/', "PostEvaluacioController@index");
    Route::get('/index', "PostEvaluacioController@evaluaciones");
});


Route::post('/api/v0/admin/postreporteUsuarios', 'ItemController@postreporteUsuarios');


Route::get('/obtener/comunas', 'GlobalController@obtener_comunas');
Route::get('pruebas2222', 'GlobalController@pruebas2222');
Route::get('obtener/reportemes', 'GlobalController@reportemes');
Route::get('sesiones', 'GlobalController@sesiones');
