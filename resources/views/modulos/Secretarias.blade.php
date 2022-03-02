@extends('plantilla')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Gestor de Secretarias</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#CrearSecretaria">Crear Secretaria</button>
            </div>
            <div class="box-body">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Documento</th>
                            <th>Teléfono</th>
                            <th>Editar / Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($secretarias as $secretaria)
                            <tr>
                                <td>{{ $secretaria->id }}</td>
                                <td>{{ $secretaria->name }}</td>
                                <td>{{ $secretaria->email }}</td>
                                @if ($secretaria -> documento!= "")
                                     <td>{{ $secretaria->documento }}</td>
                                    @else 
                                    <td>No disponible</td>
                                @endif
                                @if ($secretaria -> telefono != "")
                                <td>{{ $secretaria->telefono }}</td>
                               @else 
                               <td>No Registrado</td>
                           @endif
                           <td>
                           <a href="{{ url('Editar-Secretaria/'.$secretaria->id) }}">
                            <button class="btn btn-success"><i class="fa fa-pencil"></i> </button>
                           </a>                              
                               <button class="btn btn-danger EliminarSecretaria" Sid="{{ $secretaria->id }}"><i class="fa fa-trash"></i> </button>
                           </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="CrearSecretaria">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                @csrf
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <h2>Nombre y Apellido</h2>
                            <input type="text" class="form-control input-lg" name="name"  value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <h2>Email</h2>
                            <input type="email" class="form-control input-lg" name="email" required value="{{ old('email') }}">
                            @error('email')
                                <div class="alert alert-danger">El Email ya existe.</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h2>Contraseña</h2>
                            <input type="text" class="form-control input-lg" name="password" value="{{ old('password') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Crear</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="EditarSecretaria">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ url('actualizar-secretaria/'.$secretaria->id) }}">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <h2>Nombre y Apellido</h2>
                            <input type="text" class="form-control input-lg" name="name"  value="{{ $secretaria->name }}">
                        </div>
                        <div class="form-group">
                            <h2>Email</h2>
                            <input type="email" class="form-control input-lg" name="email" required value="{{ $secretaria->email }}">
                            @error('email')
                                <div class="alert alert-danger">El Email ya existe.</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h2>Nueva Contraseña</h2>
                            <input type="text" class="form-control input-lg" name="passwordN" value="">
                            <input type="hidden" name="password" value="{{ $secretaria->password }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Guardar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection