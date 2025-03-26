@extends('administrador.layout.app')
@section('titulo', 'Huespedes')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="tbl1">
                        <thead>
                            <th scope="col">ID</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">APELLIDO</th>
                            <th scope="col">DIRECCIÓN</th>
                            <th scope="col">TELÉFONO</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">ACCIONES</th>
                        </thead>
                        <tbody>
                            @foreach ($huespedes as $huesped)
                            <tr>
                                <th>{{ $huesped->id }}</th>
                                <td>{{ $huesped->nombre }}</td>
                                <td>{{ $huesped->apellido }}</td>
                                <td>
                                    {{ $huesped->direccion }},
                                    @if($huesped->apartamento)
                                    {{ $huesped->apartamento }},
                                    @endif
                                    {{ $huesped->ciudad }},
                                    {{ $huesped->estado }},
                                    {{ $huesped->codigo_postal }},
                                    {{ $huesped->pais }}
                                </td>
                                <td>{{ $huesped->telefono }}</td>
                                <td>{{ $huesped->correo }}</td>
                                <td>
                                <form method="POST" action="{{ route('huespedes.destroy', $huesped->id) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este huésped?')">
                    <i class="bx bxs-trash"></i>
                </button>
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


@endsection