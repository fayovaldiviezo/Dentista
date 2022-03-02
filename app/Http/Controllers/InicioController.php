<?php

namespace App\Http\Controllers;

use App\Models\Inicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class InicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $inicio = Inicio::find(1);
        return view('modulos.Inicio')->with('inicio',$inicio);
    }

    
    public function DatosCreate()
    {
        return view('modulos.Mis-Datos');
    }

   
    public function DatosUpdate(Request $request)
    {
        
        if(auth()->user()->email != request('email'))
        {
            
            if(isset($datos['passwordN']))
            {
                $datos = request()->validate([
                    'name' => ['required', 'string','max:255'],
                    'telefono' => ['string','max:255'],
                    'documento' => ['string','max:255'],
                    'email' => ['required', 'email','string','unique:users'],
                    'passwordN' => ['string','min:3','required']
                ]);
            }else{
                $datos = request()->validate([
                    'name' => ['required', 'string','max:255'],
                    'telefono' => ['string','max:255'],
                    'documento' => ['string','max:255'],
                    'email' => ['required', 'email','string','unique:users']
                ]);
            }
        }else
        {
            if(isset($datos["passwordN"]))
            {
                $datos = request()->validate([
                    'name' => ['required', 'string','max:255'],
                    'telefono' => ['string','max:255'],
                    'documento' => ['string','max:255'],
                    'email' => ['required', 'email','string'],
                    'passwordN' => ['string','min:3','required']
                ]);
            }else{
                $datos = request()->validate([
                    'name' => ['required', 'string','max:255'],
                    'telefono' => ['string','max:255'],
                    'documento' => ['string','max:255'],
                    'email' => ['required', 'email','string']
                ]);
            }
        }
        if(isset($datos["passwordN"]))
        {
            DB::table('users')->where('id', auth()->user()->id)->update
            ([
                'name' => $datos['name'],
                'email' => $datos['email'],
                'telefono' => $datos['telefono'],
                'documento' => $datos['documento'],
                'password' => Hash::make($datos['passwordN'])
               
            ]);
        }else
        {
            DB::table('users')->where('id', auth()->user()->id)->update
            ([
                'name' => $datos['name'],
                'email' => $datos['email'],
                'telefono' => $datos['telefono'],
                'documento' => $datos['documento']
                
            ]);
        }
        return redirect('Mis-Datos');
    }

  
    public function edit()
    {
        $inicio = Inicio::find(1);
        return view('modulos.Inicio-Editar')->with('inicio',$inicio);
    }

   
    public function update(Request $request)
    {
        $datos = request();
        $inicio = Inicio::find(1);

        $inicio->dias = $datos["dias"];
        $inicio->horaInicio = $datos["horaInicio"];
        $inicio->horaFin = $datos["horaFin"];
        $inicio->direccion = $datos["direccion"];
        $inicio->telefono = $datos["telefono"];
        $inicio->email = $datos["email"];

        if(request('logoN'))
        {
            Storage::delete(['public/'.$inicio->logo]);
            $rutaImg = $request['logoN'] -> store('inicio','public');
            $inicio->logo = $rutaImg;
        }
        $inicio -> save();
        return redirect('Inicio-Editar');
        
    }

   
}
