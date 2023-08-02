@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

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

        @can('admin.users.create')
            <div class="card-header">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary"> Crear Usuario</a>
            </div>
        @endcan

        <div class="card-body">
            <table id="tabla" class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha de Creación</th>
                        <th>Roles &nbsp;&nbsp;</th>
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
                                @foreach ($user->roles as $role)
                                    @switch($role->name)
                                        @case($role->name == 'super_admin')
                                            <span class="badge badge-warning">
                                                {{ $role->name }}
                                            </span>
                                        @break

                                        @case($role->name == 'admin')
                                            <span class="badge badge-primary">
                                                {{ $role->name }}
                                            </span>
                                        @break

                                        @case($role->name == 'usuario')
                                            <span class="badge badge-secondary">
                                                {{ $role->name }}
                                            </span>
                                        @break
                                    @endswitch
                                @endforeach

                            </td>
                            <td>
                                @can('admin.users.show')
                                    {{-- Mostrar --}}
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-primary">Ver</a>
                                @endcan

                                {{-- Editar --}}

                                @can('admin.users.destroy')
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-success">Editar</a>
                                @endcan

                                @can('admin.users.destroy')
                                    {{-- Eliminar --}}

                                    <form style="display: inline" action="{{ route('admin.users.destroy', $user) }}"
                                        method="post" class="formulario-eliminar"
                                        onsubmit="return confirm('¿Está seguro que quiere eliminar este registro?')">

                                        @csrf
                                        @method('DELETE')

                                        <input type="submit" id="delete" value="Eliminar" class="btn btn-danger">
                                    </form>
                                @endcan
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
