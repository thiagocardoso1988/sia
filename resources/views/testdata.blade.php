'<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Dados</div>
            </div>
            <div class="panel-body">
                <form action="{{ url('/testdata') }}" class="form" method="POST" id="test-form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Período</label>
                                <div class="input-group">
                                  <input id="date-start" type="date" class="form-control" placeholder="De" aria-describedby="basic-addon1">
                                  <span class="input-group-addon" id="date-start">a</span>
                                  <input id="date-end" type="date" class="form-control" placeholder="Até" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Temperatura</label>
                                <div class="input-group">
                                  <input id="temp-from" type="text" class="form-control" placeholder="De" aria-describedby="basic-addon1">
                                  <span class="input-group-addon" id="basic-addon1">a</span>
                                  <input id="temp-to" type="text" class="form-control" placeholder="Até" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Umidade</label>
                                <div class="input-group">
                                  <input id="umid-from" type="text" class="form-control" placeholder="De" aria-describedby="basic-addon1">
                                  <span class="input-group-addon" id="basic-addon1">a</span>
                                  <input id="umid-to" type="text" class="form-control" placeholder="Até" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <label for="devices-list">Dispositivos</label>
                            <select multiple class="form-control" name="devices-list" id="devices-list" size="10" style="margin-bottom: 5px">
                                @foreach($placas as $placa)
                                    <option value="{{ $placa->part_number }}">User {{ $placa->user_id }} - {{ $placa->alias }}</option>
                                @endforeach
                            </select>
                            <!-- <button class="btn btn-default">Adicionar Todos</button>
                            <button class="btn btn-default">Remover Todos</button> -->
                        </div>
                    </div>
                    <input type="text" id="medidas_data" name="medidas_data" />
                </form>

                <hr>

                <button class="btn btn-default" type="button" id="process-data">Processar dados</button>
                <button class="btn btn-primary" type="submit" id="submit-data">Enviar dados</button>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <pre><strong>Output:</strong></pre>
            </div>
        </div>
    </div>

    <script src="/js/app.js" type="text/javascript"></script>
    <script type="text/javascript">
        $("#process-data").click(function(){
            var header = '<strong>Output:</strong><br />';
            var out = parseData();
            $("pre").html(header + out);
        });

        function parseData(){
            var data = [];
            // guarda os dados de parametrização
            var start = new Date($('#date-start').val());
            var end = new Date($('#date-end').val());
            var t_min = parseInt($('#temp-from').val());
            var t_max = parseInt($('#temp-to').val());
            var u_min = parseInt($('#umid-from').val());
            var u_max = parseInt($('#umid-to').val());
            // loop pelos dispositivos
            $.each($('#devices-list option'), function(idx, obj){
                //var disp = $('#devices-list option')[e].value;
                var disp = obj.value;
                // loop pela range de dias
                while (start <= end){
                    // corrige a data
                    var newDate = start.setDate(start.getDate() + 1);
                    for (var h = 0; h < 24; h++){
                        var min = [0, 30];
                        for (var m in min){
                            // e obtém dados randômicos de temperatura e 
                            // umidade, baseado nos limiares definidos
                            var temp = getRandom(t_min, t_max);
                            var umid = getRandom(u_min, u_max);
                            // insere uma nova entrada no array
                            data.push([disp, timeConverter(newDate), h, min[m], temp, umid]);
                        }
                    }
                    // define nova data para continuar o loop
                    start = new Date(newDate);
                }
            })
            console.log('Data', data);
            // grava os dados no formato certo para envio e submita o form
            $('#medidas_data').val(JSON.stringify(data, null));
        }

        function getRandom(x, y){
            return Math.floor(Math.random() * ((y-x)+1) + x);
        }

        function timeConverter(UNIX_timestamp){
            var a = new Date(UNIX_timestamp);
            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var year = a.getFullYear();
            var month = '0' + (a.getMonth() + 1);
            var date = '0' + a.getDate();

            return year + '-' + month + '-' + date;

            var hour = a.getHours();
            var min = a.getMinutes();
            var sec = a.getSeconds();
            var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
            return time;
        }

        $('#submit-data').click(function(){
            $('form#test-form').submit();
        });
    </script>
</body>
</html>