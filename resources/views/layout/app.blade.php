<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog - @yield('title')</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @if(request()->is('admin'))
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  @endif
  @if(request()->is('/') || request()->is('admin'))
  <link rel="stylesheet" href="{{ asset('css/post.css') }}">
  @endif
  <script src="{{ mix('js/app.js')}}" defer></script>
</head>

<body>
  <div id='app'>
    <navbar @prop('user', Auth::check())>
      <a class="{{ (request()->is('/')) ? 'active' : '' }}" href="{{route('home')}}">
        Home
      </a>

      @guest
      <a class="{{ (request()->is('login')) ? 'active' : '' }}" href="{{route('login')}}">
        Login
      </a>
      <a class="{{ (request()->is('register')) ? 'active' : '' }}" href="{{route('register')}}">
        Register
      </a>
      @endguest
      @auth
      <a class="{{ (request()->is('admin')) ? 'active' : '' }}" href="{{route('admin')}}">
        My Account
      </a>
      @endauth
    </navbar>
    <main>
      @yield('content')
    </main>
  </div>
</body>

</html>