<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Foundation\Http\FormRequest;

class CreateFeedbackRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'comment' => ['required', 'string'],
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'photo' => ['image', 'nullable'],
            'product_id' => ['required', 'exists:products,id']
        ];
    }
}
