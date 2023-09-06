@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

@section('content_header')
    <h1>Menu de Usuarios: Crear Usuario </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

            @if (count($errors) > 0)
                <div class="text-danger">

                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach

                </div>
            @endif

        </div>

        <div class="card-body">

            {!! Form::open(['method' => 'POST', 'route' => 'admin.users.store']) !!}

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        {!! Form::label('email', 'Correo Electronico') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('password', 'Contraseña') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        {!! Form::label('nombre', 'Nombres') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('apellido', 'Apellidos') !!}
                        {!! Form::text('apellido', null, ['class' => 'form-control']) !!} </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col">
                        {!! Form::label('phone', 'Teléfono') !!}
                        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('dni', 'DNI') !!}
                        {!! Form::text('dni', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('direccion', 'Direccion') !!}
                {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
            </div>


            {{-- SOLO LOS QUE TENGAN ROL DE ELIMINACION DE USUARIOS, PODRAN ASIGNARLE ROLES A LOS USUARIOS --}}
            <div class="form-group">
                @can('admin.users.destroy')
                    {!! Form::label('rol', 'Roles:') !!} <br>
                    @foreach ($roles as $role)
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                            {{ $role->name }} &nbsp;&nbsp;
                        </label>
                    @endforeach
                @endcan

            </div>
            <div class="form-group">
                {!! Form::submit('Crear', ['class' => 'btn btn-success btn-sm']) !!}
                <a href="{{ route('admin.users.index') }}" class="btn btn-warning btn-sm"> Volver </a>
            </div>


            {!! Form::close() !!}

        </div>

    </div>
@stop
