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
                <label for="cuenta">Cuenta:</label>
                <input type="text" class="form-control" id="cuenta" name="cuenta" placeholder="cuenta" required>
              </div>
              <div class="form-group">
                <label for="numero-medidor">No. Medidor:</label>
                <input type="text" class="form-control" id="numero-medidor" name="numero_medidor" placeholder="no. medidor" required>
              </div>
              <div class="form-group">
                <label for="medidor">Uso:</label>
                <input type="text" class="form-control" id="uso" name="uso" placeholder="uso" required>
              </div>
              <div class="form-group">
                <label for="tarifa">Tarifa:</label>
                <input type="text" class="form-control" id="tarifa" name="tarifa" placeholder="tarifa" required>
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

<div class="modal fade" id="exampleModal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModal-edit" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" id="form-edit">
      {{ csrf_field() }}
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalEditLabel">Editar Medidor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="cuenta">Cuenta:</label>
                <input type="text" class="form-control" id="cuenta-edit" name="cuenta" placeholder="cuenta" required>
              </div>
              <div class="form-group">
                <label for="numero-medidor">No. Medidor:</label>
                <input type="text" class="form-control" id="numero-medidor-edit" name="numero_medidor" placeholder="no. medidor" required>
              </div>
              <div class="form-group">
                <label for="medidor">Uso:</label>
                <input type="text" class="form-control" id="uso-edit" name="uso" placeholder="uso" required>
              </div>
              <div class="form-group">
                <label for="tarifa">Tarifa:</label>
                <input type="text" class="form-control" id="tarifa-edit" name="tarifa" placeholder="tarifa" required>
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

<div class="modal fade" id="exampleModal-consumo" tabindex="-1" role="dialog" aria-labelledby="exampleModal-consumo" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalConsumoLabel">Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
