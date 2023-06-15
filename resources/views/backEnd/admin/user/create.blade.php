@extends('backLayout.app')
@section('title')
Create new User
@stop

@section('content')

<h1>Añadir Nuevo Usuario</h1>
<hr />

{!! Form::open(['url' => 'panel/', 'class' => 'form-horizontal']) !!}

<!-- <div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">
    {!! Form::label('id', 'Id: ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::number('id', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
    </div>
</div> -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Nombre: ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password', 'Contraseña: ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::password('Contraseña', ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('score') ? 'has-error' : ''}}">
    {!! Form::label('score', 'Puntuacion: ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::number('score', 0, ['class' => 'form-control', 'required' => 'required', 'min' => '0']) !!}
        {!! $errors->first('score', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    {!! Form::label('role', 'Rol: ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        <select name="role" id="role" required>
            <option value="user">Usuario</option>
            <option value="admin">Administrador</option>

        </select>
        <!-- {!! Form::text('role', null, ['class' => 'form-control', 'required' => 'required']) !!} -->
        {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-3 col-sm-3">
        {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>
{!! Form::close() !!}

@if ($errors->any())
<ul class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif
<a href="{{ url('panel') }}" class="btn btn-primary pull-right ">Volver</a>
@endsection