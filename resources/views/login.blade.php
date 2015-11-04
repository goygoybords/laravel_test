@extends('main')
	@section('content')
	{!! Form::open(array('route' => 'postLogin' , 'method' => 'post')) !!}
			<table border = 0 class = "desTable">
				<tr>
					<td>{!! Form::label('username', 'Username') !!}</td>
					<td>{!! Form::text('username', Input::old('username')) !!}</td>
				</tr>
				<tr>
					<td>{!! Form::label('password', 'Password') !!}</td>
					<td>{!! Form::password('password') !!}</td>
				</tr>
				<tr>
					<td>{!! Form::label('remember_me', 'Remember Me') !!}</td>
					<td>{!! Form::checkbox('remember_me') !!}</td>
				</tr>
				<tr>
					<td></td>
					<td>
						{!! Form::submit('Login' , 
							array('id'=>'login' , 'class' => 'login') ) 
						!!} 
					</td>
				</tr>
			</table>
		{!! Form::close() !!}
		<a href = "{{ route('getReg') }}">Register Here</a>
		<br>
  		<br>
  		@if($errors->has())
      		@foreach ($errors->all() as $error)
      			<div id="error_message">{{ $error }}</div>
			@endforeach

		@elseif (Session::has('msg'))
   			<div id="error_message">{{ Session::get('msg') }}</div>
      	@endif
      	<br>

	@endsection
