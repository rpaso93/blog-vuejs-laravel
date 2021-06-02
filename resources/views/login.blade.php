@extends('layout.app')

@section('title', 'Login')

@section('content')
<login>
    @csrf
    <span>You don't have an account? Go to
        <a href="{{route('register')}}">Register</a>
    </span>
</login>
@endsection