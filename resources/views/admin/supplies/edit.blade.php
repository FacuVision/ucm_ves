@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

@section('content_header')
    <h1>Editar Repuesto </h1>
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
                                    'unidades',
                                    'kilogramos',
                                    'litros'
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
                                        {!! Form::number('price', $supply->price, ['class' => 'form-control', "step" =>"any", "min" => 1]) !!}
                                    </div>
                                </div>
                                <div class="col">
                                    {!! Form::label('cant', 'Cantidad') !!}
                                    {!! Form::number('cant', $supply->cant, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col">
                                    {!! Form::label('observation', 'Observación') !!}
                                    {!! Form::select('observation', ["conforme", "con modificaciones"], $observation_id, ['class' => 'form-control','onChange' => 'pagoOnChange(this)']) !!}
                                </div>

                            </div>
                        </div>

                        <div id="bloque" class="form-group">

                            <div class="row">
                                <div class="col">
                                    {!! Form::label('observation_detail', 'Detalle de observacion') !!}
                                    {!! Form::textarea('observation_detail', $supply->observation_detail, ['class' => 'form-control', 'rows' => 3]) !!}
                                </div>
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

@section('js')
    <script>

        obs = document.getElementById("observation");
        if (obs.value == "0") {
            divC = document.getElementById("bloque");
            divC.style.display = "none";
        } else {
            divC.style.display = "";

        }

        function pagoOnChange(sel) {
            if (sel.value == "0") {
                divC = document.getElementById("bloque");
                divC.style.display = "none";
                area = document.getElementById("observation_detail");
                area.value = ""

            }
            if (sel.value == "1") {
                divC = document.getElementById("bloque");
                divC.style.display = "";
            }
        }
    </script>

@endsection

@section('css')
