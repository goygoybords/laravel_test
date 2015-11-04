@extends('main')
	@section('content')
		<label> Welcome to Student Management System</label>
		<a href = "{{ route('getLogout') }}">Logout</a>
 		
 		Welcome	{{ Auth::user()->username }}

 		<table>
 		</table>
       
	@endsection


 		

