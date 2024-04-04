@extends('angular.frontend.master')
@section('title', 'Usuarios')
@section('content')
<div class="container" >
    <ng-view></ng-view>
</div>


@section('js')
<script type="text/javascript" src="{{ asset('js/jquery.masknumber.js') }}"></script>
<script src="{{asset("angularApp/usuarios.js")}}"></script>
@foreach($ngServices as $service)
<script src="{{$service}}"></script>
@endforeach
@foreach($ngControllers as $controller)
<script src="{{$controller}}"></script>
@endforeach
@endsection
@stop