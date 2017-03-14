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
                        <h3 class="panel-title">Registre-se</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ url('/register') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control" placeholder="Email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-user"></i>
                                    </span>
                                    <input type="text" name="first_name" class="form-control" placeholder="Primeiro Nome" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-user"></i>
                                    </span>
                                    <input type="text" name="last_name" class="form-control" placeholder="Último Nome" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" placeholder="Senha" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-lock"></i>
                                    </span>
                                    <input type="password" name="passwordconf" class="form-control" placeholder="Confirme a Senha" />
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="{{ url('/login') }}" class="btn btn-link">Login</a>
                                <input type="submit" class="btn btn-primary pull-right" value="Registrar" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection