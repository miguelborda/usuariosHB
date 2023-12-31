<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;


class MedicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*public function calcularEdad(Request $request)
    {
        $fechaNacimiento = $request->input('fecha_nacimiento');
        
        if ($fechaNacimiento) {
            $fechaNacimiento = Carbon::parse($fechaNacimiento);
            $edad = $fechaNacimiento->age;
        } else {
            $edad = null;
        }

        return response()->json(['edad' => $edad]);
    }*/

    public function index()
    {
        $ayer=('2009-10-11');
        $hoy=date('Y-m-d');        
        $actuals=abs(strtotime($ayer)-strtotime($hoy));  
        
        $medicos = Medico::all();
        //$medicos = Medico::where('estado', true)->get();
        return view("patologia.medicos.index", [
            'medicos'   =>  $medicos,            
            'hoy' => $hoy
        ]);             
    }

    public function pdf()
    {
        $hoy=date('Y-m-d');        
        $medicos = Medico::where('estado', true)->orderBy('apellido', 'asc')->get();
        $pdf = Pdf::loadView('patologia.medicos.pdf', compact('medicos','hoy'));
        return $pdf->stream();
        //return $pdf->download('invoice.pdf');  --> para descargar pdf
    }
    
    public function create()
    {
        return view('patologia.medicos.create');
    }        
    
    public function store(Request $request, Medico $medico)
    {
        $request->validate(
            [//'ci' => ['required', 'string', 'max:255', Rule::unique('medicos')->ignore($medico->id)],
             'ci' => 'required|regex:/^[0-9]{5,10}[a-zA-Z0-9-]*$/',
                    Rule::unique('medicos')->ignore($medico->id),
             'nombre'=>'required|regex:/^[a-zA-Z\s]+$/',
             'apellido'=>'required|regex:/^[a-zA-Z\s]+$/',
             'fecha_nacimiento' => 'required|date',
            ],
             [
                'apellido.regex' => 'Solo se permite letras',
                'nombre.regex' => 'Solo se permite letras',
                'fecha_nacimiento.date' => 'Fecha de nacimiento debe ser una fecha válida.',

            ]
        ); 

        $user = auth()->user();
        $hoy=date('Y-m-d'); 
        
        $datosMedico = $request->all();

        if (!empty($datosMedico['fecha_nacimiento'])) {
            $fechaNacimiento = $datosMedico['fecha_nacimiento'];
            $edad = date_diff(date_create($fechaNacimiento), date_create($hoy))->y;
    
            // Agrega la edad al array de datos del medico
            $datosMedico['edad'] = $edad;
        }
    
        // Crea el registro del medico y asocia la ID del usuario
        $medico = Medico::create(array_merge($datosMedico, ['creatoruser_id' => $user->id]));
        //$medico = Medico::create($request->all());
        $nombreMedico = $medico->nombre;
        $apellidoMedico = $medico->apellido;
        return redirect()->route('patologia.medicos.index')->with('mensaje',"Se creó exitosamente el médico: $nombreMedico, $apellidoMedico");    
    }  
    
    
    
    public function show(Medico $medico)
    {
        //
    }
    
    public function edit($id)
    {       
        $medico = Medico::find($id);
        return view('patologia.medicos.edit',compact('medico'));
    }          

    public function update(Request $request, $id)
    {
        $hoy = date('Y-m-d H:i:s');
        $medico = request()->except(['_token','_method']);
        $user = auth()->user();        
        Medico::where('id', $id)->update(array_merge($medico, ['updateduser_id' => $user->id],['updated_at' => $hoy]));           
        return redirect()->route('patologia.medicos.index')->with('mensaje', 'Se actualizó exitosamente');
    }       
        
    public function destroy($id)
    {   
        $hoy = date('Y-m-d H:i:s');
        $user = auth()->user();    
        $medico = Medico::find($id);
        if (!$medico) {
            return redirect()->route('patologia.medicos.index')->with('mensaje', 'No se encontró el medico');
        }
        $medico->estado = FALSE; // Cambia el estado a inactivo
        $medico->updateduser_id = $user->id;
        $medico->updated_at = $hoy;
        $medico->descripcion = 'Desactivó_el_Estado';
        $medico->save();
        return redirect()->route('patologia.medicos.index')->with('mensaje', 'El medico se marcó como Inactivo');
    }

    public function habilitar($id)
    {
        $hoy = date('Y-m-d H:i:s');
        $user = auth()->user();                
        $medico = Medico::find($id);
        if (!$medico) {
            return redirect()->route('patologia.medicos.index')->with('mensaje', 'No se encontró el medico');
        }
        $medico->estado = TRUE; // Cambia el estado a ACTIVO
        $medico->updateduser_id = $user->id;
        $medico->updated_at = $hoy;
        $medico->descripcion = 'Activó_el_Estado';
        $medico->save();
        return redirect()->route('patologia.medicos.index')->with('mensaje', 'El medico se marcó como Activo');
    }
}
