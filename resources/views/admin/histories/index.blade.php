@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Historial de movimientos de productos</h1>
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
            <a href="{{ route('admin.supplies.create') }}" class="btn btn-primary"> Ingresar nuevo producto</a>
        </div>

        <div class="card-body">
            <table id="tabla" class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre Producto</th>
                        <th>Responsable</th>
                        <th>Dni</th>
                        <th>Detalle</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $his)
                        <tr>
                            <td>{{$his->id}}</td>
                            <td>{{$his->supply->name}}</td>
                            <td>{{$supply->name}}</td>
                            <td>{{$supply->detail}}</td>
                            <td>{{$supply->line}}</td>
                            <td>{{$supply->brand}}</td>
                            <td>{{$supply->unit}}</td>
                            <td>{{$supply->price}}</td>
                            <td>{{$supply->cant}}</td>
                            <td>

                                {{-- Editar --}}
                                <a href="{{ route('admin.supplies.edit', $supply) }}" class="btn btn-success">Editar</a>
                                {{-- Eliminar --}}
                                <form style="display: inline" action="{{ route('admin.supplies.destroy', $supply) }}"
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
