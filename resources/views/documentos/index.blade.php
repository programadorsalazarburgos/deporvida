@extends('angular.frontend.master')
@section('title', 'Mis documentos')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <ul id="tableactiondTab" class="nav nav-tabs">
            <li class="active">
                <a href="#table-table-tab" data-toggle="tab">Mis documentos</a>
            </li>
        </ul>
        <div id="tableactionTabContent" class="tab-content">
            <div class="container-fluid">
                <!-- DATA  ELFINDER -->                
                <script data-main="./elfinder/main.default.js" src="{{url('')}}/local/js/require.min.js"></script>
                <script>
                    define('elFinderConfig', {
                        defaultOpts : 
                        {
                            url : '{{url('')}}/elfinder/php/documentos.php?user={{$id_user}}', // connector URL (REQUIRED)
                            commandsOptions : 
                            {
                                edit : 
                                {
                                    extraOptions : 
                                    {
                                        creativeCloudApiKey : '',
                                        managerUrl : ''
                                    }
                                },
                                quicklook : 
                                {
                                    googleDocsMimes : [
                                        'application/pdf', 
                                        'image/tiff', 
                                        'application/vnd.ms-office', 
                                        'application/msword', 
                                        'application/vnd.ms-word', 
                                        'application/vnd.ms-excel', 
                                        'application/vnd.ms-powerpoint', 
                                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                                        ]
                                }
                            },
                            bootCallback : function(fm, extraObj) 
                            {
                                fm.bind('init', function() {
                                    // any your code
                                });
                                var title = document.title;
                                fm.bind('open', function() 
                                {
                                    var path = '', 
                                        cwd  = fm.cwd();
                                    if (cwd)
                                    {
                                        path = fm.path(cwd.hash) || null;
                                    }
                                    document.title = path? path + ':' + title : title;
                                }).
                                bind('destroy', function() 
                                {
                                    document.title = title;
                                });
                            }
                        },
                        managers : 
                        {
                            'elfinder': {}
                        }
                    });
                </script>
                <div id="elfinder"></div>
                <!-- EL FINDER -->
            </div>
        </div>
    </div>
</div>
@stop