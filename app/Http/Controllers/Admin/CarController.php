<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct() {
        $this->middleware('can:admin.cars.index')->only('index');
        $this->middleware('can:admin.cars.edit')->only('edit', 'update');
        $this->middleware('can:admin.cars.create')->only('store','create');
        $this->middleware('can:admin.cars.destroy')->only('destroy');
        $this->middleware('can:admin.cars.show')->only('show');

    }

    public function index()
    {
        $cars = Car::where('status','alta')->get();
        return view("admin.cars.index", compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.cars.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $con_placa = [
            "plate" => "required|string|max:8|unique:cars",
            "type" => "required|string",
            "color" => "required|string",
            "brand" => "required|string",
            "mileage" => "numeric|required",
            "model" => "required|string"
        ];


        $request->validate($con_placa);

        Car::create($request->all());

        return redirect()->route('admin.cars.index')
        ->with('mensaje', 'Vehículo creado correctamente')
        ->with('color', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car) //VER MOVIMIENTOS DETALLADOS DEL VEHÍCULO
    {
        $car_movimientos = $car->motions;
        return view("admin.cars.show", compact("car_movimientos","car"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view("admin.cars.edit", compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {

        $con_placa = [
            "plate" => "required|string|max:8|unique:cars",
            "type" => "required|string",
            "color" => "required|string",
            "brand" => "required|string",
            "mileage" => "numeric|required",
            "model" => "required|string"
        ];

        $sin_placa = [
            "plate" => "required|string|max:8",
            "type" => "required|string",
            "color" => "required|string",
            "brand" => "required|string",
            "mileage" => "numeric|required",
            "model" => "required|string"
        ];



        //Si son distintos, quiere decir que se hizo un cambio
        if($request->plate != $car->plate){

            $request->validate($con_placa);

        } else {

            $request->validate($sin_placa);

        }

        $car->update($request->all());

        return redirect()
        ->route('admin.cars.edit', $car)
        ->with('color', 'success')
        ->with('mensaje', 'El vehículo ha sido modificado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->update(["status" => "baja"]);
        return redirect()
        ->route('admin.cars.index')
        ->with('color', 'danger')
        ->with('mensaje', 'El vehículo se ha eliminado correctamente');
    }
}
