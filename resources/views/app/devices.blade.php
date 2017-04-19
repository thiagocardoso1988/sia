{{--dd(Sentinel::getuser())--}}
{{--dd(get_defined_vars()['__data'])--}}

@extends('app.layout.main')


@section('content')
  @if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <h1>Meus Dispositivos</h1>
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Dispositivos cadastrados</h3>
        </div>
        <div class="panel-body">
          <table class="table table-condensed">
            <thead>
              <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Cadastrado em</th>
              </tr>
            </thead>
            <tbody>
              @if($placas->count())
                @foreach($placas as $placa)
                  <tr>
                    <td>{{ $placa->part_number }}</td>
                    <td>{{ $placa->alias }}</td>
                    <td>{{ \Carbon\Carbon::parse($placa->created_at)->format('d/m/Y h:i') }}</td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="3">
                    <p class="lead text-center">Nenhum dispositivo cadastrado.</p>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Cadastrar Novo Dispositivo</h3>
        </div>
        <div class="panel-body">
          <form action="{{ route('appdevices.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="part_nunmber">Código de Identificação</label>
              <input type="text" class="form-control" name="part_number" placeholder="Código de Identificação">
            </div>
            <div class="form-group">
              <label for="alias">Nome de Exibição</label>
              <input type="text" class="form-control" name="alias" placeholder="Nome de Exibição">
            </div>
            <div class="text-center">
              <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Novo Dispositivo</button>
            </div>
            <input type="hidden" name="user_id" value="{{ Sentinel::getuser()->id }}">
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('scripts')
@parent
@endsection