@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

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

            {!! Form::model($car, ['route' => ['admin.cars.update', $car], 'method' => 'PUT', 'id' => 'form_edit']) !!}

            <div class="form-group">

                <div class="form-group">



                    @can('admin.cars.edit')
                        <div class="form-group">
                            <div class="row">
                                <div class="col">

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=1 id="edicion">
                                        <label class="form-check-label" for="edicion">
                                            <strong>
                                                Hacer editable
                                            </strong>
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endcan

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                {!! Form::label('plate', 'Placa') !!}
                                {!! Form::text('plate', $car->plate, ['class' => 'form-control', 'disabled' => true]) !!}
                            </div>
                            <div class="col">
                                {!! Form::label('type', 'Tipo') !!}
                                {!! Form::text('type', $car->type, ['class' => 'form-control', 'disabled' => true]) !!}
                            </div>

                            <div class="col">
                                {!! Form::label('brand', 'Marca') !!}
                                {!! Form::text('brand', $car->brand, ['class' => 'form-control', 'disabled' => true]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                {!! Form::label('model', 'Modelo') !!}
                                {!! Form::text('model', $car->model, ['class' => 'form-control', 'disabled' => true]) !!}
                            </div>
                            <div class="col">
                                {!! Form::label('color', 'Color') !!}
                                {!! Form::text('color', $car->color, ['class' => 'form-control']) !!}
                            </div>


                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                {!! Form::label('combustible_type', 'Tipo de combustible') !!}
                                {!! Form::text('combustible_type', $car->combustible_type , ['class' => 'form-control', 'disabled' => true]) !!}
                            </div>
                            <div class="col">
                                {!! Form::label('mileage', 'Kilometraje') !!}
                                {!! Form::number('mileage', $car->mileage, ['class' => 'form-control']) !!}
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


@section('js')
    <script>

        let tipo = document.getElementById('type');
        let placa = document.getElementById('plate');
        let marca = document.getElementById('brand');
        let modelo = document.getElementById('model');
        let combustible_type = document.getElementById('combustible_type');

        $('#form_edit').submit(function(e) {

            e.preventDefault();

            placa.removeAttribute("disabled");
            tipo.removeAttribute("disabled");
            marca.removeAttribute("disabled");
            modelo.removeAttribute("disabled");
            combustible_type.removeAttribute("disabled");


            this.submit();
        });



        function on() {

            placa.removeAttribute("disabled");
            tipo.removeAttribute("disabled");
            marca.removeAttribute("disabled");
            modelo.removeAttribute("disabled");
            combustible_type.removeAttribute("disabled");
        }

        function off() {

            placa.setAttribute("disabled", false);
            tipo.setAttribute("disabled", false);
            marca.setAttribute("disabled", false);
            modelo.setAttribute("disabled", false);
            combustible_type.setAttribute("disabled", false);

        }

        var checkbox = document.getElementById('edicion');

        checkbox.addEventListener("change", comprueba, false);

        function comprueba() {
            if (checkbox.checked) {
                on();
            } else {
                off();
            }
        }

    </script>
@endsection
