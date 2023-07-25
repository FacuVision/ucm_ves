@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Usuarios</h1>
    @include('admin.partials.css_datatables')
@stop

@section('content')

    <div class="card">
        @if (session('mensaje'))
            <div class='alert alert-{{ session('color') }}'>
                <strong>{{ session('mensaje') }}</strong>
            </div>
        @endif

        <div class="card-header">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary"> Crear Usuario</a>
        </div>

        <div class="card-body">
            <table id="tabla" class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha de Creación</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d-m-Y g:i a') }}</td>
                            <td>
                                {{-- Mostrar --}}
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-primary">Ver</a>

                                {{-- Editar --}}

                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-success">Editar</a>


                                {{-- Eliminar --}}

                                <form style="display: inline" action="{{ route('admin.users.destroy', $user) }}"
                                    method="post" class="formulario-eliminar" onsubmit="return confirm('¿Está seguro que quiere eliminar este registro?')" >

                                    @csrf
                                    @method('DELETE')

                                    <input type="submit" id="delete" value="Eliminar" class="btn btn-danger">


                                    {{-- <button type="button"  class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete{{ $user->id }}">
                                        Eliminar
                                    </button> --}}

                                    {{-- <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel">
                                        @include('admin.partials.modal_eliminar')
                                    </div> --}}
                                </form>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">


@stop

@section('js')
    @include('admin.partials.js_datatables copy')

@stop
