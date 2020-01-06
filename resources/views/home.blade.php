@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          @if ($message = Session::get('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Correcto!</strong> {{ $message }}.
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
                        <th scope="col">Medidor</th>
                        <th scope="col">Número</th>
                        <th scope="col">Accion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Medidor 1</td>
                        <td>123123123</td>
                        <td>
                          <a href="#" class="btn btn-info"><i class="fa fa-edit"></i></a>
                          <a href="#" class="btn btn-secondary"><i class="fa fa-bar-chart"></i></a>
                          <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="{{ route('medidor.store') }}">
      {{ csrf_field() }}
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar Medidor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="medidor">Medidor:</label>
                <input type="text" class="form-control" id="medidor" name="medidor" placeholder="medidor" required>
              </div>
              <div class="form-group">
                <label for="numero">Número:</label>
                <input type="number" class="form-control" id="numero" name="numero" placeholder="número" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </form>
  </div>
</div>
