@extends('main')
	@section('content')
		{!! Form::open(array('route' => 'postReg' , 'method' => 'post')) !!}
			
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
					<td>{!! Form::label('password', 'Re-type Password') !!}</td>
					<td>{!! Form::password('password_confirmation') !!}</td>
				</tr>
				<tr>
					<td>{!! Form::label('terms', 'Terms') !!}</td>
					<td>{!! Form::checkbox('terms') !!}</td>
				</tr>
				<tr>
					<td></td>
					<td>
						{!! Form::submit('Register' , 
							array('id'=>'reg' , 'class' => 'reg') ) 
						!!} 
					</td>
				</tr>
			</table>
		{!! Form::close() !!}
		<a href = "{{ route('getLogin') }}">Back to Login</a>
		<!-- <a href ="{{ redirect()->back() }}">Back to Login</a> -->
		
		
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
