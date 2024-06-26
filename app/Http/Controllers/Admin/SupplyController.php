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

    public function __construct() {
        $this->middleware('can:admin.supplies.index')->only('index');
        $this->middleware('can:admin.supplies.edit')->only('edit', 'update');
        $this->middleware('can:admin.supplies.create')->only('store','create');
        $this->middleware('can:admin.supplies.destroy')->only('destroy');
        $this->middleware('can:admin.supplies.show')->only('show');

    }


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

        //return $request->all();



        $codigo_unico = [
            "code" => "unique:supplies|required",
            "name" => "required|string",
            "line" => "required|string",
            "detail" => "required|string",
            "brand" => "required|string",
            "unit" => "required|string",
            "observation" => "required",
            "cant" => "numeric|required"
        ];

        $arr = [
            'unidades',
            'kilogramos',
            'litros'
        ];

        $arr2 = ['parte', 'suministro', 'respuesto'];
        $observations_array = ["conforme", "con modificaciones"];


        $request->validate($codigo_unico);

        //return $request->all();
        //die();

        $supply = Supply::create([
            "unit" =>  $arr[$request->unit],
            "line" =>  $arr2[$request->line],
            "code" =>  $request->code,
            "name" =>  $request->name,
            "detail" =>  $request->detail,
            "brand" =>  $request->brand,
            "cant" =>  $request->cant,
            "observation" => $observations_array[$request->observation],
            "observation_detail" => $request->observation_detail
        ]);





        //ZONA DE CREACION DE HISTORIAL CUANDO SE INGRESA UN PRODUCTO

        if ($supply != null) {

            $observations_array = ["conforme", "con modificaciones"];

            $datos_nuevos = "\nCodigo :".$supply->code."\nNombre: ".$supply->name."\nDetalle: ".$supply->detail."\nLinea: ".$supply->line."\nMarca: ".$supply->brand."\nMedida: ".$supply->unit."\nCantidad: ".$supply->cant;

            $supply->histories()->create([

                "datos_antiguos" => "No registra",
                "datos_nuevos" => $datos_nuevos,
                "type" => "primer ingreso",
                "status" => $observations_array[$request->observation],
                "user_id" => auth()->user()->id,
                "status_detail" => $request->observation_detail

            ]);
        }



        return redirect()->route('admin.supplies.index')
            ->with('mensaje', 'Producto añadido correctamente')
            ->with('color', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supply $supply)
    {
        //MOSTRAR LA INFORMACION A DETALLE DEL PRODUCTO
        //JUNTO CON EL HISTORIAL DEL MISMO

        $histories = $supply->histories;

        return view("admin.supplies.show", compact("histories","supply"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supply $supply)
    {

        $arr = [
            'unidades',
            'kilogramos',
            'litros'
        ];
        $arr2 = ['parte', 'suministro', 'respuesto'];
        $observations_array = ["conforme", "con modificaciones"];


        $cod_unidad = array_search($supply->unit, $arr);
        $cod_linea = array_search($supply->line, $arr2);
        $observation_id = array_search($supply->observation, $observations_array);

        //return  $observation_id;

       // die();

        return view('admin.supplies.edit', compact('supply', 'cod_unidad', 'cod_linea','observation_id'));
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
            "cant" => "numeric|required",
            "observation" => "required"

        ];

        $codigo_nuevo = [
            "code" => "unique:supplies|required",
            "name" => "required|string",
            "line" => "required",
            "detail" => "required|string",
            "brand" => "required|string",
            "unit" => "required",
            "cant" => "numeric|required",
            "observation" => "required"
        ];

        $arr = [
            'unidades',
            'kilogramos',
            'litros'
        ];

        $arr2 = ['parte', 'suministro', 'respuesto'];




               // ZONA CUANDO SE HACE UNA ACTUALIZACION DE PRODUCTO

        if ($supply != null) {

            $observations_array = ["conforme", "con modificaciones"];
            $arr = [
                'unidades',
                'kilogramos',
                'litros'
            ];

            $arr2 = ['parte', 'suministro', 'respuesto'];

            //$cod_unidad = array_search($supply->unit, $arr);
            //$cod_linea = array_search($supply->line, $arr2);


            $datos_nuevos = "\nCodigo :".$request->code."\nNombre: ".$request->name."\nDetalle: ".$request->detail."\nLinea: ".$arr2[$request->line]."\nMarca: ".$request->brand."\nMedida: ".$arr[$request->unit]."\nCantidad: ".$request->cant;
            $datos_antiguos = "\nCodigo :".$supply->code."\nNombre: ".$supply->name."\nDetalle: ".$supply->detail."\nLinea: ".$supply->line."\nMarca: ".$supply->brand."\nMedida: ".$supply->unit."\nCantidad: ".$supply->cant;


            //Si hay actualizacion de cantidad

            $supply->histories()->create([
                "type" => "actualizacion",
                "datos_nuevos" => $datos_nuevos,
                "datos_antiguos" => $datos_antiguos,
                "user_id" => auth()->user()->id,
                "status" => $observations_array[$request->observation],
                "status_detail" => $request->observation_detail
            ]);
        }




        if ($request->code != $supply->code) {
            $request->validate($codigo_nuevo);

            //$supply->update($request->all());

            $supply->line = $arr2[$request->line];
            $supply->unit = $arr[$request->unit];
            $supply->code = $request->code;
            $supply->name = $request->name;
            $supply->detail = $request->detail;
            $supply->brand = $request->brand;
            $supply->cant = $request->cant;
            $supply->observation_detail = $request->observation_detail;
            $supply->observation = $observations_array[$request->observation];
            $supply->save();



            return redirect()->route('admin.supplies.index')
                ->with('mensaje', 'Producto editado correctamente')
                ->with('color', 'success');
        }

        $request->validate($codigo_igual);

        $supply->line = $arr2[$request->line];
        $supply->unit = $arr[$request->unit];
        $supply->code = $request->code;
        $supply->name = $request->name;
        $supply->detail = $request->detail;
        $supply->brand = $request->brand;
        $supply->cant = $request->cant;
        $supply->observation_detail = $request->observation_detail;
        $supply->observation = $observations_array[$request->observation];
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


        if ($supply != null) {

            $observations_array = ["conforme", "con modificaciones"];

            $datos_antiguos = "\nCodigo :".$supply->code."\nNombre: ".$supply->name."\nDetalle: ".$supply->detail."\nLinea: ".$supply->line."\nMarca: ".$supply->brand."\nMedida: ".$supply->unit."\nCantidad: ".$supply->cant;

            $supply->histories()->create([
                "datos_antiguos" => $datos_antiguos,
                "datos_nuevos" => "No registra",
                "type" => "eliminacion",
                "status" => $supply->observation,
                "user_id" => auth()->user()->id,
                "status_detail" => $supply->observation_detail

            ]);
        }


        $supply->update(["status" => "baja"]);

        return redirect()->route('admin.supplies.index')
            ->with('mensaje', 'Producto eliminado correctamente')
            ->with('color', 'danger');
    }



}
