<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CommentsAPiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'body' => 'required|string|max:500',
            'author_id' => 'required|exists:users,id',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string', // اطمینان از مدل‌های مجاز
            'approved' => 'required|numeric|in:0,1',
            'status' => 'required|numeric|in:0,1',
            'parent_id' => 'nullable|integer',  // اگر از کامنت‌های سلسله‌مراتبی استفاده می‌کنید
            'seen' => 'required|numeric|in:0,1'
        ];
    }
}
