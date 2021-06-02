@extends('layout.app')

@section('title', 'Home')

@section('content')
<post-list @prop('date', $posts[count($posts)-1]->created_at)>
    @foreach ($posts as $post)
    <div class='post'>
        <div><h1>{{$post->title}}</h1> <span>{{date_format($post->created_at, 'Y-m-d H:i')}}</span></div>
        <span>Posted by: {{$post->user->name}}</span>
        <p>{{$post->content}}</p>
    </div>
    @endforeach
</post-list>
@endsection