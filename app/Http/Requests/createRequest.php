<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * ユーザーがこの要求を行うことを許可されているかどうかを判別
     *
     *@return bool
     */
    public function authorize()
    {
        // falseを返すと 403: This action UnAuthorized が返される
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * リクエストに適用される検証ルールを定義:取得
     *
     * @return array<string, mixed>
     *
     */
    public function rules()
    {
        return [
            'status' => 'required|integer|in:1,2,3',
            'title' => 'required|string|max:100',
            'due_date' => 'nullable|date|after_or_equal:now',
            'assignee' => 'required|string|max:20',
        ];
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'status.required' => '状況の選択は必須です。',
            'title.required' => 'タイトルは必須です。',
            'title.max' => 'タイトルは100文字以下です。',
            'due_date.after_or_equal' => '期日は今日以降の日付でなければなりません。',
            'assignee.required' => '担当者は必須です。',
        ];
    }

    /**
     * バリデーションエラーのカスタム属性の取得
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'status' => '状況',
            'title' => 'タイトル',
            'due_date' => '期日',
            'assignee' => '担当者',
        ];
    }
}
