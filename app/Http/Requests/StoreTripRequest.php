<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'days' => 'required|array',
            'days.*.date' => 'required|date',
            'days.*.description' => 'nullable|string',
            'days.*.stops' => 'required|array',
            'days.*.stops.*.name' => 'required|string|max:255',
            'days.*.stops.*.description' => 'nullable|string',
        ];
    }
}
