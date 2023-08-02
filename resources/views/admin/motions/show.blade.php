@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

@section('content_header')
    <h1> Movimiento de fecha {{ $motion->created_at->format('d-m-Y g:i a') }} </h1>
@stop

@section('css')
    @include('admin.partials.css_datatables')

@endsection

@section('content')
    <div class="card">

        <div class="card-body">

            <div class="card" style="width: auto;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Responsable:</strong> {{ $motion->user->profile->name }} {{ $motion->user->profile->lastname }}</li>
                    <li class="list-group-item"><strong>Responsable DNI:</strong> {{ $motion->user->profile->dni }}</li>
                    <li class="list-group-item"><strong>Titulo:</strong> {{ $motion->title }}</li>
                    <li class="list-group-item"><strong>Descripcion:</strong> {{ $motion->detail }}</li>
                    <li class="list-group-item "><strong>Fecha:</strong> {{ $motion->created_at->format('d-m-Y g:i a') }}</li>
                    <li class="list-group-item "><strong>Vehiculo destinado:</strong> {{ $motion->car->plate }} </li>
                </ul>

            </div>
        </div>

        <div class="card-footer">
            <a href="javascript:history.back()" class="btn btn-warning"> Volver </a>
        </div>

    </div>

    <div class="card">
        <div class="card-header">


            <h5 class="color">Repuestos del movimiento</h5>
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
                            <td>{{ $pr["id"] }}</td>
                            <td>{{ $pr["name"] }}</td>
                            <td>{{ $pr["brand"] }}</td>
                            <td>{{ $pr["cant"] }}</td>
                            <td>S/. {{ $pr["price"] }}</td>
                            <td>S/. {{ $pr["subtotal"] }}</td>
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
                        <td style="font-weight: bold">S/. {{$suma}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
@stop


@section('js')
    @include('admin.partials.js_datatables copy')

@endsection
