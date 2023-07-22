@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Movimientos de Salida</h1>
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
            <a href="{{ route('admin.motions.create') }}" class="btn btn-primary"> Ingresar Movimiento</a>
        </div>

        <div class="card-body">
            <table id="tabla" class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Vehículo placa</th>
                        <th>Fecha de movimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($motions as $motion)
                        <tr>
                            <td>{{ $motion->id }}</td>
                            <td>{{ $motion->title }}</td>
                            <td>{{ $motion->car->plate}}</td>
                            <td>{{ $motion->created_at}}</td>
                            <td>
                                {{-- Mostrar --}}
                                <a href="{{ route('admin.motions.show', $motion) }}" class="btn btn-primary">Ver detalle</a>

                                {{-- Editar --}}

                                <a href="{{ route('admin.motions.edit', $motion) }}" class="btn btn-success">Editar</a>


                                {{-- Eliminar --}}
                                <form style="display: inline" action="{{ route('admin.motions.destroy', $motion) }}"
                                    method="post" class="formulario-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" id="delete" value="Datos del vehículo" class="btn btn-warning">
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
