<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            return view('departamento.index', [
                'departamentos' => Departamento::latest()->get(),
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
            return view('departamento.agregar');
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
            ]);

            Departamento::create($validated);

            return to_route('departamento.index')->with('status', 'Departamento creado correctamente!');
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
    public function show(Departamento $departamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departamento $departamento)
    {

        try {
            return view('departamento.editar', [
                'departamento' => $departamento,
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
    public function update(Request $request, Departamento $departamento)
    {
        try {
            $validated = $request->validate([
                'nombre' => ['required', 'min:2'],
            ]);

            $departamento->update($validated);

            return to_route('departamento.index')->with('status', 'Departamento actualizado correctamente!');
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
    public function destroy(Departamento $departamento)
    {
        try {
            $departamento->delete();

            return to_route('departamento.index')->with('destroy', 'Departamento eliminado correctamente!');
        } catch (QueryException $e) {
            // Handle database errors
            return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return redirect()->back()->with('error', 'Ha ocurrido un error inesperado: ' . $e->getMessage());
        }
    }
}
