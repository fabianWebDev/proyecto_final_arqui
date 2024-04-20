<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Horario;
use App\Models\Perfil;
use App\Models\Puesto;
use App\Models\User;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('empleado.empleado_table', [
                'empleados' => Empleado::latest()->get()
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
    public function viewPdf($empleado_id)
    {
        try {
            $empleado = Empleado::find($empleado_id);

            if (!$empleado) {
                return redirect()->back()->with('error', 'Empleado not found.');
            }

            return view('empleado.pdf', [
                'empleado' => $empleado,
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
            return view('empleado.agregar', [
                'departamentos' => Departamento::latest()->get(),
                'puestos' => Puesto::latest()->get(),
                'perfiles' => Perfil::latest()->get(),
                'horarios' => Horario::latest()->get(),
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // try {
        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->correo_electronico,
            'password' => Hash::make('soportepatitos2024'),
        ]);

        $userId = $user->id;

        $validated_empleado = $request->validate([
            'nombre' => ['required', 'min:5'],
            'cedula' => 'required',
            'fecha_ingreso' => 'required',
            'correo_electronico' => 'required',
            'id_departamento' => 'required',
            'id_perfil' => 'required',
            'id_puesto' => 'required',
            'id_horario' => 'required'
        ]);

        $validated_empleado['id_user'] = $userId;

        $empleado = Empleado::create($validated_empleado);

        $user->update([
            'id_empleado' => $empleado->id
        ]);

        return redirect()->route('empleado.index')->with('status', 'Empleado creado correctamente!');
        // } catch (QueryException $e) {
        //     // Handle database errors
        //     return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        // } catch (\Exception $e) {
        //     // Handle other unexpected errors
        //     return redirect()->back()->with('error', 'Ha ocurrido un error inesperado: ' . $e->getMessage());
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        try {
            return view('empleado.editar', [
                'empleado' => $empleado,
                'departamentos' => Departamento::latest()->get(),
                'puestos' => Puesto::latest()->get(),
                'perfiles' => Perfil::latest()->get(),
                'horarios' => Horario::latest()->get(),
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        try {
            $validated = $request->validate([
                'nombre' => ['required', 'min:5'],
                'fecha_ingreso' => 'required',
                'correo_electronico' => 'required',
                'id_departamento' => 'required',
                'id_perfil' => 'required',
                'id_puesto' => 'required',
                'id_horario' => 'required'
            ]);

            $empleado->update($validated);

            return to_route('empleado.index')->with('status', 'Empleado actualizado correctamente!');
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
    public function destroy(Empleado $empleado)
    {
        try {
            $empleado->delete();
            return to_route('empleado.index')->with('destroy', 'Empleado eliminado correctamente!');
        } catch (QueryException $e) {
            // Handle database errors
            return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return redirect()->back()->with('error', 'Ha ocurrido un error inesperado: ' . $e->getMessage());
        }
    }

    /**
     * Calculate the income tax based on the given income.
     * @param  float  $renta
     * @return float $impuestoTotal
     */
    private function calcularImpuestoRenta($renta)
    {
        $impuestoTotal = 0;

        // Escalas de impuesto
        $escalas = [
            ['limite' => 941000, 'porcentaje' => 0],
            ['limite' => 1381000, 'porcentaje' => 0.10],
            ['limite' => 2423000, 'porcentaje' => 0.15],
            ['limite' => 4845000, 'porcentaje' => 0.20],
            ['limite' => PHP_INT_MAX, 'porcentaje' => 0.25],
        ];

        // Calcular impuesto para cada tramo
        foreach ($escalas as $escala) {
            if ($renta <= $escala['limite']) {
                break;
            }

            $exceso = $renta - $escala['limite'];
            $impuesto = $exceso * $escala['porcentaje'];
            $impuestoTotal += $impuesto;
        }

        return $impuestoTotal;
    }

    // /**
    //  * Generate PDFs
    //  */
    // public function generate_pdf(Request $request, Empleado $empleado)
    // {
    //     try {
    //         $salario = $empleado->puesto->salario;
    //         $renta = $this->calcularImpuestoRenta($salario);
    //         $reduccion_caja = ($salario * 0.1067) / 2;
    //         $salario_neto = ($salario - ($reduccion_caja + $renta)) / 2;

    //         $pdf = Pdf::loadView('empleado.pdf', [
    //             'empleado' => $empleado,
    //             'renta' => $renta,
    //             'reduccion_caja'  => $reduccion_caja,
    //             'salario_neto' => $salario_neto,
    //         ]);

    //         // $pdfContent = $pdf->output();
    //         // $filePath = 'pdfs/' . uniqid() . '.pdf'; // Define the path and filename for the PDF file
    //         // Storage::disk('local')->put($filePath, $pdfContent);

    //         return $pdf->download();
    //     } catch (\Exception $e) {
    //         Log::error('Error generating PDF: ' . $e->getMessage());
    //         // Handle the error gracefully, e.g., return a response with an error message
    //         return response()->json(['error' => 'An error occurred while generating the PDF. Please try again later.'], 500);
    //     }
    // }

    // /**
    //  * Generate All PDFs
    //  */
    // public function generate_pdfs()
    // {
    //     try {
    //         $empleados = Empleado::latest()->get();
    //         $currentDate = Carbon::now()->timestamp;

    //         foreach ($empleados as $empleado) {
    //             $salario = $empleado->puesto->salario;
    //             $renta = $this->calcularImpuestoRenta($salario);
    //             $reduccion_caja = ($salario * 0.1067) / 2;
    //             $salario_neto = ($salario - ($reduccion_caja + $renta)) / 2;

    //             $pdf = Pdf::loadView('empleado.pdf', [
    //                 'empleado' => $empleado,
    //                 'renta' => $renta,
    //                 'reduccion_caja'  => $reduccion_caja,
    //                 'salario_neto' => $salario_neto,
    //             ]);

    //             $pdfContent = $pdf->output();
    //             $filePath = 'pdfs/' . 'Colilla de Pago - ' . $empleado->nombre . ' - ' . $currentDate . '.pdf';
    //             Storage::disk('local')->put($filePath, $pdfContent);
    //         }
    //         return redirect()->back();
    //     } catch (\Exception $e) {
    //         Log::error('Error generating PDF: ' . $e->getMessage());
    //         // Handle the error gracefully, e.g., return a response with an error message
    //         return response()->json(['error' => 'An error occurred while generating the PDF. Please try again later.'], 500);
    //     }
    // }

    public function generate_pdfs()
    {

        $empleados = Empleado::latest()->get();
        $currentDate = Carbon::now()->timestamp;
        $currentMonth = Carbon::now()->monthName;

        foreach ($empleados as $empleado) {
            $salario = $empleado->puesto->salario;
            $renta = $this->calcularImpuestoRenta($salario);
            $reduccion_caja = ($salario * 0.1067);
            $salario_neto = ($salario - ($reduccion_caja + $renta)) / 2;

            // Retrieve the asistencia information for the employee
            $asistencias_info = $this->get_asistencia($empleado);

            // Calculate the number of days worked (days not absent)
            $days_worked = $asistencias_info['presentes'] + $asistencias_info['justificadas'];
            $ausencias = $asistencias_info['ausentes'];

            // Calculate the salary based on the number of days worked
            $salary_based_on_days_worked = ($salario / 30) * $days_worked;

            $final_salary = $salary_based_on_days_worked - ((($reduccion_caja + $renta) / 30) * $days_worked);

            $pdf = Pdf::loadView('empleado.pdf', [
                'empleado' => $empleado,
                'renta' => $renta,
                'reduccion_caja'  => $reduccion_caja,
                'salario_neto' => $salario_neto,
                'days_worked' => $days_worked,
                'salary_based_on_days_worked' => $salary_based_on_days_worked,
                'final_salary' => $final_salary,
                'this_month' => $currentMonth,
                'ausencias' => $ausencias,
            ]);

            $pdfContent = $pdf->output();
            $filePath = 'pdfs/' . 'Colilla de Pago - ' . $empleado->nombre . ' - ' . $currentDate . '.pdf';
            Storage::disk('local')->put($filePath, $pdfContent);
        }
        return redirect()->back();
    }

    public function get_asistencia($empleado)
    {
        try {
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
            return [
                'total' => $asistencias_totales,
                'presentes' => $asistencias_presentes,
                'ausentes' => $asistencias_ausentes,
                'justificadas' => $asistencias_justificadas,
                'omisiones_o_tardanzas' => $omisiones_o_tardanzas,
                'ausencia' => $ausencia,
            ];
        } catch (QueryException $e) {
            // Manejar errores de base de datos
            return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Manejar otros errores inesperados
            return redirect()->back()->with('error', 'Ha ocurrido un error inesperado: ' . $e->getMessage());
        }
    }


    /**
     * Index Colillas
     */
    public function colillas_index(Empleado $empleado)
    {
        try {
            // Retrieve all PDF files from the storage directory
            $pdfFiles = collect(Storage::disk('local')->files('pdfs'))
                ->map(function ($file) {
                    return [
                        'filename' => basename($file), // Corrected file path
                        'path' => $file,
                    ];
                });

            return view('empleado.colillas', ['pdfFiles' => $pdfFiles]);
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());

            // Handle the error gracefully, e.g., return a response with an error message
            return response()->json(['error' => 'An error occurred while generating the PDF. Please try again later.'], 500);
        }
    }

    public function download($filename)
    {
        $filePath = 'pdfs/' . $filename;
        $exist = Storage::exists($filePath);
        if (Storage::exists($filePath)) {
            $fileSize = Storage::size($filePath);
            return Storage::download($filePath);
        } else {
            // Log an error or handle the situation when the file doesn't exist
            return response()->json(['error' => 'File not found'], 404);
        }
    }
}
