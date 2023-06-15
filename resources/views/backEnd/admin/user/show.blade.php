@extends('backLayout.app')
@section('title')
User
@stop

@section('content')

<h1>Usuario {{ $user->name }}</h1>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
            <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Puntuacion</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->id }}</td>
                <td> {{ $user->name }} </td>
                <td> {{ $user->email }} </td>
                <td> {{ $user->password }} </td>
                <td> {{ $user->score }} </td>
                <td> {{ $user->role }} </td>
            </tr>
        </tbody>
    </table>
    <a href="{{ url('panel') }}" class="btn btn-primary pull-right ">Volver</a>
</div>

@endsection