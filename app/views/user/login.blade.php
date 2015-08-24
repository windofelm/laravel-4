@extends('layouts.master')

@section('head')
	@parent
    <title>Login Page</title>
@stop

@section('content')

	<div class="container">
		<h1>Login</h1>
		<form role="form" method="post" action="{{ URL::route('postLogin') }}">
			<div class="form-group col-md-3 {{ ($errors->has('username')) ? 'has-error' : '' }}">
				<label for="username">Username: </label>
				<input id="username" name="username" type="text" class="form-control" value="{{ Input::old('username') }}">
				@if($errors->has('username'))
					{{ $errors->first('username') }}
				@endif
			</div>
			<div class="clearfix"></div>

			<div class="form-group col-md-3 {{ ($errors->has('pass1')) ? 'has-error' : '' }}">
				<label for="pass1">Password: </label>
				<input id="pass1" name="pass1" type="password" class="form-control">
				@if($errors->has('pass1'))
					{{ $errors->first('pass1') }}
				@endif
			</div>
			<div class="clearfix"></div>

			<div class="form-group col-md-3 {{ ($errors->has('remember')) ? 'has-error' : '' }}">
				<input id="remember" name="remember" type="checkbox"> <span style="position: relative;top: -2px;">Remember me !</span>
			</div>
			<div class="clearfix"></div>

			{{ Form::token() }}
			<div class="form-group col-md-3">
				<input type="submit" value="Login" class="btn btn-default">
			</div>
		</form>
	</div>
@stop