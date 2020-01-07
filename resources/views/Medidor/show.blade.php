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
          <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal-consumo"><i class="fa fa-bar-chart"></i> Consumo</a>
          {{-- <div class="col-md-4">
            <form method="post" id="form-edit">
              {{ csrf_field() }}
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <button class="input-group-text"><i class="fa fa-search"></i></button>
                </div>
                <input type="text" class="form-control" placeholder="buscar">
              </div>
            </form>
          </div> --}}

          <div class="col-md-12">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Periodo</th>
                  <th scope="col">Dias</th>
                  <th scope="col">Lectura Anterior</th>
                  <th scope="col">Lectura Actual</th>
                  <th scope="col">Promedio KWh</th>
                  <th scope="col">Accion</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>14 JUN 2019 a 12 AGO 2019</td>
                  <td>59</td>
                  <td>04556</td>
                  <td>04339</td>
                  <td>3.67</td>
                  <td>
                    <a href="#" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>

            <div id="curve_chart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  google.charts.load('current', {'packages':['line']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    axios.get('/periodos-medidores', {
      responseType: 'json'
    })
    .then((res) => {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Años');
      res.data.forEach((periodo) => {
        let inicio = moment(periodo.inicio).format('ll')
        let fin = moment(periodo.fin).format('ll')

        data.addColumn('number', `${inicio} a ${fin}`);
      })

      data.addRows([
        [1,  37.8, 80.8, 41.8, 45.4],
        [2,  30.9, 69.5, 32.4, 32.4],
        [3,  25.4,   57, 25.7, 69.5],
        [4,  11.7, 69.5, 10.5, 25.4]
      ]);

      var options = {
        chart: {
          title: 'Consumo de Energía',
          subtitle: 'Gráfica por periodos'
        },
        width: 990,
        height: 500
      };

      var chart = new google.charts.Line(document.getElementById('curve_chart'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    })
  }
</script>

@endsection

@extends('medidor.modals')
