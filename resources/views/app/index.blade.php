{{--dd(get_defined_vars()['__data'])--}}
@extends('app.layout.main')


@section('content')
  <!-- device select -->
    <div class="row">
        <div class="col-md-1 col-xs-3">
          <label for="device-select">Dispositivo</label>  
        </div>
        <div class="col-md-3 col-xs-9">
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Selecione o dispositivo
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

              {{--$devices->count()--}}

              @if($devices->count())
                @foreach($devices as $d)
                  <li><a href="#">{{ $d->alias }}</a></li>
                @endforeach
              @else
                <li><a href="{{ route('appdevices.show') }}">Adicionar Dispositivo</a></li>
              @endif
            </ul>
          </div>
        </div>
    </div>
  <!-- end device select -->
  <!-- data display -->
  <h1>Última Leitura</h1>
  <p class="text-muted"><strong>Horário:</strong> 05/03/2017 01:06</p>
  <div class="row">
    <div class="col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Temperatura</h3>
        </div>
        <div class="panel-body">
          <h1 class="text-center">25°</h1>
        </div>
      </div>
    </div>
    <div class="col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Umidade</h3>
        </div>
        <div class="panel-body">
          <h1 class="text-center">82%</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- end data display -->
  <!-- histogram chart -->
  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">
            <h3 class="panel-title">Histograma</h3>
          </div>
        </div>
        <div class="panel-body chart">
          <div id="histogram"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- end histogram chart -->
@endsection


@section('scripts')
@parent
<script src="/js/highcharts.js"></script>
<script type="text/javascript">
  Highcharts.chart('histogram', {
    chart: {
        type: 'line'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            '00',
            '01',
            '02',
            '03',
            '04',
            '05',
            '06',
            '07',
            '08',
            '09',
            '10',
            '11'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Temp.',
        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

    }, {
        name: 'Umid.',
        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

    }]
});
</script>
@endsection