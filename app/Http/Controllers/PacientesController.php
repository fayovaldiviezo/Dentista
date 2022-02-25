<?php

namespace App\Http\Controllers;

use App\Models\Pacientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PacientesController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth() -> user()->rol != 'Administrador' && auth() -> user()->rol != 'Secretaria' && auth() -> user()->rol != 'Dcotor')
        {
            return redirect('Inicio');
        }

        $pacientes = DB::select('select * from users where rol = "Paciente"');

        return view('modulos.Pacientes')->with('pacientes',$pacientes);
    }

   
    public function create()
    {
        if(auth() -> user()->rol != 'Administrador' && auth() -> user()->rol != 'Secretaria' && auth() -> user()->rol != 'Doctor')
        {
            return redirect('Inicio');
        }
      
        return view('modulos.Crear-Paciente');
    }

  
    public function store(Request $request)
    {
        
        $datos = request()->validate([
            'name'=>['required'],
            'documento' => ['required'],
            'password' => ['required','string','min:3'],
            'email'=> ['required','string','email','unique:users']
        ]);

        Pacientes::create([
            'name'=>$datos['name'],
            'id_consultorio'=>0,
            'email'=>$datos['email'],
            'sexo'=>'',
            'documento'=>$datos['documento'],
            'telefono'=>'',
            'rol'=>'Paciente',
            'password'=>Hash::make($datos['password'])
        ]);

        return redirect('Pacientes')->with('Agregado','Si');
       
    }

    public function edit(Pacientes $id)
    {

        if(auth() -> user()->rol != 'Administrador' && auth() -> user()->rol != 'Secretaria' && auth() -> user()->rol != 'Doctor')
        {
            return redirect('Inicio');
        }
        $paciente = Pacientes::find($id->id);
        return view ('modulos.Editar-Paciente')->with('paciente',$paciente);
    }

   
    public function update(Request $request, Pacientes $paciente)
    {
 
        if($paciente["email"] != request('email') && request('passwordN') != ""){
 
            $datos = request()->validate([
 
                'name' => ['required'],
                'documento' => ['required'],
                'passwordN' => ['required', 'string', 'min:3'],
                'email' => ['required', 'string', 'email', 'unique:users']
 
 
            ]);
 
            DB::table('users')->where('id', $paciente["id"])->update(['name' => $datos["name"], 'email' => $datos["email"], 'documento' => $datos["documento"], 'password' => Hash::make($datos["passwordN"])]);
 
        }else if($paciente["email"] != request('email') && request('passwordN') == ""){
 
            $datos = request()->validate([
 
                'name' => ['required'],
                'documento' => ['required'],
                'password' => ['required', 'string', 'min:3'],
                'email' => ['required', 'string', 'email', 'unique:users']
 
 
            ]);
 
            DB::table('users')->where('id', $paciente["id"])->update(['name' => $datos["name"], 'email' => $datos["email"], 'documento' => $datos["documento"], 'password' => Hash::make($datos["password"])]);
 
        }else if($paciente["email"] == request('email') && request('passwordN') != ""){
 
            $datos = request()->validate([
 
                'name' => ['required'],
                'documento' => ['required'],
                'passwordN' => ['required', 'string', 'min:3'],
                'email' => ['required', 'string', 'email']
 
 
            ]);
 
            DB::table('users')->where('id', $paciente["id"])->update(['name' => $datos["name"], 'email' => $datos["email"], 'documento' => $datos["documento"], 'password' => Hash::make($datos["passwordN"])]);
 
        }else{
 
            $datos = request()->validate([
 
                'name' => ['required'],
                'documento' => ['required'],
                'password' => ['required', 'string', 'min:3'],
                'email' => ['required', 'string', 'email']
 
 
            ]);
 
            DB::table('users')->where('id', $paciente["id"])->update(['name' => $datos["name"], 'email' => $datos["email"], 'documento' => $datos["documento"], 'password' => Hash::make($datos["password"])]);
 
        }
 
        return redirect('Pacientes')->with('actualizadoP', 'Si');
 
 
    }

   
    public function destroy($id)
    {
        Pacientes::destroy($id);
        return redirect('Pacientes')->with('eliminadoP', 'Si');
    }
}
