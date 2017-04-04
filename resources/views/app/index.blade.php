{{--dd(get_defined_vars()['__data'])--}}
<?php

  $last = ($dados->count()) ? $dados[0] : null ;

?>

@extends('app.layout.main')


@section('content')
  @include('app.layout.partials._deviceselector')
  <!-- data display -->
  <div class="content">
    @if($placas->count() && $dados->count())
      <h1>Última Leitura</h1>
        <p class="text-muted"><strong>Horário:</strong> {{ \Carbon\Carbon::parse($last->horario_leitura)->format('d/m/Y H:i') }}</p>
  

          <div class="row">
            <div class="col-xs-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Temperatura</h3>
                </div>
                <div class="panel-body">
                  <h1 class="text-center">{{ $last->valor_temperatura }}°</h1>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Umidade</h3>
                </div>
                <div class="panel-body">
                  <h1 class="text-center">{{ $last->valor_umidade }}%</h1>
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
    </div>
  @else
    <!-- end data display -->
    <div class="nodata">
      <h1 class="text-center text-muted">Sem dados a Exibir.</h1>
    </div>
  @endif

@endsection


@section('scripts')
@parent

<script src="/js/highcharts.js" type="text/javascript"></script>
<script type="text/javascript">
  var rawdata = {!! $dados !!};
  console.log(rawdata);  

  var t = [];
  $.each(rawdata, function(k, v){
    t.push({'horario'     : new Date(v['horario_leitura']),
            'temperatura' : parseFloat(v['valor_temperatura']),
            'umidade'     : parseFloat(v['valor_umidade'])});
  }); 

  $.map(t, function(i){
    return i.umidade;
  });

/*
  function createData(a, columns){
    var data = [];
    $.each(a, function(k, v){
      var d = [];
      $.each(columns, function(k, v){
        d.push(a[v]);
      });
      console.log(k, d);
    });
    return data;
  }
*/  
  /*var data = [];
  $.each(rawdata, function(k, v){
    var d = [];
    d.push(new Date(v['horario_leitura']));
    d.push(parseFloat(v['valor_temperatura']));
    d.push(parseFloat(v['valor_umidade']));
    data.push(d);  
  });*/
  //console.log(rawdata);
  //console.log(createData(rawdata, ['horario_leitura', 'valor_temperatura']));


  $(document).ready(function() {

    var options = {
        chart: {
            renderTo: 'histogram',
            type: 'spline',
        },
        title: { text: null },
        subtitle: { text: null },
        tooltip: {
            shared: true,
            crosshairs: true
        },
        series: [{}, {}]
    };

    console.log($.map(t, function(i){ return [i.horario, i.umidade]; }));


    options.series[0].data = $.map(t, function(i){ return [i.temperatura]; });
    options.series[1].data = $.map(t, function(i){ return [i.umidade]; });
    console.log(options);
    var chart = new Highcharts.Chart(options);


});

</script>

@endsection