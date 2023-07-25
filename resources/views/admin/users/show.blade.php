@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ $user->profile->name . ' ' . $user->profile->lastname }} </h1>
@stop

@section('css')

@endsection

@section('content')
    <div class="card">

        {{--     <div class="card-header">
        @if (session('mensaje'))
        <div class="alert alert-danger">
            <strong>{{session('mensaje')}}</strong>
        </div>
        @endif
    </div> --}}

        <div class="card-body">

            <div class="card" style="width: auto;">
                <div class="card-header bg-info-subtle">
                    <strong> DNI: N° </strong> {{ $user->profile->dni }}
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Telefono:</strong> {{ $user->profile->phone }}</li>
                    <li class="list-group-item"><strong>Correo:</strong> {{ $user->email }}</li>
                    <li class="list-group-item "><strong>Roles:

                            @foreach ($user->roles as $role)
                                @switch($role->name)
                                    @case($role->name == 'super_admin')
                                        <span class="badge badge-warning">
                                            {{ $role->name }}
                                        </span>
                                    @break

                                    @case($role->name == 'admin')
                                        <span class="badge badge-primary">
                                            {{ $role->name }}
                                        </span>
                                    @break

                                    @case($role->name == 'usuario')
                                        <span class="badge badge-secondary">
                                            {{ $role->name }}
                                        </span>
                                    @break
                                @endswitch
                            @endforeach

                        </strong> </li>
                    <li class="list-group-item "><strong>Fecha de creacion: </strong>
                        {{ $user->created_at->format('d-m-Y g:i a') }} </li>
                    <li class="list-group-item "><strong>Ultimamente actualizado:</strong> {{ $user->profile->updated_at }}
                    </li>
                </ul>


            </div>
            {!! Form::label('direccion', 'Direccion:', ['class' => 'form']) !!}
            {!! Form::textarea('direccion', $user->profile->address, [
                'class' => 'form-control',
                'rows' => '2',
                'disabled' => 'true',
            ]) !!}

        </div>
        <div class="card-footer">
            <a href="{{ route('admin.users.index') }}" class="btn btn-warning"> Volver </a>
        </div>

    </div>
@stop


@section('js')

@endsection
