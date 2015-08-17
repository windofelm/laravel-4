@extends('layouts.master')

@section('head')
	@parent
    <title>Register Page</title>
@stop

@section('content')

	<div class="container">
		<h1>Register</h1>
		<form role="form" method="post" action="{{ URL::route('postCreate') }}">
			<div class="form-group col-md-4 {{ ($errors->has('username')) ? 'has-error' : '' }}">
				<label for="username">Username: </label>
				<input id="username" name="username" type="text" class="form-control" value="{{ Input::old('username') }}">
				@if($errors->has('username'))
					{{ $errors->first('username') }}
				@endif
			</div>
			<div class="clearfix"></div>

			<div class="form-group col-md-4 {{ ($errors->has('pass1')) ? 'has-error' : '' }}">
				<label for="pass1">Password: </label>
				<input id="pass1" name="pass1" type="password" class="form-control">
				@if($errors->has('pass1'))
					{{ $errors->first('pass1') }}
				@endif
			</div>
			<div class="clearfix"></div>

			<div class="form-group col-md-4 {{ ($errors->has('pass2')) ? 'has-error' : '' }}">
				<label for="pass2">Confirm Password: </label>
				<input id="pass2" name="pass2" type="password" class="form-control">
				@if($errors->has('pass2'))
					{{ $errors->first('pass2') }}
				@endif
			</div>
			<div class="clearfix"></div>

			{{ Form::token() }}
			<div class="form-group col-md-4">
				<input type="submit" value="Register" class="btn btn-default">
			</div>
		</form>
	</div>
@stop