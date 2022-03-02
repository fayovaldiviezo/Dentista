@extends('plantilla')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Editar Inicio</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
               <form method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <h2>Días</h2>
                        <input type="text" class="input-lg" name="dias" value="{{$inicio->dias}}">
                        <div class="form-group">
                            <h2>Horarios:</h2>
                            Desde: <input type="time" class="input-lg" name="horaInicio" value="{{$inicio->horaInicio}}">
                            Hasta: <input type="time" class="input-lg" name="horaFin" value="{{$inicio->horaFin}}">
                        </div>
                        <h2>Dirección:</h2>
                        <input type="text" class="input-lg" name="direccion" value="{{$inicio->direccion}}">
                        <h2>Teléfono:</h2>
                        <input type="text" class="input-lg" name="telefono" value="{{$inicio->telefono}}">
                        <h2>Email:</h2>
                        <input type="email" class="input-lg" name="email" value="{{$inicio->email}}">
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <br><br>
                        <h2>Logo</h2>
                        <input type="file" name="logoN" >
                        <br>
                        <img src="http://localhost/dental/dental2/public/storage/{{$inicio->logo}}" width="200px">
                        <br><br>
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    </div>
                </div>
               </form> 
            </div>
        </div>
    </section>
</div>

@endsection