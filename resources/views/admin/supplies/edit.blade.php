@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar vehículo </h1>
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

            {!! Form::model($car, ['route' => ['admin.cars.update', $car], 'method' => 'PUT']) !!}

            <div class="form-group">

                <div class="form-group">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                {!! Form::label('type', 'Tipo') !!}
                                {!! Form::text('type', $car->type, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col">
                                {!! Form::label('plate', 'Placa') !!}
                                {!! Form::text('plate', $car->plate, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col">
                                {!! Form::label('mileage', 'Kilometraje') !!}
                                {!! Form::number('mileage', $car->mileage, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                {!! Form::label('brand', 'Marca') !!}
                                {!! Form::text('brand', $car->brand, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col">
                                {!! Form::label('color', 'Color') !!}
                                {!! Form::text('color', $car->color, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col">
                                {!! Form::label('model', 'Modelo') !!}
                                {!! Form::text('model', $car->model, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
            <a href="{{ route('admin.cars.index') }}" class="btn btn-warning"> Volver </a>

        </div>
        {!! Form::close() !!}

    </div>
@stop
