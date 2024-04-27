<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'required',
            'make' => 'required',
            'model' => 'required',
            'color' => 'required',
            'year' => 'required',
            'transmission' => 'required',
            'car_type' => 'required',
            'price' => 'required',
            'photo' => 'required|image',
            'user_id' => 'required',
        ];
    }
}
