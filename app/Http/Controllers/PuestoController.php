<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('puesto.index', [
                'puestos' => Puesto::latest()->get(),
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
            return view('puesto.agregar');
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
        try {
            $validated = $request->validate([
                'nombre' => ['required', 'min:2'],
                'salario' => 'required',
            ]);

            Puesto::create($validated);

            return to_route('puesto.index')->with('status', 'Puesto creado correctamente!');
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
    public function show(Puesto $puesto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Puesto $puesto)
    {
        try {
            return view('puesto.editar', [
                'puesto' => $puesto,
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
    public function update(Request $request, Puesto $puesto)
    {
        try {
            $validated = $request->validate([
                'nombre' => ['required', 'min:2'],
                'salario' => 'required'
            ]);

            $puesto->update($validated);

            return to_route('puesto.index')->with('status', 'Puesto actualizado correctamente!');
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
    public function destroy(Puesto $puesto)
    {
        try {
            $puesto->delete();
            return to_route('puesto.index')->with('destroy', 'Puesto eliminado correctamente!');
        } catch (QueryException $e) {
            // Handle database errors
            return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return redirect()->back()->with('error', 'Ha ocurrido un error inesperado: ' . $e->getMessage());
        }
    }
}
