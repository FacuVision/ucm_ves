@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

@section('content_header')
    <h1> Detalle del repuesto :  {{$supply->name}} </h1>
@stop

@section('css')
    @include('admin.partials.css_datatables')

@endsection

@section('content')
    <div class="card">

        <div class="card-body">

            <div class="card" style="width: auto;">
                <div class="card-header bg-info-subtle">
                    <strong> Código :</strong> {{ $supply->code }}
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Nombre:</strong> {{ $supply->name }}</li>
                    <li class="list-group-item "><strong>Línea:</strong> {{ $supply->line }}</li>
                    <li class="list-group-item "><strong>Marca:</strong> {{ $supply->brand }} </li>
                    <li class="list-group-item "><strong>Unidad:</strong> {{ $supply->unit }} </li>
                    <li class="list-group-item "><strong>Costo: </strong> S/. {{ $supply->price }} </li>
                    <li class="list-group-item "><strong>Cantidad disponible: </strong> {{ $supply->cant }} </li>
                    <li class="list-group-item "><strong>Observacion: </strong>

                        @if ($supply->observation == "conforme")
                            <span class="badge badge-success">{{ $supply->observation }} </span>
                            @else
                            <span class="badge badge-danger">{{ $supply->observation }} </span>
                        @endif

                    </li>
                    <li class="list-group-item "><strong>Fecha de primer ingreso: </strong> {{$supply->created_at->format('d-m-Y g:i a')}} </li>
                    <li class="list-group-item "><strong>Fecha de ultima actualizacion: </strong> {{ $supply->updated_at->format('d-m-Y g:i a') }} </li>
                </ul>

            </div>

            <div class="mb-3">
                <label for="detail" class="form-label">Detalles</label>
                <textarea class="form-control" id="detail" rows="3" disabled>{{$supply->detail}}</textarea>
            </div>

            @if ($supply->observation_detail != null)
                <div class="mb-3">
                    <label for="detail" class="form-label">Observacion detalles</label>
                    <textarea class="form-control" id="detail" rows="3" disabled>{{$supply->observation_detail}}</textarea>
                </div>
            @endif
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.supplies.index') }}" class="btn btn-warning btn-sm"> Volver </a>
        </div>

    </div>

    <div class="card">
        <div class="card-header">


            <h5 class="color">Historial del Repuesto</h5>
        </div>
        <div class="card-body">
            <table id="tabla" class="table-striped dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Responsable</th>
                        <th>Dni Responsable</th>
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
                            <td>{{ $his->user->profile->name }}</td>
                            <td>{{ $his->user->profile->dni }}</td>
                            <td>{{ $his->status }}</td>
                            <td>{{ $his->type}}</td>
                            <td>{{ $his->created_at->format('d-m-Y g:i a') }}</td>
                            <td>
                                {{-- Ver --}}
                                <a href="{{ route('admin.histories.show', $his) }}" class="btn btn-primary btn-sm">Ver</a>

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
