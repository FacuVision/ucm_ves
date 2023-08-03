@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

@section('content_header')
    <h1>Historial N° {{ $history->id }}</h1>
@stop

@section('css')
    @include('admin.partials.css_datatables')

@endsection

@section('content')

    <div class="card">
        <div class="card-body">

            {{-- {!! Form::open(['method' => 'POST', 'route' => 'admin.supplies.store']) !!} --}}

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        {!! Form::label('code', 'Código de repuesto') !!}
                        {!! Form::text('user_name', $history->supply->code, ['disabled' => 'true', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('name', 'Nombre de repuesto') !!}
                        {!! Form::text('user_name', $history->supply->name, ['disabled' => 'true', 'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>


            {{-- ---------------------------------------------------------------- --}}

            <hr>

            {{-- {!! Form::open(['method' => 'POST', 'route' => 'admin.supplies.store']) !!} --}}

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        {!! Form::label('user_name', 'Responsable') !!}
                        {!! Form::text('user_name', $history->user->profile->name . ' ' . $history->user->profile->lastname, [
                            'disabled' => 'true',
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('user_dni', 'DNI N°') !!}
                        {!! Form::text('user_dni', $history->user->profile->dni, ['disabled' => 'true', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <br>
                <div class="form-group">

                    <div class="row">
                        <div class="col">
                            {!! Form::label('type', 'Tipo de transaccion') !!}
                            {!! Form::text('type', $history->type, ['class' => 'form-control', 'disabled' => 'true']) !!}
                        </div>
                        <div class="col">
                            {!! Form::label('type', 'Fecha') !!}
                            {!! Form::text('type', $history->created_at->format('d-m-Y g:i a'), [
                                'class' => 'form-control',
                                'disabled' => 'true',
                            ]) !!}
                        </div>
                        <div class="col">
                            {!! Form::label('status', 'Observaciones') !!}
                            {!! Form::text('status', $history->status, ['class' => 'form-control', 'disabled' => 'true']) !!}
                        </div>
                    </div>
                </div>


                @if ($history->status_detail != null)

                <div class="form-group">

                    <div class="row">
                        <div class="col">
                            {!! Form::label('status_detail', 'Detalles de la observacion') !!}
                            {!! Form::textarea('status_detail', $history->status_detail, [
                                'disabled' => 'true',
                                'class' => 'form-control',
                                'rows' => 4
                                ]) !!}
                        </div>
                    </div>
                </div>

                @endif

                <br>
                <div class="row">
                    <div class="col">
                        {!! Form::label('datos_antiguos', 'Datos antiguos') !!}
                        {!! Form::textarea('datos_antiguos', $history->datos_antiguos, [
                            'disabled' => 'true',
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('datos_nuevos', 'Datos nuevos') !!}
                        {!! Form::textarea('datos_nuevos', $history->datos_nuevos, ['disabled' => 'true', 'class' => 'form-control']) !!}
                    </div>

                </div>
            </div>
            {{-- {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!} --}}
            <a href="javascript:history.back()" class="btn btn-warning"> Volver </a>

        </div>
        {{-- {!! Form::close() !!} --}}

    </div>
@stop
