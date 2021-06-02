<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index($date)
    {
        $posts = Post::with(['user', 'status'])
            ->where([['status_id', 1], ['created_at', '<', $date]])
            ->take(5)
            ->get();
        $modPosts = PostResource::collection($posts);
        return $modPosts;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'status_id' => 'exists:post_status,id'
        ]);

        $user_id = Auth::user()->id;

        return Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'status_id' => $request->status_id,
            'creator_id' => $user_id
        ]);
    }

    public function userPosts($status)
    {
        $status +=0;
        $posts = Post::with(['user', 'status'])
            ->where([
                ['status_id', $status],
                ['creator_id', '=', Auth::user()->id]
            ])->get();
        $modPosts = PostResource::collection($posts);
        return $modPosts;
    }

    public function updateContent(Request $request, $id)
    {
        $post = Post::find($id);
        $user_id = Auth::user()->id;

        if ($post->creator_id != $user_id) {
            return response()->json(['Unauhtorized'], 401);
        }

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        return $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $post = Post::find($id);
        $user_id = Auth::user()->id;

        if ($post->creator_id != $user_id) {
            return response()->json(['Unauhtorized'], 401);
        }

        $request->validate([
            'status_id' => 'exists:post_status,id'
        ]);

        return $post->update([
            'status_id' => $request->status_id,
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
    }
}
