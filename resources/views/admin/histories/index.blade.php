@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

@section('content_header')
    <h1>Historial de movimientos de Repuestos</h1>
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
            {{-- <a href="{{ route('admin.supplies.create') }}" class="btn btn-primary"> Ingresar nuevo producto</a> --}}
        </div>

        <div class="card-body">
            <table id="tabla" class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Repuesto</th>
                        <th>Cod. Prod</th>
                        <th>Marca</th>
                        <th>Estado</th>
                        <th>Tipo</th>
                        <th>Fecha de actualizacion</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($histories as $his)
                        <tr>
                            <td>{{ $his->id }}</td>
                            <td>{{ $his->supply->name }}</td>
                            <td>{{ $his->supply->code }}</td>
                            <td>{{ $his->supply->brand}}</td>
                            <td>{{ $his->status }}</td>
                            <td>{{ $his->type}}</td>
                            <td>{{ $his->created_at->format('d-m-Y g:i a') }}</td>
                            <td>
                                {{-- Ver --}}
                                <a href="{{ route('admin.histories.show', $his) }}" class="btn btn-primary">Ver</a>

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
