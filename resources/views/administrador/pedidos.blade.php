@extends('administrador.layout.app')
@section('titulo', 'Reservaciones')
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
    <label for="searchInput">Buscar por Número de Reserva:</label>
    <input type="text" class="form-control" id="searchInput" placeholder="Ingrese el No. Reserva">
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
                    <th scope="col">No. RESERVA</th>
                    <th scope="col">No. CUARTO</th>
                    <th scope="col">TIPO DE CUARTO</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">FECHA DE ENTRADA</th>
                    <th scope="col">FECHA DE SALIDA</th>
                    <th scope="col">CANTIDAD DE NOCHES</th>
                    <th scope="col">CANTIDAD HUESPEDES</th>
                    <th scope="col">HUÉSPED PRINCIPAL</th>
                    <th scope="col">ESTADO</th>
                </thead>
                <tbody>
                @foreach ( $reservas as $reserva )
                    <tr>
                      <td>{{ $reserva->numero_reserva }}</td>
                      <td>{{$reserva->numero_cuarto}}</td>
                      <td>{{ $reserva->tipo_cuarto }}</td>
                      <td>{{ $reserva->cantidad_cuartos }}</td>
                      <td>{{ $reserva->fecha_entrada->format('Y-m-d') }}</td>
                      <td>{{ $reserva->fecha_salida->format('Y-m-d') }}</td>
                      <td>{{ $reserva->cantidad_noches }}</td>
                      <td>{{ $reserva->cantidad_huespedes }}</td>
                      <td><p style="display: inline-block; max-width: 20rem; max-height: 7.8rem; overflow: auto; white-space: normal; word-wrap: break-word;">{{ $reserva->huesped->nombre.' ' . $reserva->huesped->apellido }}</p></td>
                      <td><p style="display: inline-block; max-width: 20rem; max-height: 7.8rem; overflow: auto; white-space: normal; word-wrap: break-word;">
                      <select name="estado" id="" class="form-select">
                      <option value="{{ $reserva->estado }}" selected>{{ $reserva->estado }}</option>
                      <option value="Ocupado">Ocupado</option>
                      <option value="Cancelado">Cancelado</option>
                      </select>
                            </p>
                        </td>
                    </tr>
                    @endforeach
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