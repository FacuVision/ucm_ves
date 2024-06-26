@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

@section('content_header')
    <h1>Registro de salida de repuestos</h1>
    @include('admin.partials.css_datatables')
    {{-- @include('admin.partials.css_select2') --}}

@stop

@section('content')
    <p>Los campos marcados con (*) son obligatorios</p>


    <div id="jsonDiv"></div>

    <div class="card">
        {{-- <div class="card-header"> </div> --}}

        <div class="card-body">

            @if (count($errors) > 0)
                <div class="text-danger">

                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach

                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif



            {!! Form::open(['method' => 'POST', 'route' => 'admin.motions.store', 'id' => 'FormFinal']) !!}

            {!! Form::hidden('hiden_json', '', ['id' => 'hiden_json']) !!}
            {!! Form::hidden('title_h', '', ['id' => 'title_h']) !!}
            {!! Form::hidden('detail_h', '', ['id' => 'detail_h']) !!}
            {!! Form::hidden('id_car_h', '', ['id' => 'id_car_h']) !!}
            {!! Form::hidden('new_km_h', '', ['id' => 'new_km_h']) !!}


            {!! Form::close() !!}


            <form action="" id="frmProductos" class="m-3">




                <div class="columns">
                    <div class="column">
                        <label class="label">Tipo de salida (*):</label>

                        <select name="title" id="title" class="form-control" required>
                            <option value="Traslado">Traslado</option>
                            <option value="Reparacion">Reparacion</option>
                        </select>
                    </div>

                    <div class="column">
                        {!! Form::label('detail', 'Descripcion (*)') !!}
                        <textarea required class="form-control" name="detail" id="detail" rows="5">{{session('detail')}}</textarea>

                    </div>

                </div>

                <div class="row">
                    <div class="col-9">
                        <label class="label">Vehículo destinado (*):</label>

                        <select name="car" id="car" class="form-select">
                            @foreach ($select_vehiculos as $key => $value)
                                <option value={{ $key }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label class="label">Nuevo kilometraje:</label>
                        <input class="form-control" min="0"  type="number" name="new_km" id="new_km" onchange="document.getElementById('new_km_h').value = this.value">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <label class="label">Cantidad (*):</label>
                        <input value="1" type="number" min="1" name="cant" id="cant" required
                            class="form-control">
                    </div>

                    <div class="col-9">
                        <label class="label">Repuesto (*):</label>
                        <select name="supply" id="supply" class="form-select">
                            @foreach ($select_supply as $key => $value)
                                <option value={{ $key }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="row">

                    <div class="col">
                        <br>
                        <label class="label">Agregar a la lista (*):</label>

                        <button id="btnAdd" type="button" class="btn btn-success">
                            <span class="icon">
                                <i class="fas fa-plus"></i>
                            </span>
                        </button>
                    </div>
                    <div class="col">
                        <br>
                        <label class="label">Para finalizar:</label>

                        <button id="btnSave" type="button" class="btn btn-warning">
                            Registrar repuestos de la lista
                        </button>
                    </div>
                </div>
                <br>
                <div id="divElements">

                </div>

            </form>


        </div>

        <div class="card-footer">
            <div class="column">
                {{-- @can('admin.motions.show') --}}
                <a href="{{ route('admin.motions.index') }}" class="btn btn-secondary"> Volver </a>
                {{-- @endcan --}}
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
@stop

@section('js')


    @include('admin.partials.js_datatables copy')
    <script src="{{ asset('js/motions_create.js') }}"></script>


@stop
