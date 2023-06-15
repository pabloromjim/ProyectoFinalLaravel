@extends('backLayout.app')
@section('title')
Edit User
@stop

@section('content')

<h1>Edit User</h1>
<hr />

{!! Form::model($user, [
'method' => 'PATCH',
'url' => ['panel', $user->id],
'class' => 'form-horizontal'
]) !!}


<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password', 'Password: ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('password', '', ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('score') ? 'has-error' : ''}}">
    {!! Form::label('score', 'Score: ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::number('score', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('score', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    {!! Form::label('role', 'Role: ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        <!-- {!! Form::text('role', null, ['class' => 'form-control', 'required' => 'required']) !!} -->
        <select name="role" id="role" class="form-control" required>
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-3 col-sm-3">
        {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
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