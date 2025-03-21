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
                                    <a class="btn btn-outline-danger">
                                        <i class="bx bxs-trash"></i>
                                    </a>
                                    </a>
                                    <form method="POST" style="display: none;">
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


@endsection