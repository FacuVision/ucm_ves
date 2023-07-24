@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Productos</h1>
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
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Línea</th>
                        <th>Marca</th>
                        <th>Observacion</th>
                        <th>Costo</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supplies as $supply)
                        <tr>
                            <td>{{ $supply->id }}</td>
                            <td>{{ $supply->code }}</td>
                            <td>{{ $supply->name }}</td>
                            <td>{{ $supply->line }}</td>
                            <td>{{ $supply->brand }}</td>

                            @if ($supply->observation == 'conforme')
                                <td style="font-weight: bold; color:green">{{ $supply->observation }}</td>
                            @else
                                <td style="font-weight: bold; color:red">{{ $supply->observation }}</td>
                            @endif
                            <td>{{ $supply->price }}</td>
                            <td>{{ $supply->cant }}</td>
                            <td>

                                {{-- Ver --}}
                                <a href="{{ route('admin.supplies.show', $supply) }}" class="btn btn-primary">Ver</a>
                                {{-- Editar --}}
                                <a href="{{ route('admin.supplies.edit', $supply) }}" class="btn btn-success">Editar</a>
                                {{-- Eliminar --}}
                                <form id="delete" style="display: inline"
                                    action="{{ route('admin.supplies.destroy', $supply) }}" method="post"
                                    class="formulario-eliminar">
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
        //         $('.formulario-eliminar').submit(function(e) {
        //             e.preventDefault();

        //             Swal.fire({
        //                 title: '¿Estas seguro?',
        //                 icon: 'warning',
        //                 showCancelButton: true,
        //                 confirmButtonColor: '#3085d6',
        //                 cancelButtonColor: '#d33',
        //                 confirmButtonText: 'Sí, Borrar'
        //             }).then((result) => {
        //                 if (result.isConfirmed) {
        // /*                     Swal.fire(
        //                         'Deleted!',
        //                         'Your file has been deleted.',
        //                         'success'
        //                     ) */
        //                     this.submit();
        //                 }
        //             })
        //         });

    </script>

    <div class="modal-dialog modal-dialog-centered">

    </div>

    @include('admin.partials.js_datatables copy')

@stop
