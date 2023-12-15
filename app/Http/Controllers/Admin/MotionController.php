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


     public function __construct() {
        $this->middleware('can:admin.motions.index')->only('index');
        $this->middleware('can:admin.motions.edit')->only('edit', 'update');
        $this->middleware('can:admin.motions.create')->only('store','create');
        $this->middleware('can:admin.motions.destroy')->only('destroy');
        $this->middleware('can:admin.motions.show')->only('show');

    }



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
        //HACEMOS LA Busqueda de informacion de los campos y almacenamos en los arrays
        //los que no esten de baja
        $select_supply = Supply::all()->where("status", "<>", "baja");
        $carros = Car::all()->where("status", "<>", "baja");
        $array = [];
        $array_vehiculos = [];

        //crearemos un array especial para recorrerlos dentro de los select de la vista
        foreach ($select_supply as $key) {
            $array[$key->id] = $key->name . " - " . $key->brand . " - Cod. " . $key->code . " - Stock: " . $key->cant;
        }

        foreach ($carros as $carro) {
            $array_vehiculos[$carro->id] = $carro->type . " -
            N° Placa " . $carro->plate . " -
            Marca: " . $carro->brand . " -
            Kilometraje : " . $carro->mileage;
        }

        //finalmente asignamos en otra variable para mejor nombre
        $select_vehiculos = $array_vehiculos;
        $select_supply = $array;


        return view("admin.motions.create", compact("select_supply", "select_vehiculos"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->detail_h == null) {

            $request->validate([
                "hiden_json" => "required",
                "title_h" => "required|string",
                "detail_h" => "required|string",
                "id_car_h" => "required",
            ]);
        }

        //return $request->all();
        //EN CASO SE ENVIE UN LISTADO SIN PRODUCTOS
        $lista_productos = json_decode($request->hiden_json);

        if ($lista_productos == null) {
            return back()->with('error', 'La lista de productos no puede estar vacia')->with('detail',$request->detail_h);
        }

        if ($request->new_km_h < 0) {
            return back()->with('error', 'Los valores de kilometraje no pueden ser negativos')->with('detail',$request->detail_h);
        }



        //hacemos la creacion del movimiento
       // die();

        $observations_array = ["conforme", "con modificaciones"];
        $array_unidades = [
            'unidades',
            'kilogramos',
            'litros'
        ];

        $lineas_array = ['parte', 'suministro', 'respuesto'];


        //CREACION DE MOVIMIENTO


        $recient_motion = Motion::create([
            "user_id" => auth()->user()->id,
            "car_id" => $request->id_car_h,
            "type" =>  $request->title_h,
            "detail" =>  $request->detail_h
        ]);




        //VERIFICAMOS LA CANTIDAD Y EL STOCK
        foreach ($lista_productos as $key) {

            $producto = Supply::where("id", $key->supply_id)->get();

            if ($key->cant > $producto[0]->cant) {

                $recient_motion->delete();

                return redirect()->route('admin.motions.index')
                    ->with('mensaje', 'No hay Stock disponible para el producto seleccionado')
                    ->with('color', 'danger');
            }
        }

        //ACTUALIZAMOS EL VALOR DEL AUTO AL NUEVO KILOMETRAJE

        if ($request->new_km_h != null) {

            $car = Car::find($request->id_car_h);

            $car->update([
                "mileage" => $request->new_km_h,
                "old_mileage" => $car->mileage
            ]);
        }



        //REALIZAMOS LA INSERCION DE LOS PRODUCTOS Y EL MOVIMIENTO
        foreach ($lista_productos as $key) {

            $producto = Supply::where("id", $key->supply_id)->get();

            $recient_motion->supplies()->attach(
                $key->supply_id,
                [
                    "cant" => $key->cant
                ]
            );

            Supply::where("id", $key->supply_id)->update([
                "cant" => ($producto[0]->cant - $key->cant)
            ]);

            $datos_antiguos = "\nCodigo de producto :".$producto[0]->code."\nNombre: ".$producto[0]->name."\nDetalle: ".$producto[0]->detail."\nLinea: ".$producto[0]->line."\nMarca: ".$producto[0]->brand."\nMedida: ".$producto[0]->unit."\nCantidad: ".$producto[0]->cant;
            $datos_nuevos = "\nCodigo de producto :".$producto[0]->code."\nNombre: ".$producto[0]->name."\nDetalle: ".$producto[0]->detail."\nLinea: ".$producto[0]->line."\nMarca: ".$producto[0]->brand."\nMedida: ".$producto[0]->unit."\nCantidad: ".$producto[0]->cant - $key->cant;

            $producto[0]->histories()->create([
                "type" => "salida",
                "datos_nuevos" => $datos_nuevos,
                "datos_antiguos" => $datos_antiguos,
                "user_id" => auth()->user()->id,
                "status" => $producto[0]->observation
            ]);

            $producto = null;
        }





        return redirect()->route('admin.motions.index')
            ->with('mensaje', 'Movimiento creado correctamente')
            ->with('color', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Motion $motion)
    {
        $supplies_motions = $motion->supplies;

        //return $supplies_motions[0];

        $productos = [];
        foreach ($supplies_motions as $sm) {

            array_push(
                $productos,
                [
                    "id" => $sm->id,
                    "code" => $sm->code,
                    "name" => $sm->name,
                    "brand" => $sm->brand,
                    "cant" => $sm->pivot->cant,
                    "" => $sm->pivot->cant * $sm->pivot->motion_price
                ]
            );
        }

        // $suma = 0;
        // foreach ($productos as $prod) {
        //     $suma = $suma + $prod["subtotal"];
        // }

        return view("admin.motions.show", compact("supplies_motions", "motion", "productos"));
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
        //VER DETALLES DEL VEHÍCULO
        return redirect()->route('admin.cars.show', $motion->car_id);
    }
}
