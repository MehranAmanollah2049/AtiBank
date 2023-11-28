<?php

namespace App\Http\Requests\About;

use Illuminate\Foundation\Http\FormRequest;

class EditMainRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "content_fa" => 'required',
            "content_en" => 'required',
            "content_ar" => 'required',
        ];
    }
}
