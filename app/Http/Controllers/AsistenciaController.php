<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $current_time = Carbon::now();
            $current_date = Carbon::today();

            $empleado = auth()->user()->empleado;
            $hora_entrada_carbon = Carbon::parse($empleado->horario->hora_entrada);
            $hora_salida_carbon = Carbon::parse($empleado->horario->hora_salida);

            //Calcular rangos de horas entrada y salidas 
            $hora_entrada_tarde = $hora_entrada_carbon->copy()->addMinutes(15)->format('H:i:s');
            $hora_entrada_temprano = $hora_entrada_carbon->copy()->subHours(1)->format('H:i:s');
            $hora_salida_tarde = $hora_salida_carbon->copy()->addMinutes(15)->format('H:i:s');
            $hora_salida_temprano = $hora_salida_carbon->copy()->subHours(1)->format('H:i:s');

            $asistencia_fecha_hoy = Asistencia::whereDate('fecha', $current_date)->exists();
            $marca_entrada_not_null = Asistencia::whereDate('fecha', $current_date)
                ->whereNotNull('marca_entrada')
                ->exists();
            $marca_salida_not_null = Asistencia::whereDate('fecha', $current_date)
                ->whereNotNull('marca_salida')
                ->exists();

            // dump($marca_salida_not_null);
            // die();

            return view('asistencia.index', [
                'current_time' => $current_time->toTimeString(),
                'hora_entrada_tarde' => $hora_entrada_tarde,
                'hora_entrada_temprano' => $hora_entrada_temprano,
                'hora_salida_tarde' => $hora_salida_tarde,
                'hora_salida_temprano'  => $hora_salida_temprano,
                'marca_entrada_not_null' => $marca_entrada_not_null,
                'asistencia_fecha_hoy' => $asistencia_fecha_hoy,
                'marca_salida_not_null' => $marca_salida_not_null,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $currentTime = Carbon::now();

            Asistencia::create([
                'id_empleado' => Auth::id(),
                'marca_entrada' =>  $currentTime->toTimeString(),
                'fecha' => $currentTime->toDateTimeString(),
            ]);

            return to_route('asistencia.index')->with('status', 'Marca creada correctamente a las: ' . $currentTime->toDateTimeString());
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
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        try {
            $lastAsistencia = Asistencia::latest()->first();

            // dump($lastAsistencia->fecha);
            // die();
            if ($lastAsistencia) {
                $currentTime = Carbon::now();
                $lastAsistencia->update([
                    'marca_salida' =>  $currentTime->toTimeString(),
                ]);

                return redirect()->route('asistencia.index')->with('status', 'Marca de salida actualizada correctamente a las: ' . $currentTime->toDateTimeString());
            } else {
                return redirect()->route('asistencia.index')->with('error', 'No se encontraron registros de Asistencia para actualizar.');
            }
        } catch (QueryException $e) {
            // Handle database errors
            return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return redirect()->back()->with('error', 'Ha ocurrido un error inesperado: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function control()
    {
        try {
            $asistencias_info =  $this->get_asistencia();
            return view('asistencia.control', [
                'asistencias_info' => $asistencias_info
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
     * Display a listing of the resource.
     */
    public function get_asistencia()
    {
        try {
            $empleados = Empleado::all();
            $asistencias_info = [];

            foreach ($empleados as $empleado) {
                $horario_entrada = Carbon::parse($empleado->horario->hora_entrada);
                $asistencias = Asistencia::where('id_empleado', $empleado->id)
                    ->whereMonth('fecha', Carbon::now()->month)
                    ->get();

                $asistencias_totales = $asistencias->count();
                $asistencias_presentes = $asistencias->whereNotNull('marca_entrada')->whereNotNull('marca_salida')->count();
                $asistencias_ausentes = $asistencias->where('ausencia', true)->count();
                $asistencias_justificadas = $asistencias->where('justificada', true)->count();

                // Calcular asistencias con omisiones de marca o marcas tardías
                $omisiones_o_tardanzas = $asistencias->filter(function ($asistencia) use ($horario_entrada) {
                    if ($asistencia->marca_entrada) {
                        $marca_entrada = Carbon::parse($asistencia->marca_entrada);
                        return $marca_entrada->gt($horario_entrada);
                    }
                    return false;
                })->count();

                // Corregir la lógica para la ausencia
                $ausencia = $asistencias->whereNotNull('marca_entrada')->whereNotNull('marca_salida')->isEmpty();

                // Guardar la información en un array asociativo
                $asistencias_info[$empleado->nombre] = [
                    'total' => $asistencias_totales,
                    'presentes' => $asistencias_presentes,
                    'ausentes' => $asistencias_ausentes,
                    'justificadas' => $asistencias_justificadas,
                    'omisiones_o_tardanzas' => $omisiones_o_tardanzas,
                    'ausencia' => $ausencia // Agregar la ausencia calculada
                ];
            }

            return $asistencias_info;
        } catch (QueryException $e) {
            // Manejar errores de base de datos
            return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Manejar otros errores inesperados
            return redirect()->back()->with('error', 'Ha ocurrido un error inesperado: ' . $e->getMessage());
        }
    }
}
