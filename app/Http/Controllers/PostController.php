<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $role = match (get_class($user)) {
            \App\Models\Admin::class => 'admin',
            \App\Models\User::class => 'user',
        };
        if ($role == 'admin') {
            $posts = Post::latest()->get();
        } else {
            $posts = Post::where('user_id', $user->id)->latest()->get();
        }


        return ApiResponse::success(['posts' => PostResource::collection($posts)]);

    }

    public function store(CreatePostRequest $request)
    {


        $user = auth('sanctum')->user();
        $role = match (get_class($user)) {
            \App\Models\Admin::class => 'admin_id',
            \App\Models\User::class => 'user_id',
        };

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->get('content');
        $post->status = $request->status;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension());
            $name = time() . rand(100, 999) . '.' . $extension;
            $path = (string)$file->move('uploads/', $name);
            $post->image = $path;
        }
        $post->$role = $user->id;
        $post->save();

        return ApiResponse::success(['post' => $post]);

    }

    public function update($id, CreatePostRequest $request)
    {

        $post = Post::find($id);
        if (!$post) {
            ApiResponse::error(null, 404, 'post not found');
        }
        $post->title = $request->title;
        $post->content = $request->content;
        $post->status = $request->status;
        if ($request->hasFile('image')) {
            if (file_exists($post->image)) {
                unlink($post->image);
            }
            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension());
            $name = time() . rand(100, 999) . '.' . $extension;
            $path = (string)$file->move('uploads/', $name);
            $post->image = $path;
        }
        $post->save();

        return ApiResponse::success(['post' => $post]);

    }

    public function delete($id)
    {
        $post = Post::find($id);
        if (!$post) {
            ApiResponse::error(null, 404, 'post not found');
        }
        if (file_exists($post->image)) {
            unlink($post->image);
        }
        $post->delete();
        return ApiResponse::success();
    }
}
