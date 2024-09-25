<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;

class ApiCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return Comment::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'body' => 'required|string|max:500',
            'author_id' => 'required|exists:users,id',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'require'|'string', // اطمینان از مدل‌های مجاز
            'approved' => 'required|numeric|in:0,1',
            'status' => 'required|numeric|in:0,1',
            'parent_id' => 'nullable|integer',  // اگر از کامنت‌های سلسله‌مراتبی استفاده می‌کنید
            'seen' => 'required|numeric|in:0,1'
        ]);


        // ایجاد نظر جدید
        $comment = Comment::create([
            'body' => $validatedData['body'],
            'parent_id' => $validatedData['parent_id'] ?? null,
            'author_id' => $validatedData['author_id'],
            'commentable_id' => $validatedData['commentable_id'],
            'commentable_type' => $validatedData['commentable_type'],
            'approved' => $validatedData['approved'],
            'status' => $validatedData['status'],
        ]);

        return response()->json([
            'message' => 'Comment created successfully!',
            'comment' => $comment,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
