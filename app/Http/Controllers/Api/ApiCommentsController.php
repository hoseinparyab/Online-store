<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CommentsAPiRequest;
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
     * @param  \App\Http\Requests\Api\CommentsApiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentsApiRequest $request)
    {
        // ایجاد نظر جدید با داده‌های معتبر
        $comment = Comment::create($request->validated());

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
        $comment = Comment::findOrfail($id);
        return response()->json([
            'message' => 'Comment retrieved successfully!',
            'comment' => $comment,
        ], 200);
    }

    /**
     * Answer to a comment.
     *
     * @param  \App\Http\Requests\Api\CommentsApiRequest  $request
     * @param  \App\Models\Content\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function answer(CommentsAPiRequest $request, Comment $comment)
    {
        // بررسی اینکه آیا کامنت مورد نظر، کامنت اصلی است و پاسخ ندارد
        if ($comment->parent == null) {
            // تنظیم داده‌های اضافی برای پاسخ
            $validatedData = $request->validated();
            $validatedData['author_id'] = 1; // شناسه نویسنده (کاربر لاگین‌شده)
            $validatedData['parent_id'] = $comment->id;
            $validatedData['commentable_id'] = $comment->commentable_id;
            $validatedData['commentable_type'] = $comment->commentable_type;
            $validatedData['approved'] = 1; // اگر تایید خودکار دارید
            $validatedData['status'] = 1;

            // ایجاد پاسخ به کامنت
            $newComment = Comment::create($validatedData);

            return response()->json([
                'message' => 'پاسخ با موفقیت ایجاد شد!',
                'comment' => $newComment,
            ], 201);
        } else {
            return response()->json([
                'message' => 'این کامنت اصلی نیست یا قبلاً پاسخ داده شده است.',
            ], 422);
        }
    }
}
