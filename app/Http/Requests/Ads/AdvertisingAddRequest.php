<?php

namespace App\Http\Requests\Ads;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisingAddRequest extends FormRequest
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
            'title_fa' => 'required',
            'title_en' => 'required',
            'title_ar' => 'required',
            'banner' => 'required|mimes:jpg,png,webp,jpeg|max:500000',
            'expired_at' => 'required',
            'link' => "required",
            'category_id' => 'required',
        ];
    }
}
