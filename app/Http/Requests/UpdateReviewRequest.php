<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comment' => 'sometimes|string|min:10|max:1000',
            'rating' => 'sometimes|integer|min:1|max:5',
        ];
    }
}