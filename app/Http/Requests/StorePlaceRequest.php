<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\State;
use App\Models\City;

class StorePlaceRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'state' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (!State::where('name', $value)->exists()) {
                        $fail('O estado fornecido é inválido.');
                    }
                },
            ],
            'city' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (!City::where('name', $value)->exists()) {
                        $fail('A cidade fornecida é inválida.');
                    }
                },
            ],
        ];
    }

    /**
     * Customize the error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'state.required' => 'O campo estado é obrigatório.',
            'state.string' => 'O campo estado deve ser um texto.',
            'state.max' => 'O campo estado não pode ter mais de 255 caracteres.',
            'city.required' => 'O campo cidade é obrigatório.',
            'city.string' => 'O campo cidade deve ser um texto.',
            'city.max' => 'O campo cidade não pode ter mais de 255 caracteres.',
        ];
    }


    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $state = State::where('name', $this->state)->first();
        $city = City::where('name', $this->city)->first();

        if ($state) {
            $this->merge(['state_id' => $state->id]);
        }

        if ($city) {
            $this->merge(['city_id' => $city->id]);
        }
    }
}

