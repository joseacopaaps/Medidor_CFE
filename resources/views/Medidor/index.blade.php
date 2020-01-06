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
              <a href="#" class="btn btn-primary pull-rigth" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Nuevo registro</a>
            </div>
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cuenta</th>
                    <th scope="col">No. Medidor</th>
                    <th scope="col">Uso</th>
                    <th scope="col">Tarifa</th>
                    <th scope="col">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($medidores as $key => $medidor)
                    <tr>
                      <th scope="row">{{ $key+1 }}</th>
                      <td>{{ $medidor->cuenta }}</td>
                      <td>{{ $medidor->numero_medidor }}</td>
                      <td>{{ $medidor->uso }}</td>
                      <td>{{ $medidor->tarifa }}</td>
                      <td>
                        <a href="#" onclick="editarMedidor('{{ route('medidor.edit', $medidor->id) }}')" class="btn btn-info" data-toggle="modal" data-target="#exampleModal-edit"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('medidor.show', $medidor->id) }}" class="btn btn-secondary"><i class="fa fa-bar-chart"></i></a>
                        <a href="#" onclick="destroy('{{ route('medidor.destroy', $medidor->id) }}')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  function editarMedidor(url) {
    $.ajax({
      url: url,
      method: "GET",
      success: (data) => {
        $('#cuenta-edit').val(data.cuenta)
        $('#numero-medidor-edit').val(data.numero_medidor)
        $('#uso-edit').val(data.uso)
        $('#tarifa-edit').val(data.tarifa)
        $('#form-edit').attr('action' , `/medidores/actualizar-medidor/${data.id}`)
      }
    })
  }
</script>
@endsection

@extends('medidor.modals')
