@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

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
                    <strong>Placa:</strong> {{ $car->plate }}
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Tipo:</strong> {{ $car->type }}</li>
                    <li class="list-group-item "><strong>Marca:</strong> {{ $car->brand }}</li>
                    <li class="list-group-item "><strong>Modelo:</strong> {{ $car->model }} </li>
                    <li class="list-group-item "><strong>Color:</strong> {{ $car->color }} </li>
                    <li class="list-group-item "><strong>Tipo de combustible:</strong> {{ $car->combustible_type }} </li>
                    <li class="list-group-item"><strong>Kilometraje:</strong> {{ $car->mileage }}</li>
                    <li class="list-group-item "><strong>Primer ingreso al sistema: </strong> {{ $car->created_at->format('d-m-Y g:i a') }} </li>
                    <li class="list-group-item "><strong>Última actualizacion: </strong>
                        @if ($car->updated_at != null)
                            {{ $car->updated_at->format('d-m-Y g:i a') }}
                        @else
                            <span class="badge badge-secondary"> Sin modificaciones aún</span>
                        @endif
                    </li>
                </ul>

            </div>
        </div>

        <div class="card-footer">
            <a href="javascript:history.back()" class="btn btn-warning btn-sm"> Volver </a>
        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="color">Historial de salidas</h5>
        </div>

        <div class="card-body">


            <table id="tabla" class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Responsable</th>
                        <th>Tipo</th>
                        <th>Fecha de creacion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($car_movimientos as $movimiento)
                        <tr>
                            <td>{{ $movimiento->id }}</td>
                            <td>{{ $movimiento->user->profile->name }}</td>
                            <td>{{ $movimiento->type }}</td>
                            <td>{{ $movimiento->created_at->format('d-m-Y g:i a') }}</td>

                            <td>
                                @can('admin.motions.show')
                                {{-- Mostrar --}}
                                <a href="{{ route('admin.motions.show', $movimiento) }}" class="btn btn-primary btn-sm">Ver</a>
                            @endcan
                            </td>
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
