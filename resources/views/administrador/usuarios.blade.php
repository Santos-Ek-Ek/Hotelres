@extends('administrador.layout.app')
@section('titulo', 'Usuarios')
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
                    <th scope="col">USUARIO</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">ACCIONES</th>
                </thead>
                <tbody>

                    <tr>
                      <th></th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <a  class="btn btn-outline-danger">
                                  <i class="bx bxs-trash"></i>
                        </a>
                        </a>
                          <form  method="POST" style="display: none;">
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
      </div>
    </div>


@endsection