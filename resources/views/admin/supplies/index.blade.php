@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Suministros</h1>
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
            <a href="{{ route('admin.cars.create') }}" class="btn btn-primary"> Ingresar nuevo suministro</a>
        </div>

        <div class="card-body">
            <table id="tabla" class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Línea</th>
                        <th>Marca</th>
                        <th>Unidad</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                {{-- Mostrar --}}
                                <a href="{{ route('admin.cars.show', $car) }}" class="btn btn-primary">Movimientos</a>

                                {{-- Editar --}}

                                <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-success">Editar</a>


                                {{-- Eliminar --}}
                                <form style="display: inline" action="{{ route('admin.cars.destroy', $car) }}"
                                    method="post" class="formulario-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" id="delete" value="Eliminar" class="btn btn-danger">
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

    <script type="text/javascript">
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
    </script>
    @include('admin.partials.js_datatables copy')

@stop
