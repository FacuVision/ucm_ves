<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //return view("admin.histories.index")
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(History $history)
    {

        //INOFRMACION PARA MOSTRAR DESDE EL REPORTE DE HISTORIAL
        // $arr = [
        //     'globales',
        //     'metros',
        //     'centimetros',
        //     'milimetros',
        //     'toneladas',
        //     'kilogramos',
        //     'gramos',
        //     'litros',
        //     'mililitros',
        //     'metros cuadrados',
        //     'metros cúbicos',
        // ];

        // $arr2 = ['parte', 'suministro', 'respuesto'];
        // $arr3 = ["actualizacion", "primer ingreso","salida","eliminacion"];

        // //OBTENEMOS LAS POSICIONES DE LAS SELECCIONES
        // $cod_unidad = array_search($supply->unit, $arr);
        // $cod_linea = array_search($supply->line, $arr2);
        // $cod_estado_ingreso = array_search($supply->line, $arr3);

        return view("admin.histories.show", compact('history'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(History $history)
    {
        //
    }
}
