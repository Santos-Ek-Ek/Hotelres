@extends('administrador.layout.app')
@section('titulo', 'Pedidos')
@section('content')
<style>
    .envio-status {
        font-weight: bold;
    }

    .color-green {
        color: green;
    }

    .color-orange {
        color: orange;
    }
</style>

<script src="{{ asset('js/pedido.js') }}"></script>
<div class="container-fluid">
<div class="form-group">
    <label for="searchInput">Buscar por ID de transacción:</label>
    <input type="text" class="form-control" id="searchInput" placeholder="Ingrese el ID de transacción">
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="checkEnviados" value="ENVIADO">
    <label class="form-check-label" for="checkEnviados">Enviados</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="checkPendientes" value="PENDIENTE">
    <label class="form-check-label" for="checkPendientes">Pendientes</label>
</div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table class="table" id="tbl2">
                <thead>
                    <th scope="col" hidden>ID_TR</th>
                    <th scope="col">FOTO</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">DETALLES</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">DIRECCIÓN</th>
                    <th scope="col">USUARIO</th>
                    <th scope="col">ENVÍO</th>
                    <th scope="col">ACCIONES</th>
                </thead>
                <tbody>

                    <tr>
                      <td hidden></td>
                      <td><img width="100" height="100" src="" alt=""></td>
                      <td></td>
                      <td><p style="display: inline-block; max-width: 20rem; max-height: 7.8rem; overflow: auto; white-space: normal; word-wrap: break-word;"></p></td>
                      <td></td>
                      <td><p style="display: inline-block; max-width: 20rem; max-height: 7.8rem; overflow: auto; white-space: normal; word-wrap: break-word;"></p></td>
                      <td></td>
                      <td>
    <span id="envioValue" class="envio-status">

    </span>
</td>

                      <td>
                
                      <button class="btn btn-outline-success change-status" data-id="" data-status="" style="align-items: center; margin-left:10px;">
        <i class='fas fa-paper-plane d-flex'> Enviado</i>
    </button>

                </td>
                    </tr>
                </tbody>
                <!-- Agrega esta fila al final de tu tabla -->
<tr id="noPendientesMessage" style="display: none;">
    <td colspan="9">No hay pedidos pendientes.</td>
</tr>
<tr id="noEnviadosMessage" style="display: none;">
    <td colspan="9">Ningún pedido ha sido enviado.</td>
</tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection