@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Añadir productos al movimiento</h1>
@stop

@section('content')
    <p>Agrega o elimina productos indicando su cantidad</p>

    <div class="card">


        <div style="display: block" class="card-header">

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

        </div>

        <div class="card-body">

            <div id="jsonDiv">

            </div>

            {!! Form::open(['method' => 'POST', 'route' => 'admin.motions.store', 'id' => 'FormFinal']) !!}
            {!! Form::hidden('hiden_json', '', ['id' => 'hiden_json']) !!}
            {!! Form::hidden('title_h', '', ['id' => 'title_h']) !!}
            {!! Form::hidden('detail_h', '', ['id' => 'detail_h']) !!}
            {!! Form::hidden('id_car_h', '', ['id' => 'id_car_h']) !!}

            {!! Form::close() !!}


            <form action="" id="frmProductos" class="m-3">

                <div class="columns">
                    <div class="column">
                        <br>
                        <label class="label">Vehículo destinado:</label>
                        <select name="car" id="car" class="form-control">
                            @foreach ($select_vehiculos as $key => $value)
                                <option value={{ $key }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="columns">
                    <div class="column">
                        <label class="label">Titulo:</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>

                    <div class="column">
                        <label class="label">Descripcion:</label>
                        <textarea name="detail" id="detail" rows="5" class="form-control"></textarea>
                    </div>

                </div>



                <div class="row">
                    <div class="col-3">
                        <label class="label">Cantidad:</label>
                        <input value="1" type="number" min=1 name="cant" id="cant" required class="form-control">
                    </div>

                    <div class="col-9">
                        <label class="label">Producto:</label>
                        <select name="supply" id="supply" class="form-control">
                            @foreach ($select_supply as $key => $value)
                                <option value={{ $key }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="columns">

                    <div class="column">
                        <br>
                        <label class="label">Añadir:</label>

                        <button id="btnAdd" type="button" class="btn btn-success">
                            <span class="icon">
                                <i class="fas fa-plus"></i>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <button id="btnSave" type="button" class="btn btn-warning">
                            Registrar productos
                        </button>
                    </div>
                </div>


            </form>
            <hr>

            <div id="divElements">

            </div>
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
    <script src="{{ asset('js/motions_create.js') }}"></script>

@stop
