<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('status','alta')->get();

        return view("admin.users.index", compact("users"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "email" => "required|string|email|max:100|unique:users",
            "password" => "required|string",
            "nombre" => "required|string",
            "apellido" => "required|string",
            "phone" => "numeric|required|unique:profiles|digits:9",
            "dni" => "required|string|max:8",
            "direccion" => "required|max:100",
        ]);

        $user = User::create([
            "name" => $request->nombre,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);


        $user->profile()->create(
            [
                "name" => $request->nombre,
                "lastname" => $request->apellido,
                "dni" => $request->dni,
                "address" => $request->direccion,
                "phone" => $request->phone,

            ]
        );

       /*  //si se marco el rol de admin
        if ($request->rol_id) {
            // 1 = id admin
            $user->roles()->sync(1);
        } */

        return redirect()->route('admin.users.index')
        ->with('mensaje', 'Usuario creado correctamente')
        ->with('color', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $sin = [ //no se modifica correo ni contraseña
            "email" => "required|string|email|max:100",
            "name" => "required|string",
            "lastname" => "required|string",
            "phone" => "numeric|required|min:9",
            "dni" => "required|string|max:8",
            "address" => "required|max:100"
        ];

        //Cuando se realizan cambios en la contraseña solamente
        $con = [
            "email" => "required|string|email|max:100",
            "password" => "required|string",
            "name" => "required|string",
            "lastname" => "required|string",
            "dni" => "required|string|max:8",
            "address" => "required|max:100",
        ];

        //si se modifica solo el correo
        $con_correo = [
            "email" => "required|string|email|max:100|unique:users",
            "name" => "required|string",
            "lastname" => "required|string",
            "dni" => "required|string|max:8",
            "address" => "required|max:100",
        ];


        //si se modifica solo el telefono





    //si el correo y el request que llega son iguales, quiere decir que no se modifico el correo
    if ($user->email == $request->email) {

            if ($request->password == "") {

                //validacion sin password, ya que no se presentaron cambios en la contraseña
                $request->validate($sin);

                //actualiza solo modelo user
                $user->update(['name' => $request->name, 'email' => $request->email]);
            } else {

                //validacion con cambios realizados en la contraseña
                $request->validate($con);

                //Actualiza solo modelo user
                $user->update(['name' => $request->name,
                                'email' => $request->email,
                                'password' => bcrypt($request->password)]);
            }
        } else { //en cambio haya cambios en el correo
            $request->validate($con_correo);
        }



    //si el telefono y el request que llega son iguales, quiere decir que no se modifico el celular

    if($user->profile->phone != $request->phone){

            $request->validate([
                "phone"=> "numeric|required|digits:9|unique:profiles",
            ]);

    }


        //actualiza solo el modelo profile
        $user->profile->update($request->only("name", "lastname", "dni", "address","phone"));




      /*   if ($request->roles) { // si esta marcado
            // 1 = id admin

            if ($user->roles->isEmpty()) { //EN CASO NO EXISTA LA RELACION
                $user->roles()->sync(1);

            } else {

                foreach ($user->roles as $role) {   // si el usuario a editar era un docente
                                                    // mantiene el docente y se añade el admin
                    if ($role->id == 2) {
                        $user->roles()->sync([2, 1]);
                    }

                    if ($role->id == 3) {
                        return redirect()->route('admin.users.edit', $user)->with('mensaje', 'El usuario es un alumno, no se puede convertir en admin');
                    }
                }
            }


        } else { // si no esta marcado // LE ESTAMOS QUITANDO EL ROL DE DOCENTE
            foreach ($user->roles as $role) {
                // si el usuario a editar era un docente
                // mantiene el docente y se quita el admin
                if ($role->id == 2) {
                    $user->roles()->sync(2);
                }
            }
        } */

        return redirect()
        ->route('admin.users.edit', $user)
        ->with('mensaje', 'El usuario ha sido modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //echo "no se debe borrar";
        /*      echo auth()->user()->id ." " . $user->id;
        die(); */

        if (auth()->user()->id == $user->id) {

            return redirect()->route('admin.users.index')
                ->with('mensaje', 'No puedes eliminarte a tí mismo')
                ->with('color','danger');

            die();
            }

        else
        {

            $user->update(["status"=>"baja"]);

            return redirect()->route('admin.users.index')
                ->with('mensaje', 'Usuario eliminado correctamente')
                ->with('color','success');
        }


    }
}
