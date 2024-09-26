<?php

namespace App\Http\Controllers\Api;

use App\Models\Content\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostsAPiRequest;

class ApiPostsController extends Controller
{
    private function handleImageUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('images', 'public');
        }
        return null;
    }

    public function index()
    {
        return Post::all();
    }

    public function store(PostsAPiRequest $request)
    {
        $validatedData = $request->validated();
        $imagePath = $this->handleImageUpload($request);
        if ($imagePath) {
            $validatedData['image'] = $imagePath;
        }

        $post = Post::create($validatedData);

        return response()->json([
            'message' => 'Post created successfully!',
            'post' => $post,
        ], 201);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json([
            'message' => 'Post retrieved successfully!',
            'post' => $post,
        ], 200);
    }

    public function update(PostsAPiRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $validatedData = $request->validated();

        $imagePath = $this->handleImageUpload($request);
        if ($imagePath) {
            $validatedData['image'] = $imagePath;
        }

        $post->update($validatedData);

        return response()->json([
            'message' => 'Post updated successfully!',
            'post' => $post,
        ], 200);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully!',
        ], 200);
    }
}
