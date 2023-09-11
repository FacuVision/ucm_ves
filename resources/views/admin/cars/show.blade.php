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
        <div class="card-header">
            Detalles:
        </div>
        <div class="card-body">
            <div>
                <table class="table-striped dt-responsive nowrap display compact" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Color</th>
                            <th>Tipo de combustible</th>
                            <th>Kilometraje antiguo</th>
                            <th>Kilometraje actual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $car->type }}</td>
                            <td>{{ $car->brand }}</td>
                            <td>{{ $car->model }}</td>
                            <td>{{ $car->color }}</td>
                            <td>{{ $car->combustible_type }}</td>
                            <td>@if ($car->old_mileage == null)
                                -
                                @else
                                {{ $car->old_mileage }} km
                                @endif
                        </td>
                            <td>{{ $car->mileage }} km </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                <table class="table-striped dt-responsive nowrap display compact" style="width:100%">
                    <thead>
                        <tr>
                            <th>Primer ingreso al sistema:</th>
                            <th>Última actualizacion:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $car->created_at->format('d-m-Y g:i a')}}</td>
                            <td>
                                @if ($car->updated_at != null)
                                {{ $car->updated_at->format('d-m-Y g:i a') }}
                                @else
                                    <span class="badge badge-secondary"> Sin modificaciones aún</span>
                                @endif
                            </td>
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
                                    <a href="{{ route('admin.motions.show', $movimiento) }}"
                                        class="btn btn-primary btn-sm">Ver</a>
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
