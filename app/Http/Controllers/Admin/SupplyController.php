<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supply;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplies = Supply::where('status', 'alta')->get();

        return view("admin.supplies.index", compact('supplies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.supplies.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $codigo_unico = [
            "code" => "unique:supplies|required",
            "name" => "required|string",
            "line" => "required|string",
            "detail" => "required|string",
            "brand" => "required|string",
            "unit" => "required|string",
            "price" => "numeric|required",
            "cant" => "numeric|required"
        ];


        $arr = [
            'globales',
            'metros',
            'centimetros',
            'milimetros',
            'toneladas',
            'kilogramos',
            'gramos',
            'litros',
            'mililitros',
            'metros cuadrados',
            'metros cúbicos',
        ];

        $arr2 = ['parte', 'suministro', 'respuesto'];



        $request->validate($codigo_unico);

        $supply = Supply::create([
            "unit" =>  $arr[$request->unit],
            "line" =>  $arr2[$request->line],
            "code" =>  $request->code,
            "name" =>  $request->name,
            "detail" =>  $request->detail,
            "brand" =>  $request->brand,
            "price" =>  $request->price,
            "cant" =>  $request->cant
        ]);

        return redirect()->route('admin.supplies.index')
            ->with('mensaje', 'Producto añadido correctamente')
            ->with('color', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supply $supply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supply $supply)
    {

        $arr = [
            'globales',
            'metros',
            'centimetros',
            'milimetros',
            'toneladas',
            'kilogramos',
            'gramos',
            'litros',
            'mililitros',
            'metros cuadrados',
            'metros cúbicos',
        ];

        $arr2 = ['parte', 'suministro', 'respuesto'];

        $cod_unidad = array_search($supply->unit, $arr);
        $cod_linea = array_search($supply->line, $arr2);

        return view('admin.supplies.edit', compact('supply', 'cod_unidad', 'cod_linea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supply $supply)
    {
        $codigo_igual = [
            "code" => "required",
            "name" => "required|string",
            "line" => "required",
            "detail" => "required|string",
            "brand" => "required|string",
            "unit" => "required",
            "price" => "numeric|required",
            "cant" => "numeric|required"
        ];

        $codigo_nuevo = [
            "code" => "unique:supplies|required",
            "name" => "required|string",
            "line" => "required",
            "detail" => "required|string",
            "brand" => "required|string",
            "unit" => "required",
            "price" => "numeric|required",
            "cant" => "numeric|required"
        ];

        $arr = [
            'globales',
            'metros',
            'centimetros',
            'milimetros',
            'toneladas',
            'kilogramos',
            'gramos',
            'litros',
            'mililitros',
            'metros cuadrados',
            'metros cúbicos',
        ];

        $arr2 = ['parte', 'suministro', 'respuesto'];

        //return $arr[$request->unit] . " ". $arr2[$request->line];
        //die();
        //return $request->all();

        //die();


        if ($request->code != $supply->code) {
            $request->validate($codigo_nuevo);

            //$supply->update($request->all());

            $supply->line = $arr2[$request->line];
            $supply->unit = $arr[$request->unit];
            $supply->code = $request->code;
            $supply->name = $request->name;
            $supply->detail = $request->detail;
            $supply->brand = $request->brand;
            $supply->price = $request->price;
            $supply->cant = $request->cant;
            $supply->save();



            return redirect()->route('admin.supplies.index')
                ->with('mensaje', 'Producto editado correctamente')
                ->with('color', 'success');
        }

        //return $request->all();
        $request->validate($codigo_igual);

        $supply->line = $arr2[$request->line];
        $supply->unit = $arr[$request->unit];
        $supply->code = $request->code;
        $supply->name = $request->name;
        $supply->detail = $request->detail;
        $supply->brand = $request->brand;
        $supply->price = $request->price;
        $supply->cant = $request->cant;
        $supply->save();

        return redirect()->route('admin.supplies.index')
            ->with('mensaje', 'Producto editado correctamente')
            ->with('color', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supply $supply)
    {
        $supply->update(["status" => "baja"]);

        return redirect()->route('admin.supplies.index')
            ->with('mensaje', 'Producto eliminado correctamente')
            ->with('color', 'danger');
    }
}
