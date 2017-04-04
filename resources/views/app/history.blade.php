@extends('app.layout.main')


@section('content')
  @include('app.layout.partials._deviceselector')
  <h1>Histórico</h1>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Dispositivos cadastrados</h3>
        </div>
        <div class="panel-body">
          <table class="table table-condensed">
            <thead>
              <tr>
                <th>Leitura em</th>
                <th>Temp.</th>
                <th>Umid.</th>
              </tr>
            </thead>
            <tbody>
              @if($dados->count())
                @foreach($dados as $dado)
                  <tr>
                    <td>{{ \Carbon\Carbon::parse($dado->horario_leitura)->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $dado->valor_temperatura }}</td>
                    <td>{{ $dado->valor_umidade }}</td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="4">
                    <p class="lead text-muted text-center">Sem dados a serem exibidos.</p>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>

          @if($dados->count())
            <div class="text-center">{{ $dados->links() }}</div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection


@section('scripts')
@parent
@endsection