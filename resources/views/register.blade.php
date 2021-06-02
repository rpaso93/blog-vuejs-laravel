@extends('layout.app')

@section('title', 'Register')

@section('content')
<register>
    @csrf
    <span>Already got an account? Go to
        <a href="{{route('login')}}">Login</a>
    </span>
</register>
@endsection