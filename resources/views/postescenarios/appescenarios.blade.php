@extends('angular.frontend.master')
@section('title', 'Escenarios')
@section('content')

<div class="container" >
     <ng-view></ng-view>
 </div>

@section('js')
<script src="{{asset("angularApp/escenarios.js")}}"></script>
<script src="js/GeneratorAdd.js" type="text/javascript"></script>
        @foreach($ngServices as $service)
            <script src="{{$service}}"></script>
        @endforeach
        @foreach($ngControllers as $controller)
            <script src="{{$controller}}"></script>
        @endforeach

@endsection
@stop
