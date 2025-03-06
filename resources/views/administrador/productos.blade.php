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
                <!-- Primera Parte: Ingresar Cantidad -->
                <div id="parte1">
                    <div class="col-md-3">
                        <label for="cantidad-habitaciones" class="col-form-label">Cantidad de habitaciones:</label>
                        <input type="number" class="form-control" id="cantidad-habitaciones" name="cantidad" min="1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btn-continuar">Continuar</button>
                    </div>
                </div>

                <!-- Segunda Parte: Formularios Dinámicos -->
                <div id="parte2" style="display: none;">
                <form class="row g-3" action="{{ route('habitaciones.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="forms-container"></div> <!-- Aquí se agregarán los formularios dinámicos -->
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
    document.getElementById('btn-continuar').addEventListener('click', function() {
        const cantidad = document.getElementById('cantidad-habitaciones').value;
        if (cantidad > 0) {
            // Ocultar la primera parte
            document.getElementById('parte1').style.display = 'none';

            // Mostrar la segunda parte
            document.getElementById('parte2').style.display = 'block';

            // Generar los formularios dinámicos
            const formsContainer = document.getElementById('forms-container');
            formsContainer.innerHTML = ''; // Limpiar el contenedor

            for (let i = 0; i < cantidad; i++) {
    const form = `
        <div class="form-group mb-4">
            <h4>Registro ${i + 1}</h4>
            <div class="row">
                <div class="col-md-3">
                    <label for="nombre-${i}" class="col-form-label">Número:</label>
                    <input type="text" class="form-control" id="nombre-${i}" name="nombre[]">
                </div>
                <div class="col-md-3">
                    <label for="categoria-${i}" class="col-form-label">Tipo de habitación:</label>
                    <select class="form-control" name="categoria[]">
                        <option disabled selected>Seleccione una opción</option>
                        @foreach($tipos as $tipo)
                            <option class="form-control" value="{{ $tipo->id }}">{{ $tipo->tipo_cuarto }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="file-${i}" class="col-form-label">Imagen de la habitación:</label>
                    <input type="file" name="file[]" id="file-${i}" accept="image/*" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="precio-${i}" class="col-form-label">Precio:</label>
                    <input type="number" name="precio[]" id="precio-${i}" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="detalles-${i}" class="col-form-label">Descripción:</label>
                    <textarea class="form-control" id="detalles-${i}" name="detalles[]"></textarea>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <label class="col-form-label">Otras vistas:</label>
                    <div id="contenedorInpu-${i}" class="row">
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <input type="file" name="imagenes-${i}[]" accept="image/*" class="form-control">
                                <button class="btn btn-outline-secondary agregar-imagen" type="button" data-habitacion="${i}">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4"> <!-- Separador entre formularios -->
        </div>
    `;
    formsContainer.insertAdjacentHTML('beforeend', form);
}

            // Agregar funcionalidad para añadir más imágenes
            document.querySelectorAll('.agregar-imagen').forEach(button => {
                button.addEventListener('click', function() {
                    const habitacionId = this.getAttribute('data-habitacion');
                    const nuevoInput = `
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <input type="file" name="imagenes-${habitacionId}[]" accept="image/*" class="form-control">
                                <button class="btn btn-outline-danger eliminar-imagen" type="button">-</button>
                            </div>
                        </div>
                    `;
                    document.getElementById(`contenedorInpu-${habitacionId}`).insertAdjacentHTML('beforeend', nuevoInput);
                });
            });

            // Agregar funcionalidad para eliminar imágenes
            document.addEventListener('click', function(event) {
                if (event.target && event.target.classList.contains('eliminar-imagen')) {
                    event.target.closest('.col-md-3').remove();
                }
            });
        } else {
            alert('Por favor, ingrese una cantidad válida.');
        }
    });
</script>

@endsection