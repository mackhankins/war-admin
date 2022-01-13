<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCharacterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'character_name' => 'required',
            'character_company' => 'required',
            'guilded_name' => 'required',
            'character_level' => 'required|numeric',
            'primary_role' => 'required',
            'primary_weapon' => 'required',
            'primary_weapon_level' => 'required|numeric',
            'second_weapon' => 'required',
            'second_weapon_level' => 'required|numeric',
            'gear_score' => 'required|numeric|gt:0',
            'third_weapon' => 'sometimes|nullable',
            'fourth_weapon' => 'sometimes|nullable',
            'fifth_weapon' => 'sometimes|nullable',
            'share_information' => 'required|boolean',
        ];
    }
}
