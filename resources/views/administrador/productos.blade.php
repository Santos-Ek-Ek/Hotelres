@extends('administrador.layout.app')
@section('titulo', 'Productos')
@section('content')
<div>

<div style="margin-top:20px;">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Agregar habitación <i class='bx bxs-add-to-queue'></i></button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
<div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar habitación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" action="{{ route('habitaciones.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="col-md-2">
            <label for="recipient-name" class="col-form-label">Número:</label>
            <input type="text" class="form-control" id="recipient-name" name="nombre">
          </div>
          <div class="col-md-2">
          <label for="recipient-name" class="col-form-label">Tipo de habitación:</label>
          <select class="form-control" name="categoria">
            <option disabled selected>Seleccione una opción</option>
            @foreach($tipos as $tipo)
                <option class="form-control" value="{{ $tipo->id }}">{{ $tipo->tipo_cuarto }}</option>
            @endforeach
        </select>
          </div>
          <div class="col-md-3">
            <label for="recipient-name" class="col-form-label">Cantidad de habitaciones:</label>
            <input type="number" class="form-control" id="recipient-name" name="cantidad">
          </div>
          <div class="col-md-3">
            <label for="recipient-name" class="col-form-label">Imagen de la habitación:</label>
            <input type="file" name="file" id="" accept="image/*" class="form-control">
          </div>
          <div class="col-md-2">
            <label for="recipient-name" class="col-form-label">Precio:</label>
            <input type="number" name="precio" id="recipient-name" class="form-control">
          </div>
          <label for="recipient-name" class="col-form-label">Otras vistas:</label>
          <div id="contenedorInpu" class="row">
    <div class="col-md-3" value="">
        <div class="input-group mb-3">
            <input type="file" name="imagenes[]" accept="image/*" class="form-control">
            <button class="btn btn-outline-secondary" type="button" >+</button>
        </div>
    </div>
</div>
</div>

          <div class="mb-3">
            <label for="message-text" class="col-form-label">Descripción:</label>
            <textarea class="form-control" id="message-text" name="detalles"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
        </form>
      </div>

    </div>
</div>
</div>
</div>
<br>
<div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table class="table" id="tbl2">
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">FOTO</th>
                    <th scope="col">No. HABITACIÓN</th>
                    <th scope="col">DETALLES</th>
                    <th scope="col">TIPO DE HABITACIÓN</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">ACCIONES</th>
                </thead>
                <tbody>
                    @foreach ($habitaciones as $habitacion)
                    <tr>
                      <th>{{ $habitacion->id }}</th>
                      <td><img width="100" height="100" src="{{ $habitacion->imagen_habitacion }}" alt=""></td>
                      <td>{{$habitacion->numero_habitacion}}</td>
                      <td><p style="display: inline-block; max-width: 20rem; max-height: 7.8rem; overflow: auto; white-space: normal; word-wrap: break-word;">{{ $habitacion->descripcion }}</p></td>
                      <td>{{$habitacion->tipoHabitacion->tipo_cuarto}}</td>
                      <td>$ {{$habitacion->precio}}</td>
                      <td></td>
                      <td>
                
                <a  class="btn btn-outline-danger" style="margin-top: 40px; align-items: center; margin-left:10px;">
                    <i class='bx bxs-trash'></i>
                </a>

            <a >
                <i class="bx bxs-edit btn btn-outline-primary" style="margin-top: 40px; align-items: center; margin-left:10px;"></i>
            </a>
            <form action="" method="post"   style="display: none;">
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
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="updateModalBody">
                <!-- Contenido del formulario de edición -->
            </div>
        </div>
    </div>
</div>
      </div>
    </div>
    <script>
    // Función para agregar un nuevo input de archivo
    document.querySelector('.btn-outline-secondary').addEventListener('click', function() {
        const newInput = `<div class="col-md-3">
                            <div class="input-group mb-3">
                                <input type="file" name="imagenes[]" accept="image/*" class="form-control">
                                <button class="btn btn-outline-danger remove-input" type="button">-</button>
                            </div>
                          </div>`;
        document.getElementById('contenedorInpu').insertAdjacentHTML('beforeend', newInput);
    });

    // Función para eliminar el input de archivo cuando se hace clic en el botón "-"
    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('remove-input')) {
            // Eliminar el contenedor del input
            event.target.closest('.col-md-3').remove();
        }
    });
</script>
@endsection