@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Vehículo de placa N° {{ $car->plate }} </h1>
@stop

@section('css')
    @include('admin.partials.css_datatables')

@endsection

@section('content')
    <div class="card">

        <div class="card-body">

            <div class="card" style="width: auto;">
                <div class="card-header bg-info-subtle">
                    <strong> Tipo:</strong> {{ $car->type }}
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Placa:</strong> {{ $car->plate }}</li>
                    <li class="list-group-item"><strong>Kilometraje:</strong> {{ $car->mileage }}</li>
                    <li class="list-group-item "><strong>Marca:</strong> {{ $car->brand }}</li>
                    <li class="list-group-item "><strong>Color:</strong> {{ $car->color }} </li>
                    <li class="list-group-item "><strong>Modelo:</strong> {{ $car->model }} </li>
                    <li class="list-group-item "><strong>Primer ingreso al sistema: </strong> {{ $car->created_at->format('d-m-Y g:i a') }} </li>
                </ul>

            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.cars.index') }}" class="btn btn-warning"> Volver </a>
        </div>

    </div>

    <div class="card">
        <div class="card-header">


            <h5 class="color">Movimientos del vehículo</h5>
        </div>
        <div class="card-body">
            <table id="tabla" class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Responsable</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Fecha de creacion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($car_movimientos as $movimiento)
                        <tr>
                            <td>{{ $movimiento->id }}</td>
                            <td>{{ $movimiento->user->profile->name }}</td>
                            <td>{{ $movimiento->title }}</td>
                            <td>{{ $movimiento->detail }}</td>
                            <td>{{ $movimiento->created_at->format('d-m-Y g:i a') }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@stop


@section('js')
    @include('admin.partials.js_datatables copy')

@endsection
