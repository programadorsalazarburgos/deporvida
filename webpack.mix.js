const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue'],
        alias: {
            '@': __dirname + '/resources'
        }

    }
});


mix.styles([
    'resources/assets/plantilla/css/jquery-ui.css',
    'resources/assets/plantilla/css/datepicker.css',
    'resources/assets/plantilla/css/select2.css',
    'resources/assets/plantilla/css/selectize.default.css',
    'resources/assets/plantilla/vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css',
    'resources/assets/plantilla/vendors/font-awesome/css/font-awesome.min.css',
    'resources/assets/plantilla/vendors/bootstrap/css/bootstrap.min.css',
    'resources/assets/plantilla/css/bootstrap-switch.css',
    'resources/assets/plantilla/css/calendar-style.css',
    'resources/assets/plantilla/src2/css/pignose.calendar.css',
    'resources/assets/plantilla/vendors/select2/select2-madmin.css',
    'resources/assets/plantilla/vendors/bootstrap-select/bootstrap-select.min.css',
    'resources/assets/plantilla/vendors/multi-select/css/multi-select-madmin.css',
    'resources/assets/plantilla/vendors/intro.js/introjs.css',
    'resources/assets/plantilla/vendors/calendar/zabuto_calendar.min.css',
    'resources/assets/plantilla/vendors/calendar/zabuto_calendar.min.css',
    'resources/assets/plantilla/vendors/sco.message/sco.message.css',
    'resources/assets/plantilla/vendors/intro.js/introjs.css',
    'resources/assets/plantilla/vendors/DataTables/media/css/jquery.dataTables.css',
    'resources/assets/plantilla/vendors/DataTables/extensions/TableTools/css/dataTables.tableTools.min.css',
    'resources/assets/plantilla/vendors/DataTables/media/css/dataTables.bootstrap.css',
    'resources/assets/plantilla/vendors/animate.css/animate.css',
    'resources/assets/plantilla/vendors/jquery-pace/pace.css',
    'resources/assets/plantilla/vendors/iCheck/skins/all.css',
    'resources/assets/plantilla/vendors/jquery-notific8/jquery.notific8.min.css',
    'resources/assets/plantilla/vendors/bootstrap-clockface/css/clockface.css',
    'resources/assets/plantilla/vendors/bootstrap-switch/css/bootstrap-switch.css',
    'resources/assets/plantilla/css/themes/style1/orange-blue.css',
    'resources/assets/plantilla/css/themes/style1/orange-blue.css',
    'resources/assets/plantilla/css/themes/style2/orange-blue.css',
    'resources/assets/plantilla/css/style-responsive.css',
    'resources/assets/plantilla/dist/sweetalert.css',
    'resources/assets/plantilla/plugins/chosen/chosen.css',
    'resources/assets/plantilla/fullcalendar/fullcalendar.css',
    'resources/assets/plantilla/vendors/jquery-toastr/toastr.min.css',
    'resources/assets/plantilla/css/letrasmagicas.css',
    'resources/assets/plantilla/css/validationEngine.jquery.css',
    'resources/assets/plantilla/bower_components/EasyAutocomplete/dist/easy-autocomplete.min.css',
    'resources/assets/plantilla/css/ionicons.min.css',
    'resources/assets/plantilla/css/ticket.css',
    'resources/assets/plantilla/css/ng-ckeditor.css',
    'resources/assets/plantilla/css/dualmultiselect.css',
    'resources/assets/plantilla/css/sider.css',
    'resources/assets/plantilla/css/build.css',
    'resources/assets/plantilla/css/styleselect.css',
    'resources/assets/plantilla/css/estilossider.css',
    'resources/assets/plantilla/css/iphone.css',
    'resources/assets/plantilla/css/jquery-clockpicker.min.css',
    'resources/assets/plantilla/css/angular-clockpicker.css',
    'resources/assets/plantilla/css/angular-ui-switch.css',
    'resources/assets/plantilla/css/ngDatepicker.css',
    'resources/assets/plantilla/css/ios-switch.css',
    'resources/assets/plantilla/css/export.css',
    'resources/assets/plantilla/css/select2.min.css',
    'resources/assets/plantilla/css/chosen.min.css',
    'resources/assets/plantilla/css/ng-tags-input.min.css'

], 'public/css/master.css')


.scripts([

 'resources/assets/plantilla/js/jquery-1.10.2.min.js',
    'https://code.jquery.com/jquery-2.2.4.min.js',
    'resources/assets/plantilla/js/canvasjs.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.jquery.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.proto.min.js',
    'http://planeacion.cali.gov.co/saul/js/bootstrap.min.js',
    'resources/assets/plantilla/js/es-ES.js',
    'resources/assets/plantilla/lib/moment.min.js',
    'resources/assets/plantilla/vendors/moment/moment.js',
    'resources/assets/plantilla/js/jquery.latest.min.js',
    'resources/assets/plantilla/vendors/bootstrap/js/bootstrap.min.js',
    'resources/assets/plantilla/js/underscore-min.js',
    'resources/assets/plantilla/js/calendar.js',
    'resources/assets/plantilla/js/jquery-migrate-1.2.1.min.js',
    'resources/assets/plantilla/js/jquery-ui.js',
    'resources/assets/plantilla/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js',
    'resources/assets/plantilla/js/html5shiv.js',
    'resources/assets/plantilla/js/respond.min.js',
    'resources/assets/plantilla/vendors/metisMenu/jquery.metisMenu.js',
    'resources/assets/plantilla/vendors/slimScroll/jquery.slimscroll.js',
    'resources/assets/plantilla/vendors/jquery-cookie/jquery.cookie.js',
    'resources/assets/plantilla/vendors/iCheck/icheck.min.js',
    'resources/assets/plantilla/vendors/jquery-notific8/jquery.notific8.min.js',
    'resources/assets/plantilla/js/jquery.menu.js',
    'resources/assets/plantilla/vendors/jquery-pace/pace.min.js',
    'resources/assets/plantilla/vendors/holder/holder.js',
    'resources/assets/plantilla/vendors/responsive-tabs/responsive-tabs.js',
    'resources/assets/plantilla/vendors/jquery-news-ticker/jquery.newsTicker.min.js',
    'resources/assets/plantilla/vendors/moment/moment.js',
    'resources/assets/plantilla/vendors/bootstrap-daterangepicker/daterangepicker.js',
    'resources/assets/plantilla/js/main.js',
    'resources/assets/plantilla/vendors/select2/select2.min.js',
    'resources/assets/plantilla/vendors/bootstrap-select/bootstrap-select.min.js',
    'resources/assets/plantilla/vendors/multi-select/js/jquery.multi-select.js',
    'resources/assets/plantilla/js/ui-dropdown-select.js',
    'resources/assets/plantilla/js/dcalendar.picker.js',
    'resources/assets/plantilla/vendors/ckeditor/ckeditor.js',
    'resources/assets/plantilla/vendors/jquery-toastr/toastr.min.js',
    'resources/assets/plantilla/js/ui-toastr-notifications.js',
    'resources/assets/plantilla/js/jquery.latest.min.js',
    'resources/assets/plantilla/vendors/bootstrap/js/bootstrap.min.js',
    'resources/assets/plantilla/js/jquery-migrate-1.2.1.min.js',
    'resources/assets/plantilla/vendors/metisMenu/jquery.metisMenu.js',
    'resources/assets/plantilla/vendors/slimScroll/jquery.slimscroll.js',
    'resources/assets/plantilla/vendors/jquery-cookie/jquery.cookie.js',
    'resources/assets/plantilla/vendors/jquery-notific8/jquery.notific8.min.js',
    'resources/assets/plantilla/js/jquery.menu.js',
    'resources/assets/plantilla/vendors/bootstrap-daterangepicker/daterangepicker.js',
    'resources/assets/plantilla/js/main.js',
    'resources/assets/plantilla/vendors/ckeditor/ckeditor.js',
    'https://www.amcharts.com/lib/3/amcharts.js',
    'https://www.amcharts.com/lib/3/serial.js',
    'https://www.amcharts.com/lib/3/pie.js',
    'https://www.amcharts.com/lib/3/plugins/export/export.min.js',
    'https://www.amcharts.com/lib/3/themes/light.js',
    'resources/assets/plantilla/vendors/ckeditor/ckeditor.js',
    'resources/assets/plantilla/js/highmaps.js',
    'resources/assets/plantilla/js/Chart.min.js',
    'resources/assets/plantilla/js/d3.min.js',
    'resources/assets/plantilla/js/nv.d3.min.js',
    'resources/assets/plantilla/js/fusioncharts.js',
    'resources/assets/plantilla/js/fusioncharts.charts.js',
    'resources/assets/plantilla/js/zune-theme.js',
    'resources/assets/plantilla/js/hashids.min.js',
    'resources/assets/plantilla/js/md5.min.js',
    'resources/assets/plantilla/js/jquery.masknumber.js',
    'resources/assets/plantilla/js/crvclockpicker.js',
    'resources/assets/plantilla/js/jquery.mtz.monthpicker.js',
    'resources/assets/plantilla/js/knockout-min.js',
    'resources/assets/plantilla/js/bootstrapSwitch.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment-with-locales.min.js',
    'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
    'http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.3/js/bootstrap-select.min.js',
    'resources/assets/plantilla/js/GeneratorAdd.js',
    'resources/assets/plantilla/js/angular.min.js',
    'resources/assets/plantilla/js/angular-ui.min.js',
    'resources/assets/plantilla/js/chosen.jquery.min.js',
    'resources/assets/plantilla/js/chosen.proto.min.js',
    'resources/assets/plantilla/js/jquery-ui.min.js',
    'resources/assets/plantilla/bower_components/angular-route/angular-route.js',
    'resources/assets/plantilla/bower_components/angular-resource/angular-resource.js',
    'resources/assets/plantilla/bower_components/angularjs-truncate/src/truncate.js',
    'resources/assets/plantilla/js/ng-tags-input.min.js',
    'resources/assets/plantilla/js/ng-ckeditor.min.js',
    'resources/assets/plantilla/js/angular-locale_es-co.js',
    'resources/assets/plantilla/js/angular-messages.js',
    'resources/assets/plantilla/js/angular-deckgrid.js',
    'resources/assets/plantilla/js/angular-selector.js',
    'resources/assets/plantilla/js/angular-sanitize.js',
    'resources/assets/plantilla/js/timepickerpop.js',
    'resources/assets/plantilla/js/select.js',
    'resources/assets/plantilla/js/ui-bootstrap-tpls-0.10.0.js',
    'resources/assets/plantilla/js/angular-ui.min.js',
    'resources/assets/plantilla/js/ng-ckeditor.min.js',
    'resources/assets/plantilla/js/angular-chart.min.js',
    'resources/assets/plantilla/js/angular-nvd3.js',
    'resources/assets/plantilla/js/dirPagination.js',
    'resources/assets/plantilla/js/ng-pattern-restrict.min.js',
    'resources/assets/plantilla/js/angular-fusioncharts.min.js',
    'resources/assets/plantilla/js/angular-clockpicker.min.js',
    'resources/assets/plantilla/js/angular-toggle-switch.min.js',
    'resources/assets/plantilla/js/angular-ui-switch.js',
    'resources/assets/plantilla/js/ngDatepicker.min.js',
    'resources/assets/plantilla/js/angular-switcher.min.js',
    'resources/assets/plantilla/js/angular-animate.min.js',
    'resources/assets/plantilla/js/angular-aria.min.js',
    'resources/assets/plantilla/js/angular-material.js',
    'resources/assets/plantilla/js/ios-switch-directive.js',
    'resources/assets/plantilla/js/templates.min.js',
    'resources/assets/plantilla/js/multiselect.js',
    'resources/assets/plantilla/js/angular-ui.js',
    'resources/assets/plantilla/js/angjqDate.js',
    'resources/assets/plantilla/js/customSelect.js'

], 'public/js/master.js')

.js([

  'resources/assets/services/grupos/GrupoService.js'
    ],
     'public/services/gruposervices.js')

.js(['resources/assets/controllers/grupos/GruposCrtl.js',
     'resources/assets/controllers/grupos/CreateGrupoCtrl.js',
     'resources/assets/controllers/grupos/EditarGrupoCtrl.js',
     'resources/assets/controllers/grupos/BeneficiarioGrupoCtrl.js',
     'resources/assets/controllers/grupos/MisBeneficiariosGrupoCtrl.js',
     'resources/assets/controllers/grupos/EditarMiBeneficiarioCtrl.js',
	],
     'public/controllers/grupocontrollers.js')

.js(['resources/assets/js/perfil.js'],
     'public/jswebpack/perfil.js')


.js(['resources/assets/js/app.js'],
     'public/js/vue2.js')



.version();



    