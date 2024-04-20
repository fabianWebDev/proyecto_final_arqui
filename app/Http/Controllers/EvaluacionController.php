<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class EvaluacionController extends Controller
{

    protected $preguntas;

    public function __construct()
    {
        $this->preguntas = [
            'pregunta-1' => 'Cumple con las tareas asignadas',
            'pregunta-2' => 'No posee ausencias',
            'pregunta-3' => 'Posee 1 o más llegadas tardías',
            'pregunta-4' => 'Posee buena relación con los compañeros',
            'pregunta-5' => 'Fomenta el trabajo en equipo'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $notas_finales = [];
            $evaluaciones = Evaluacion::select('user_id', 'created_at')
                ->groupBy('user_id', 'created_at')
                ->havingRaw('COUNT(*) <> 1')
                ->get();

            foreach ($evaluaciones as $userId) {
                $evaluaciones = Evaluacion::where('created_at', $userId->created_at)->pluck('puntuacion');
                $total = $evaluaciones->sum();
                $notas_finales[] = [
                    'user_id' => $userId->user_id,
                    'total' => $total
                ];
            }

            return view('evaluacion.index', [
                'evaluaciones'  => $notas_finales
            ]);
        } catch (QueryException $e) {
            // Handle database errors
            return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return redirect()->back()->with('error', 'Ha ocurrido un error inesperado: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('evaluacion.agregar', [
                'empleados' => Empleado::latest()->get(),
                'preguntas' => $this->preguntas,
            ]);
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return redirect()->back()->with('error', 'Ha ocurrido un error inesperado: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $preguntasRespuestas = $request->pregunta;
            $userId = $request->input('user_id');

            foreach ($preguntasRespuestas as $pregunta => $respuesta) {
                $preguntaNumber = substr($pregunta, strrpos($pregunta, '-') + 1);
                $preguntaKey = 'pregunta-' . $preguntaNumber;
                $preguntaText = $this->preguntas[$preguntaKey];
                Evaluacion::create([
                    'user_id' => $userId,
                    'pregunta' => $preguntaText,
                    'puntuacion' => $respuesta,
                ]);
            }

            return to_route('evaluacion.index')->with('status', 'Evaluación creada correctamente!');
        } catch (QueryException $e) {
            // Handle database errors
            return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return redirect()->back()->with('error', 'Ha ocurrido un error inesperado: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluacion $evaluacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluacion $evaluacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluacion $evaluacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluacion $evaluacion)
    {
        //
    }
}
