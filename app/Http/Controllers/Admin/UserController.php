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
        $users = User::all();
        return view("admin.users.index", compact("users"));
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
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

            $user->delete();
            return redirect()->route('admin.users.index')
                ->with('mensaje', 'Usuario eliminado correctamente')
                ->with('color','success');
        }


        //$user->delete()


    }
}
