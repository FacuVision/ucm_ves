@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

@section('content_header')
    <h1>Vehículos</h1>
    @include('admin.partials.css_datatables')
@stop

@section('content')

    <div class="card">
        @if (session('mensaje'))
            <div class='alert alert-{{ session('color') }}'>
                <strong>{{ session('mensaje') }}</strong>
            </div>
        @endif
        @can('admin.cars.create')
            <div class="card-header">
                <a href="{{ route('admin.cars.create') }}" class="btn btn-primary btn-sm"> Ingresar Vehículo</a>
            </div>
        @endcan

        <div class="card-body">
            <table id="tabla" class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>placa</th>
                        <th>tipo</th>
                        <th>marca</th>
                        <th>color</th>
                        <th>kilometraje</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                        <tr>
                            <td>{{ $car->id }}</td>
                            <td>{{ $car->plate }}</td>
                            <td>{{ $car->type }}</td>
                            <td>{{ $car->brand }}</td>
                            <td>{{ $car->color }}</td>
                            <td>{{ $car->mileage }}</td>
                            <td>

                                @can('admin.cars.show')
                                {{-- Mostrar --}}
                                <a href="{{ route('admin.cars.show', $car) }}" class="btn btn-primary btn-sm btn-sm">Detalle y Salidas</a>
                                @endcan

                                {{-- Editar --}}
                                @can('admin.cars.edit')

                                <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-success btn-sm">Editar</a>
                                @endcan

                                {{-- Eliminar --}}
                                @can('admin.cars.destroy')

                                <form style="display: inline" action="{{ route('admin.cars.destroy', $car) }}"
                                    method="post" class="formulario-eliminar"
                                    onsubmit="return confirm('¿Está seguro que quiere eliminar este registro?')">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" id="delete" value="Eliminar" class="btn btn-danger btn-sm">
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

    {{-- <script type="text/javascript">
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estas seguro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, Borrar'
            }).then((result) => {
                if (result.isConfirmed) {
/*                     Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ) */
                    this.submit();
                }
            })
        });
    </script> --}}
    @include('admin.partials.js_datatables copy')

@stop
