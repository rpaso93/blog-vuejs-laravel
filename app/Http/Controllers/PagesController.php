<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;

class PagesController extends Controller
{
  public function index()
  {
    $posts = Post::with(['user', 'status'])
      ->where('status_id', 1)
      ->orderBy('created_at', 'DESC')
      ->paginate(3);
    $modPosts = PostResource::collection($posts);
    return view('index')->with('posts', $modPosts);
  }

  public function login()
  {
    return view('login');
  }

  public function register()
  {
    return view('register');
  }

  public function admin()
  {
    return view('admin');
  }
}
