<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" style="padding-right: 360px;
">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Rol: {{ Auth::user()->type }} </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="
    padding-right: 200px;">
  @if(Auth::check())
      <ul class="nav navbar-nav">
        <li class="active"><a href="/home">Inicio <span class="sr-only">(current)</span></a></li>
   @if (Auth::user()->type != 'usuario')
        <li><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
   @endif
         <li><a href="/materia">Materias</a></li>

          <li class="dropdown">


        </li>
      </ul>

       <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}  <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ url('/logout') }}">Salir</a></li>

          </ul>
        </li>
      </ul>
    @endif
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


