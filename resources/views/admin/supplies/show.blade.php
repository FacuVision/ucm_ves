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

        <div class="card-header">
            Detalles:
        </div>
        <div class="card-body">
            <div>
                <table class="table-striped dt-responsive nowrap display compact" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Codigo</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Medida</th>
                            <th>Precio</th>
                            <th>Cantidad</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $supply->name }}</td>
                            <td>{{ $supply->code }}</td>
                            <td>{{ $supply->line }}</td>
                            <td>{{ $supply->brand }}</td>
                            <td>{{ $supply->unit }}</td>
                            <td>S/. {{ $supply->price }}</td>
                            <td>{{ $supply->cant }}</td>

                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                <table class="table-striped dt-responsive nowrap display compact" style="width:100%">
                    <thead>
                        <tr>
                            <th>Observaciones</th>
                            <th>Primer ingreso al sistema:</th>
                            <th>Última actualizacion:</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                @if ($supply->observation == "conforme")
                                <span class="badge badge-success">{{ $supply->observation }} </span>
                                @else
                                <span class="badge badge-danger">{{ $supply->observation }} </span>
                                @endif
                            </td>
                            <td>{{ $supply->created_at->format('d-m-Y g:i a')}}</td>
                            <td>
                                @if ($supply->updated_at != null)
                                {{ $supply->updated_at->format('d-m-Y g:i a') }}
                                @else
                                    <span class="badge badge-secondary"> Sin modificaciones aún</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                <table width="100%" class="table-striped dt-responsive nowrap display compact">
                    <thead>
                        <th>Detalles</th>
                    </thead>
                    <tbody>
                        <td>{{$supply->detail}}</td>
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                <table width="100%" class="table-striped dt-responsive nowrap display compact">
                    <thead>
                        <th  style="color: brown">Observaciones</th>
                    </thead>
                    <tbody>
                        <td>
                            @if ($supply->observation_detail == null)
                                Sin observaciones
                            @else
                            {{$supply->observation_detail}}
                            @endif

                        </td>
                    </tbody>
                </table>
            </div>
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
