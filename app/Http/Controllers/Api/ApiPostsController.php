<?php

namespace App\Http\Controllers\Api;

use App\Models\Content\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // اعتبارسنجی ورودی‌ها
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug|max:255',
            'summary' => 'required|string|max:500',
            'body' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|numeric|in:0,1',
            'commentable' => 'required|boolean',
            'published_at' => 'nullable|date',
            'author_id' => 'required|exists:users,id',
            'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'category_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:post_categories,id',
        ]);

        // بارگذاری تصویر اگر وجود داشته باشد
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // ایجاد پست جدید
        $post = Post::create([
            'title' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'summary' => $validatedData['summary'],
            'body' => $validatedData['body'],
            'image' => $validatedData['image'] ?? null,
            'status' => $validatedData['status'],
            'commentable' => $validatedData['commentable'],
            'author_id' => $validatedData['author_id'],
            'published_at' => $validatedData['published_at'],
            'tags' => $validatedData['tags'],
            'category_id' => $validatedData['category_id'],
        ]);

        // بازگشت پاسخ موفقیت
        return response()->json([
            'message' => 'Post created successfully!',
            'post' => $post,
        ], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'summary' => 'required|max:300|min:5|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u',
            'category_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:post_categories,id',
            'image' => 'image|mimes:png,jpg,jpeg,gif',
            'status' => 'required|numeric|in:0,1',
            'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'body' => 'required|max:600|min:5|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u',
            'published_at' => 'required|numeric',
        ]);

        // بارگذاری تصویر اگر وجود داشته باشد
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $post = Post::findOrfail($id);
        $post->update($request->all());
        // به‌روزرسانی پست با داده‌های معتبر

        return response()->json([
            'message' => 'Updated posted successfully!',
            'post' => $post,
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully!'
        ], 200);
    }
}
