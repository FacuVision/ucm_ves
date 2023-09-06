@extends('adminlte::page')

@section('title', 'Control de Repuestos VES')

@section('content_header')
    <h1>Editar Usuario </h1>
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

            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'PUT']) !!}

            <div class="form-group">

                <div class="form-group">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                {!! Form::label('email', 'Correo Electronico') !!}
                                {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
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
                                {!! Form::text('name', $user->profile->name, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col">
                                {!! Form::label('apellido', 'Apellidos') !!}
                                {!! Form::text('lastname', $user->profile->lastname, ['class' => 'form-control']) !!} </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                {!! Form::label('phone', 'Teléfono') !!}
                                {!! Form::text('phone', $user->profile->phone, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col">
                                {!! Form::label('dni', 'DNI') !!}
                                {!! Form::text('dni', $user->profile->dni, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('direccion', 'Direccion') !!}
                        {!! Form::text('address', $user->profile->address, ['class' => 'form-control']) !!}
                    </div>
                    @can('admin.users.destroy')
                    {!! Form::label('rol', 'Roles:') !!} <br>
                    <div class="form-group">
                        @foreach ($roles as $role)
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                            {{ $role->name }} &nbsp;&nbsp;
                        </label>
                        @endforeach
                    </div>
                    @endcan

                </div>




                {!! Form::submit('Guardar', ['class' => 'btn btn-success btn-sm']) !!}
                <a href="{{ route('admin.users.index') }}" class="btn btn-warning btn-sm"> Volver </a>

            </div>
            {!! Form::close() !!}

        </div>
    @stop
