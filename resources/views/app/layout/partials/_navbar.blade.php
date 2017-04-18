<!-- Static navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed hidden-sm" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img src="/images/logos/logo_sia.png" class="logo-top-menu">
      </a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="{{ (Route::currentRouteName() == 'appindex.show') ? 'active' : '' }}"><a href="{{ route('appindex.show') }}">Dashboard</a></li>
        <li class="{{ (Route::currentRouteName() == 'apphistory.show') ? 'active' : '' }}"><a href="{{ route('apphistory.show') }}">Histórico</a></li>
        <li class="{{ (Route::currentRouteName() == 'appdevices.show') ? 'active' : '' }}"><a href="{{ route('appdevices.show') }}">Meus Dispositivos</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Olá {{ Sentinel::getuser()->first_name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <a onclick="document.getElementById('form-logout').submit();">Logout</a>
              <form id="form-logout" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div><!--/.container-fluid -->
</nav>