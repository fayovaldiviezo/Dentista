@extends('plantilla')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Doctores del Consultorio de: <br>
        <b>{{$consultorio->consultorio}}</b></h1>
        
    </section>
    <section class="content">
        <div class="box">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                   <tr>
                       <th>Nombre y Apellido</th>
                       <th>Email</th>
                       <th>Teléfono</th>
                       <th>Horario</th>
                       <th></th>
                   </tr>
                </thead>
                <tbody>

                    @foreach($horarios as $hora)
                    @foreach($doctores as $doctor)
                    @if($hora -> id_doctor == $doctor->id)
                        <tr>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->email }}</td>
                            @if($doctor->telefono != "")
                            <td>{{ $doctor->telefono }}</td>
                            @else
                            <td>No disponible</td>
                            @endif
                            
                                
                                    <td>{{$hora->horarioInicio}}-{{$hora->horarioFin}}</td>
                                    <td>
                                        <a href="{{ url('Citas/'.$doctor->id) }}">
                                            <button class="btn btn-primary">Agenda tu Cita</button>
                                        </a>
                                    </td>
                                   
                                @endif
                          
                           
                        </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>

@endsection