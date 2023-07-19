@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Producto </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @if (session('mensaje'))
                <div class='alert alert-{{ session('color') }}'>
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

            {!! Form::model($supply, ['route' => ['admin.supplies.update', $supply], 'method' => 'PUT']) !!}

            <div class="form-group">

                <div class="form-group">

                    <div class="form-group">

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    {!! Form::label('code', 'Código') !!}
                                    {!! Form::text('code', $supply->code, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col">
                                    {!! Form::label('name', 'Nombre') !!}
                                    {!! Form::text('name', $supply->name, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col">
                                    {!! Form::label('brand', 'Marca') !!}
                                    {!! Form::text('brand', $supply->brand, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    {!! Form::label('detail', 'Detalles') !!}
                                    {!! Form::textarea('detail', $supply->detail, ['class' => 'form-control', 'rows' => 3]) !!}
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    {!! Form::label('line', 'Línea') !!}
                                    {!! Form::select('line', ['parte', 'suministro', 'respuesto'], $cod_linea, ['class' => 'form-control']) !!}
                                </div>


                                <div class="col">
                                    {!! Form::label('unit', 'Unidad') !!}
                                    {!! Form::select(
                                        'unit',
                                        [
                                            'globales',
                                            'metros',
                                            'centimetros',
                                            'milimetros',
                                            'toneladas',
                                            'kilogramos',
                                            'gramos',
                                            'litros',
                                            'mililitros',
                                            'metros cuadrados',
                                            'metros cúbicos'
                                        ],
                                        $cod_unidad,
                                        ['class' => 'form-control'],
                                    ) !!}
                                </div>
                                <div class="col">
                                    {!! Form::label('price', 'Costo') !!}
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">S/.</span>
                                        </div>
                                        {!! Form::number('price', $supply->price, ['class' => 'form-control', "step" =>"any"]) !!}
                                    </div>
                                </div>
                                <div class="col">
                                    {!! Form::label('cant', 'Cantidad') !!}
                                    {!! Form::number('cant', $supply->cant, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
            <a href="{{ route('admin.supplies.index') }}" class="btn btn-warning"> Volver </a>

        </div>
        {!! Form::close() !!}

    </div>
@stop