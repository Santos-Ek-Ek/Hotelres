@extends('administrador.layout.app')
@section('titulo', 'Productos')
@section('content')
<div>
<script src="{{ asset('js/prod.js') }}"></script>

<div style="margin-top:20px;">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Agregar producto <i class='bx bxs-add-to-queue'></i></button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
<div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" action="" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="col-md-3">
            <label for="recipient-name" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="recipient-name" name="nombre">
          </div>
          <div class="col-md-2">
          <label for="recipient-name" class="col-form-label">Categoría:</label>
            <select class="form-control" name ="categoria">
                <option disabled selected>Seleccione una opción</option>

            <option class="form-control" value=""></option>>

            </select>
          </div>
          <div class="col-md-2">
            <label for="recipient-name" class="col-form-label">Disponibles:</label>
            <input type="number" class="form-control" id="recipient-name" name="cantidad">
          </div>
          <div class="col-md-3">
            <label for="recipient-name" class="col-form-label">Imagen del producto:</label>
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
            <input type="file" name="" accept="image/*" class="form-control">
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
                    <th scope="col">NOMBRE</th>
                    <th scope="col">DETALLES</th>
                    <th scope="col">CATEGORÍA</th>
                    <th scope="col">VENDEDOR</th>
                    <th scope="col">ACCIONES</th>
                </thead>
                <tbody>
  
                    <tr>
                      <th></th>
                      <td><img width="100" height="100" src="" alt=""></td>
                      <td></td>
                      <td><p style="display: inline-block; max-width: 20rem; max-height: 7.8rem; overflow: auto; white-space: normal; word-wrap: break-word;"></p></td>
                      <td></td>
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
@endsection