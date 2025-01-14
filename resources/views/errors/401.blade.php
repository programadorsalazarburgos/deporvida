@extends('angular.template.master')
@section('title', 'Lista de usuarios')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="centering text-center error-container">
                <div class="text-center">
                    <h2 class="without-margin"><span class="text-danger"><big>Acceso Denegago</big></span></h2>
                    <h4 class="text-danger">Usted no tiene permiso para esta página.</h4>
                    <h4 class="text-danger">403</h4>
                </div>
                <div class="text-center">
                    <h3><small>Escoja una opción a continuación</small></h3>
                </div>
                <hr>
                <ul class="pager">
                    <li><a href="/admin/users">← Ir Atras</a></li>
                    <li><a href="/">Inicio Pagina</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection