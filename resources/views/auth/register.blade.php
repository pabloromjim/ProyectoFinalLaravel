@extends('layouts.app')

@section('content')
<div class="container">

    <div class="container bg-light">
        <article class="container mx-auto" style="max-width: 400px;">
            <h4 class=" mt-3 text-center">Crear Cuenta</h4>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="  form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> <label for="name" class=" control-label">Nombre</label> </span>
                    </div>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div> <!-- form-group// -->


                <div class="  form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> <label for="email" class=" control-label">Correo Electronico</label> </span>
                    </div>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div> <!-- form-group// -->


                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> <label for="password" class=" control-label">Contraseña</label> </span>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" required>
                    
                    @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div> <!-- form-group// -->

                <div class="form-group ">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> <label for="password-confirm" class=" control-label">Confirm Password</label> </span>
                    </div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div> <!-- form-group// -->


                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Crear Cuenta </button>
                </div> <!-- form-group// -->
                <p class="text-center">¿Tienes cuenta? <a href="{{ route('login') }}">Inicia Sesion</a> </p>
            </form>
        </article>
    </div> 

</div>

<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection