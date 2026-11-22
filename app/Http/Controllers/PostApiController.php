<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostApiController extends Controller
{
    public function index()
    {
        return PostResource::collection(
            Post::paginate(10)
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = Post::create($validated);

        return response()->json([
            'message' => 'Post created successfully',
            'data' => new PostResource($post)
        ], 201);
    }

    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        return new PostResource($post);
    }

    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
        ]);

        $post->update($validated);

        return response()->json([
            'message' => 'Post updated successfully',
            'data' => new PostResource($post)
        ], 200);
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return response()->noContent();
    }
}
