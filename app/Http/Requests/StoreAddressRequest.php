<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
            //
            'user_id' => ['required', 'numeric'],
            'county' => ['required', 'string'],
            'sub_county' => ['required', 'string'],
            'estate' => ['required', 'string'],
            'house_number' => ['required', 'string'],
        ];
    }
}
