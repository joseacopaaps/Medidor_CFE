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
            <form method="post" onsubmit="buscarPeriodo(event)">
              {{ csrf_field() }}
              <input type="hidden" id="medidor_id" value="{{ $medidor->id }}">
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
    let lecturaAnterior = {{ $medidor->periodos[0]->lectura }}
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
      document.getElementById('exampleModalConsumoLabel').innerHTML = `Hoy ${moment().format('ll')}`
      document.getElementById('lecturaAnterior').innerHTML = lecturaAnterior
      document.getElementById('lecturaActual').innerHTML = lecturaActual
      document.getElementById('consumo').innerHTML = `${lectura}kWh`
    }
  }
  var response
  function buscarPeriodo(event) {
    event.preventDefault()
    let rango = event.target.datepicker.value.split('-')

    axios.post('/medidores/buscar-periodos', {
      data: { fecha1: moment(rango[0]).format('YYYY-MM-DD'), fecha2: moment(rango[1]).format('YYYY-MM-DD'), medidor_id: event.target.medidor_id.value }
    })
    .then((res) => {
      response = res.data
      google.charts.load('current', {packages: ['corechart', 'line']});
      google.charts.setOnLoadCallback(drawChart);
    })
  }

  function drawChart() {
    let array = []
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'X');
    data.addColumn('number', 'KWh');

    response.forEach((fecha) => {
      array.push([moment(fecha.created_at).format('ll'), Number(fecha.lectura)])
    })
    data.addRows(array);

    var options = {
      hAxis: {
        title: 'Fechas'
      },
      vAxis: {
        title: 'KWh'
      }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    chart.draw(data, options);
  }
</script>

@endsection

@extends('medidor.modals')
