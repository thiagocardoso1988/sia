{{--dd(get_defined_vars()['__data'])--}}
@extends('app.layout.main')


@section('content')
  @include('app.layout.partials._deviceselector')
  <!-- data display -->
  <div class="content">
    @if($placas->count())
      <h1>Última Leitura</h1>
      <div id="app">
 
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

<script src="/js/highcharts.js"></script>
<script type="text/javascript">
  // atribui o evento à exibição de informação
  $(function(){
    $('.dropdown-menu li a').on('click', function(){
      var d = loadData($(this).attr('id'));
      showProgress();
    });
  });

  // obtém os dados do servidor, se existirem
  var loadData = function(id){

  };

  // exibe os dados na view
  var showData = function(data){

  };

  // exibe os dados no histograma
  function setChart(data){
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
  }
</script>
@endsection