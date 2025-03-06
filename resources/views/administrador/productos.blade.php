@extends('administrador.layout.app')
@section('titulo', 'Habitaciones')
@section('content')
<div>

<div style="margin-top:20px;">
<div class="form-row align-items-center">
    <div class="col-auto">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Agregar habitación <i class='bx bxs-add-to-queue'></i></button>
</div>
<div class="col-auto" style="margin-top: 7px;">
                <input type="text" placeholder="Buscar habitación" class="form-control mb-2" id="searchInput">
                </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar habitación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="btn-cancelar1" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Primera Parte: Ingresar Cantidad -->
                <div id="parte1">
                    <div class="col-md-3">
                        <label for="cantidad-habitaciones" class="col-form-label">Cantidad de habitaciones:</label>
                        <input type="number" class="form-control" id="cantidad-habitaciones" name="cantidad" min="1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-cancelar2">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btn-continuar">Continuar</button>
                    </div>
                </div>

                <!-- Segunda Parte: Formularios Dinámicos -->
                <div id="parte2" style="display: none;">
                <form class="row g-3" action="{{ route('habitaciones.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="forms-container"></div> <!-- Aquí se agregarán los formularios dinámicos -->
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" id="btn-volver">Volver</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-cancelar3">Cancelar</button>
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
                      <td class="
    @if($habitacion->estado == 'Disponible') text-success
    @elseif($habitacion->estado == 'Reservado') text-warning
    @elseif($habitacion->estado == 'Ocupado') text-danger
    @endif
">
    {{ $habitacion->estado }}
</td>

                      <td>
                
                      <a class="btn btn-outline-danger eliminar-habitacion" data-id="{{ $habitacion->id }}" data-bs-toggle="modal" data-bs-target="#confirmarEliminarModal" style="margin-top: 40px; align-items: center; margin-left:10px;">
    <i class='bx bxs-trash'></i>
</a>

                <a class="btn btn-outline-primary editar-habitacion" data-id="{{ $habitacion->id }}" style="margin-top: 40px; align-items: center; margin-left:10px;">
    <i class="bx bxs-edit"></i>
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

<!--Modal Editar-->
<div class="modal fade" id="editarHabitacionModal" tabindex="-1" aria-labelledby="editarHabitacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarHabitacionModalLabel">Editar Habitación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-editar-habitacion" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3">
                            <label for="editar-nombre" class="col-form-label">Número:</label>
                            <input type="text" class="form-control" id="editar-nombre" name="nombre">
                        </div>
                        <div class="col-md-3">
                            <label for="editar-categoria" class="col-form-label">Tipo de habitación:</label>
                            <select class="form-control" id="editar-categoria" name="categoria">
                                <option disabled selected>Seleccione una opción</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->tipo_cuarto }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="editar-precio" class="col-form-label">Estado:</label>
                            <select class="form-control" id="editar-estado" name="estado">
                                <option disabled selected>Seleccione una opción</option>
                                    <option value="Disponible">Disponible</option>
                                    <option value="Reservado">Reservado</option>
                                    <option value="Ocupado">Ocupado</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="editar-precio" class="col-form-label">Precio:</label>
                            <input type="number" class="form-control" id="editar-precio" name="precio">
                        </div>
                        <div class="col-md-3">
                            <label for="editar-file" class="col-form-label">Imagen de la habitación:</label>
                            <div id="editar-imagen-principal-container">
                                <img id="editar-imagen-principal" src="" alt="Imagen principal" class="img-fluid mb-2" style="max-width: 100px;">
                            </div>
                            <input type="file" class="form-control" id="editar-file" name="file" accept="image/*" onchange="mostrarVistaPrevia(event)">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="editar-detalles" class="col-form-label">Descripción:</label>
                            <textarea class="form-control" id="editar-detalles" name="detalles"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="col-form-label">Otras vistas:</label>
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <input type="file" name="nuevas_imagenes[]" accept="image/*" class="form-control">
                                        <button type="button" class="btn btn-outline-secondary agregar-imagen-editar">+</button>
                                    </div>
                                </div>
                            </div>
                            <div id="editar-contenedor-imagenes" class="row">
                                <!-- Aquí se mostrarán las imágenes actuales -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Confirmación para Eliminar -->
<div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-labelledby="confirmarEliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmarEliminarModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar esta habitación?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmarEliminar">Eliminar</button>
            </div>
        </div>
    </div>
</div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.querySelector('#tbl2 tbody');

    searchInput.addEventListener('input', function() {
        const searchText = searchInput.value.toLowerCase(); // Obtener el texto de búsqueda en minúsculas

        // Recorrer todas las filas de la tabla
        Array.from(tableBody.querySelectorAll('tr')).forEach(function(row) {
            const rowText = row.textContent.toLowerCase(); // Obtener el texto de la fila en minúsculas

            // Mostrar u ocultar la fila según si coincide con el texto de búsqueda
            if (rowText.includes(searchText)) {
                row.style.display = ''; // Mostrar la fila
            } else {
                row.style.display = 'none'; // Ocultar la fila
            }
        });
    });
});
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    let habitacionId;

    // Escuchar el clic en el botón de eliminar
    document.querySelectorAll('.eliminar-habitacion').forEach(button => {
        button.addEventListener('click', function() {
            habitacionId = this.getAttribute('data-id');
        });
    });

    // Escuchar el clic en el botón de confirmar eliminación
    document.getElementById('confirmarEliminar').addEventListener('click', function() {
        if (habitacionId) {
            // Obtener el token CSRF del meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Enviar la solicitud de eliminación con el token CSRF
            fetch(`/eliminar_habitacion/${habitacionId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Incluir el token CSRF
                    'Content-Type': 'application/json', // Opcional, dependiendo de tu backend
                },
            })
            .then(data => {                    // Recargar la página para actualizar la lista de habitaciones
                    window.location.reload();

            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al eliminar la habitación');
            });
        }
    });
});
</script>
<script>
    function mostrarVistaPrevia(event) {
    const input = event.target; // Obtener el input de archivo
    const contenedorImagen = document.getElementById('editar-imagen-principal-container');
    const imagenPrincipal = document.getElementById('editar-imagen-principal');

    if (input.files && input.files[0]) {
        const reader = new FileReader(); // Crear un FileReader para leer la imagen

        // Cuando se cargue la imagen, actualizar la vista previa
        reader.onload = function (e) {
            imagenPrincipal.src = e.target.result; // Establecer la nueva imagen
            imagenPrincipal.style.display = 'block'; // Mostrar la imagen
        };

        reader.readAsDataURL(input.files[0]); // Leer la imagen como URL
    } else {
        // Si no se selecciona una imagen, ocultar la vista previa
        imagenPrincipal.style.display = 'none';
    }
}
    document.querySelectorAll('.editar-habitacion').forEach(button => {
    button.addEventListener('click', function() {
        const habitacionId = this.getAttribute('data-id');

        // Obtener los datos de la habitación y sus imágenes adicionales
        fetch(`/habitaciones/${habitacionId}/edit`)
            .then(response => response.json())
            .then(data => {
                // Prellenar el formulario de edición con los datos de la habitación
                document.getElementById('editar-nombre').value = data.habitacion.numero_habitacion;
                document.getElementById('editar-categoria').value = data.habitacion.tipo_habitacion_id;
                document.getElementById('editar-precio').value = data.habitacion.precio;
                document.getElementById('editar-detalles').value = data.habitacion.descripcion;
                document.getElementById('editar-estado').value = data.habitacion.estado;
                const imagenPrincipal = document.getElementById('editar-imagen-principal');
                if (data.habitacion.imagen_habitacion) {
                    imagenPrincipal.src = `{{ asset('') }}${data.habitacion.imagen_habitacion}`;
                    imagenPrincipal.style.display = 'block';
                } else {
                    imagenPrincipal.style.display = 'none';
                }


                // Mostrar las imágenes adicionales
                const contenedorImagenes = document.getElementById('editar-contenedor-imagenes');
                contenedorImagenes.innerHTML = ''; // Limpiar el contenedor

                data.imagenes.forEach(imagen => {
                    const imagenHtml = `
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <img src="{{ asset('${imagen.imagen}') }}" class="card-img-top" alt="Imagen">
                                <div class="card-body">
                                    <button type="button" class="btn btn-outline-danger eliminar-imagen-editar" data-imagen-id="${imagen.id}">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    `;
                    contenedorImagenes.insertAdjacentHTML('beforeend', imagenHtml);
                });

                // Actualizar la acción del formulario para incluir el ID de la habitación
                document.getElementById('form-editar-habitacion').action = `/habitaciones/${habitacionId}`;

                // Mostrar el modal de edición
                const modal = new bootstrap.Modal(document.getElementById('editarHabitacionModal'));
                modal.show();
            })
            .catch(error => console.error('Error:', error));
    });
});
document.addEventListener('click', function(event) {
    if (event.target && event.target.classList.contains('eliminar-imagen-editar')) {
        const imagenId = event.target.getAttribute('data-imagen-id');

        // Enviar una solicitud para eliminar la imagen
        fetch(`/habitaciones/imagenes/${imagenId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Eliminar la imagen del DOM
                event.target.closest('.col-md-3').remove();
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
document.querySelector('.agregar-imagen-editar').addEventListener('click', function() {
    const nuevoInput = `
        <div class="col-md-3">
            <div class="input-group mb-3">
                <input type="file" name="nuevas_imagenes[]" accept="image/*" class="form-control">
                <button type="button" class="btn btn-outline-danger eliminar-nueva-imagen">-</button>
            </div>
        </div>
    `;
    document.getElementById('editar-contenedor-imagenes').insertAdjacentHTML('beforeend', nuevoInput);
});

document.addEventListener('click', function(event) {
    if (event.target && event.target.classList.contains('eliminar-nueva-imagen')) {
        event.target.closest('.col-md-3').remove();
    }
});
</script>

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
                    <label for="estado-${i}" class="col-form-label">Estado:</label>
                    <select class="form-control" name="estado[]">
                        <option disabled selected>Seleccione una opción</option>
                            <option class="form-control" value="Disponible">Disponible</option>
                            <option class="form-control" value="Reservado">Reservado</option>
                            <option class="form-control" value="Ocupado">Ocupado</option>
                    </select>
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
    // Agregar funcionalidad para el botón "Volver"
    document.getElementById('btn-volver').addEventListener('click', function() {
        // Ocultar la segunda parte
        document.getElementById('parte2').style.display = 'none';

        // Mostrar la primera parte
        document.getElementById('parte1').style.display = 'block';
    });
    // Agregar funcionalidad para el botón "Cancelar"
// Agregar funcionalidad para el botón "Cancelar"
document.getElementById('btn-cancelar1').addEventListener('click', function() {
    // Reiniciar el modal
    reiniciarModal();

    // Cerrar el modal manualmente
    const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
    modal.hide();
});
// Agregar funcionalidad para el botón "Cancelar"
document.getElementById('btn-cancelar2').addEventListener('click', function() {
    // Reiniciar el modal
    reiniciarModal();

    // Cerrar el modal manualmente
    const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
    modal.hide();
});// Agregar funcionalidad para el botón "Cancelar"
document.getElementById('btn-cancelar3').addEventListener('click', function() {
    // Reiniciar el modal
    reiniciarModal();

    // Cerrar el modal manualmente
    const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
    modal.hide();
});

// Función para reiniciar el modal
function reiniciarModal() {
    // Ocultar la segunda parte
    document.getElementById('parte2').style.display = 'none';

    // Mostrar la primera parte
    document.getElementById('parte1').style.display = 'block';

    // Limpiar el campo de cantidad
    document.getElementById('cantidad-habitaciones').value = '';

    // Limpiar los formularios dinámicos
    document.getElementById('forms-container').innerHTML = '';
}
</script>

@endsection