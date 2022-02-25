<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Pacientes;
use App\Models\Doctores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id)
    {
        if(auth()->user()->rol == 'Doctor' && $id != auth()->user()->id)
        {
            return redirect('Inicio');
        }

        $horarios = DB::select('select * from horarios where id_doctor =' .$id);
        $pacientes = Pacientes::all();
        $citas = Citas::all()->where('id_doctor',$id);
        $doctor = Doctores::find($id);

        return view('modulos.Citas', compact('horarios','pacientes','citas','doctor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function HorarioDoctor(Request $request)
    {
        $datos = request();
        DB::table('horarios')->insert([
            'id_doctor' => auth()-> user()->id,
            'horarioInicio' => $datos["horarioInicio"],
            'horarioFin' => $datos["horarioFin"] 
        ]);
        return redirect('Citas/'.auth()-> user()->id);
    }
    
    public function EditarHorario(Request $request)
    {
        $datos = request();
        DB::table('horarios')->where('id',$datos['id'])->update([
            'horarioInicio' =>$datos["horarioInicioE"],
            'horarioFin' => $datos["horarioFinE"]
        ]);
        return redirect('Citas/'.auth()-> user()->id);
    }


    public function CrearCita(Request $id_doctor)
    {
        Citas::create([
            'id_doctor' => request('id_doctor'),
            'id_paciente' => request('id_paciente'),
            'FyHinicio' => request('FyHinicio'),
            'FyHfinal' => request('FyHfinal'),
        ]);

        return redirect('Citas/'.request('id_doctor'));
    }

    
    public function destroy(Citas $citas)
    {
        DB::table('citas')->whereId(request('idCita'))->delete();
        return redirect('Citas/'.request('idDoctor'));
    }
}
