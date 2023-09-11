@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

@section('content_header')
    <h1> Salida de fecha {{ $motion->created_at->format('d-m-Y g:i a') }} </h1>
@stop

@section('css')
    @include('admin.partials.css_datatables')

@endsection

@section('content')

<div class="card">


    <div class="card-header">
        Detalles:
    </div>
    <div class="card-body">
        <div>
            <table class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Responsable:</th>
                        <th>Responsable DNI:</th>
                        <th>Tipo:</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $motion->user->profile->name }} {{ $motion->user->profile->lastname }}</td>
                        <td>{{ $motion->user->profile->dni }}</td>
                        <td>{{ $motion->type }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-2">
            <table class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Descripcion:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $motion->detail }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            <table class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>

                        <th>Vehiculo destinado:</th>
                        <th>Fecha:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $motion->car->plate }}</td>
                        <td>{{ $motion->created_at->format('d-m-Y g:i a') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <a href="javascript:history.back()" class="btn btn-warning btn-sm"> Volver </a>
    </div>
</div>





    <div class="card">
        <div class="card-header">


            <h5 class="color">Detalle de salida</h5>
        </div>
        <div class="card-body">
            <table id="tabla" class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>nombre</th>
                        <th>marca</th>
                        <th>cantidad</th>
                        <th>precio</th>
                        <th>subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $pr)
                        <tr>
                            <td>{{ $pr['id'] }}</td>
                            <td>{{ $pr['name'] }}</td>
                            <td>{{ $pr['brand'] }}</td>
                            <td>{{ $pr['cant'] }}</td>
                            <td>S/. {{ $pr['price'] }}</td>
                            <td>S/. {{ $pr['subtotal'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-weight: bold">Total </td>
                        <td style="font-weight: bold">S/. {{ $suma }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
@stop


@section('js')
    @include('admin.partials.js_datatables copy')

@endsection
