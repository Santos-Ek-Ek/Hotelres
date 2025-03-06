@extends('administrador.layout.app')
@section('titulo', 'Categorías')
@section('content')
<div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
          <div class="card-header">
            <div class="form-row align-items-center">
            
                
                <div class="col-auto">
                    <input type="text" placeholder="Nombre de la categoría" class="form-control mb-2" name="nombre">
                </div>
                <div class="col-auto">
                    <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modalTipoHabitacion">Agregar</button>
                </div>
            
            </div>

          </div>
            <div class="card-body">
            <table class="table" id="tbl3">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">MÁXIMO DE PERSONAS</th>
                <th scope="col">No. CAMAS</th>
                <th scope="col">DESCRIPCIÓN</th>
                <th scope="col">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
    @foreach ( $tipos as $tipo )
                <tr>
                <th scope="row">{{ $tipo->id }}</th>
                <td>{{ $tipo->tipo_cuarto }}</td>
                <td>{{ $tipo->cantidad_maxima_personas }}</td>
                <td>{{ $tipo->numero_camas }}</td>
                <td>{{ $tipo->descripcion }}</td>
                <td>
                <a class="btn btn-outline-danger">
                            <i class="bx bxs-trash"></i>
                </a>
                <a class="btn btn-outline-primary editarTipo" data-id="{{ $tipo->id }}" data-tipo="{{ $tipo->tipo_cuarto }}"
    data-personas="{{ $tipo->cantidad_maxima_personas }}" data-camas="{{ $tipo->numero_camas }}"
    data-descripcion="{{ $tipo->descripcion }}" data-bs-toggle="modal" data-bs-target="#modalEditarTipo">
    <i class='bx bxs-edit-alt'></i>
</a>

                    <form  method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                    </form>
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

<!-- Modal -->
<div class="modal fade" id="modalTipoHabitacion" tabindex="-1" aria-labelledby="modalHabitacionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHabitacionLabel">Agregar Tipo de Habitación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formTipoHabitacion" action="{{  route('tipo-habitacion.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="tipoCuarto" class="form-label">Tipo de Cuarto</label>
                        <input type="text" class="form-control" id="tipoCuarto" name="tipo_cuarto" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidadPersonas" class="form-label">Cantidad Máxima de Personas</label>
                        <input type="number" class="form-control" id="cantidadPersonas" name="cantidad_maxima_personas" required>
                    </div>
                    <div class="mb-3">
                        <label for="numeroCamas" class="form-label">Número de Camas</label>
                        <input type="number" class="form-control" id="numeroCamas" name="numero_camas" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Editar -->
<div class="modal fade" id="modalEditarTipo" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Tipo de Habitación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarTipo" action="{{ route('tipo-habitacion.update', ['id' => 0]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="editTipoCuarto" class="form-label">Tipo de Cuarto</label>
                        <input type="text" class="form-control" id="editTipoCuarto" name="tipo_cuarto" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCantidadPersonas" class="form-label">Cantidad Máxima de Personas</label>
                        <input type="number" class="form-control" id="editCantidadPersonas" name="cantidad_maxima_personas" required>
                    </div>
                    <div class="mb-3">
                        <label for="editNumeroCamas" class="form-label">Número de Camas</label>
                        <input type="number" class="form-control" id="editNumeroCamas" name="numero_camas" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="editDescripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".editarTipo").forEach(button => {
        button.addEventListener("click", function () {
            document.getElementById("editId").value = this.dataset.id;
            document.getElementById("editTipoCuarto").value = this.dataset.tipo;
            document.getElementById("editCantidadPersonas").value = this.dataset.personas;
            document.getElementById("editNumeroCamas").value = this.dataset.camas;
            document.getElementById("editDescripcion").value = this.dataset.descripcion;

            // Modificar el action del formulario para incluir el ID correcto
            document.getElementById("formEditarTipo").action = `/tipo-habitacion/${this.dataset.id}`;
        });
    });
});

</script>
</div>

@endsection