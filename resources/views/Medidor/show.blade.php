@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Bien!</strong> {{ $message }}.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      <div class="card">
        <div class="card-header">
          Cuenta: {{ $medidor->cuenta }} | No. Medidor: {{ $medidor->numero_medidor }}
          <a href={{ route('medidor.index') }} class="btn btn-light pull-right"><i class="fa fa-undo" aria-hidden="true"></i> Regresar</a>
        </div>
        <div class="card-body">
          <div class="col-md-4">
            <form method="post">
              {{ csrf_field() }}
              <div class="input-group mb-2">
                <input type="text" class="form-control" id="datepicker" readonly>
                <div class="input-group-prepend">
                  <button class="input-group-text"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>

          <div class="col-md-4">
            <div class="input-group mb-2">
              <input type="number" class="form-control" placeholder="lectura actual" id="lectura-actual" required>
              <div class="input-group-prepend">
                <button class="input-group-text" onclick="calcularLectura()"><i class="fa fa-calculator"></i></button>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div id="chart_div"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function calcularLectura() {
    let lecturaAnterior = {{ $medidor->lectura }}
    let lecturaActual = document.getElementById('lectura-actual').value

    if (lecturaActual < lecturaAnterior) {
      swal(
        '¡Invalido!',
        'Lectura no valida.',
        'warning'
      )
    }else {
      $("#exampleModal-consumo").modal();
      let lectura = lecturaActual - lecturaAnterior
      document.getElementById('exampleModalConsumoLabel').innerHTML = moment().format('ll')
      document.getElementById('lecturaAnterior').innerHTML = lecturaAnterior
      document.getElementById('lecturaActual').innerHTML = lecturaActual
      document.getElementById('consumo').innerHTML = `${lectura}kWh`
    }
  }
  google.charts.load('current', {packages: ['corechart', 'line']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('number', 'X');
    data.addColumn('number', 'KWh');

    data.addRows([
      [0, 3],   [1, 4],  [2, 3],  [3, 1],  [4, 6],  [5, 9],
      [6, 3],  [7, 2],  [8, 2],  [9, 8],  [10, 2], [11, 4],
      [12, 2], [13, 8], [14, 3], [15, 4], [16, 6], [17, 8],
      [18, 9], [19, 4], [20, 2], [21, 5], [22, 8], [23, 1],
      [24, 9]
    ]);

    var options = {
      hAxis: {
        title: 'KWh'
      },
      vAxis: {
        title: 'Hora'
      }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    chart.draw(data, options);
  }
</script>

@endsection

@extends('medidor.modals')
