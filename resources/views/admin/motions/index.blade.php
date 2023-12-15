@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

@section('content_header')
    <h1>Salidas de Repuestos</h1>
    @include('admin.partials.css_datatables')
@stop

@section('content')

    <div class="card">
        @if (session('mensaje'))
            <div class='alert alert-{{ session('color') }}'>
                <strong>{{ session('mensaje') }}</strong>
            </div>
        @endif

        @can('admin.motions.create')
            <div class="card-header">
                <a href="{{ route('admin.motions.create') }}" class="btn btn-primary btn-sm">Registrar salida</a>
            </div>
        @endcan

        <div class="card-body">
            <table id="tabla" class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        {{-- <th>Id</th> --}}
                        <th>Tipo</th>
                        <th>Vehículo placa</th>
                        <th>Fecha de salida</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($motions as $motion)
                        <tr>
                            {{-- <td>{{ $motion->id }}</td> --}}
                            <td>{{ $motion->type}}</td>
                            <td>{{ $motion->car->plate }}</td>
                            <td>{{ $motion->created_at->format('d-m-Y g:i a') }}</td>
                            <td>
                                @can('admin.motions.show')
                                {{-- Mostrar --}}
                                <a href="{{ route('admin.motions.show', $motion) }}" class="btn btn-primary btn-sm">Ver detalle</a>

                                @endcan
                                {{-- Editar --}}

                                {{-- <a href="{{ route('admin.motions.edit', $motion) }}" class="btn btn-success btn-sm">Editar</a> --}}

                                @can('admin.motions.show')
                                    {{-- Eliminar --}}
                                    <form style="display: inline" action="{{ route('admin.motions.destroy', $motion) }}"
                                        method="post" class="formulario-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" id="delete" value="Datos del vehículo" class="btn btn-warning btn-sm">
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
