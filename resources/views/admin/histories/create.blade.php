@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

@section('content_header')
    <h1>Ingresar Repuesto </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @if (session('mensaje'))
                <div class="alert alert-success">
                    <strong>{{ session('mensaje') }}</strong>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="text-danger">

                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach

                </div>
            @endif

        </div>
        <div class="card-body">

            {!! Form::open(['method' => 'POST', 'route' => 'admin.supplies.store']) !!}

            <div class="form-group">

                <div class="form-group">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                {!! Form::label('code', 'Código de producto (*)') !!}
                                {!! Form::text('code', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col">
                                {!! Form::label('name', 'Nombre (*)') !!}
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col">
                                {!! Form::label('line', 'Línea (*)') !!}
                                {!! Form::select('line', ["parte", "suministro", "respuesto"], null, ['class' => 'form-control']) !!}
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                {!! Form::label('detail', 'Detalles (*)') !!}
                                {!! Form::textarea('detail', null, ['class' => 'form-control', 'rows' => 3]) !!}
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">


                            <div class="col">
                                {!! Form::label('brand', 'Marca (*)') !!}
                                {!! Form::text('brand', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col">
                                {!! Form::label('unit', 'Medida (*)') !!}
                                {!! Form::select(
                                    'unit',
                                    [
                                        'unidades',
                                        'kilogramos',
                                        'litros'
                                ],
                                    null,
                                    ['class' => 'form-control'],
                                ) !!}
                            </div>
                            {{-- <div class="col">
                                {!! Form::label('costo', 'Costo (*)') !!}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">S/.</span>
                                    </div>
                                    {!! Form::number('price', null, ['min' => 1, 'class' => 'form-control' , "step" =>"any"]) !!}
                                </div>
                            </div> --}}
                            <div class="col">
                                {!! Form::label('cant', 'Cantidad (*)') !!}
                                {!! Form::number('cant', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            {!! Form::submit('Guardar', ['class' => 'btn btn-success btn-sm']) !!}
            <a href="{{ route('admin.supplies.index') }}" class="btn btn-warning btn-sm"> Volver </a>

        </div>
        {!! Form::close() !!}

    </div>
@stop
