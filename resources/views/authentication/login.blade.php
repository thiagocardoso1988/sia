@extends('layouts.base')


@section('stylesheets')
    <link rel="stylesheet" href="css/site.css">
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Entrar</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ url('/login') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" placeholder="Senha" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Login" />
                                <a href="{{ url('/register') }}" class="btn btn-link pull-right">Registre-se</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection