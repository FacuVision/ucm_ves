<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motion;
use App\Models\Car;
use App\Models\Supply;
use Illuminate\Http\Request;

class MotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motions = Motion::all();
        return view("admin.motions.index", compact("motions"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $select_supply = Supply::all()->where("status","<>","baja");
        $carros = Car::all()->where("status","<>","baja");


        foreach ($select_supply as $key) {
          $array[$key->id] = $key->name ." - ". $key->brand. "- Cod. ".$key->code." - S/. ". $key->price;
        }

        foreach ($carros as $carro) {
            $array_vehiculos[$carro->id] = $carro->type ." - Marca: ". $carro->brand. "- N° Placa ".$carro->plate." - Color : ". $carro->color;
        }

        $select_vehiculos = $array_vehiculos;
        $select_supply = $array;

      //return $array;




        return view("admin.motions.create", compact("select_supply", "select_vehiculos"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            "hiden_json" => "required",
        ]);

        return $request->all();


        //EN CASO SE ENVIE UN LISTADO SIN PRODUCTOS
        $lista_productos = json_decode($request->hiden_json);

        if ($lista_productos == null) {
            return redirect()->route('admin.motions.create')->with('error', 'Las actividades no pueden estar vacias');
        }


        $array = [];

        foreach ($lista_productos as $producto => $value) {
           $array[$producto] = $value;
        }

        return $array;
        die();
        //PENDIENTE HACER LA INSERCION
        foreach ($array as $prod) {

            Actividad::create([
                "descripcion" => $act->descripcion,
                "puntaje_max" => $act->puntaje_max,
                "tipo" => $act->tipo,
                "tarea_id" => $request->tarea_id,
                "recurso" => $act->recurso
            ]);
        }




        // $sumatotal = 0;

        // foreach ($array as $act) {

        //     $sumatotal = $sumatotal + $act->puntaje_max;
        // }

        // if ($sumatotal != 20) {
        //     return redirect()->route('admin.actividades.show', $tarea)->with('error', 'La suma de los puntajes deben de ser de 20 pts');
        // }




        return redirect()->route('admin.tareas.show', compact("tarea", "carpeta"))->with('mensaje_act', 'Actividades creadas correctamente');

        //return $lista_productos;

        //return $request->all();
    }

    /**
     * Display the specified resource.
     */
    public function show(Motion $motion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motion $motion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motion $motion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motion $motion)
    {
        //
    }
}
