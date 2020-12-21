<?php

namespace App\Http\Requests\Interaction;

use App\Models\InteractionOutcome;
use App\Models\InteractionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInteractionRequest extends FormRequest
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
            'type' => [
                Rule::in(InteractionType::all()),
            ],

            'outcome'               => [
                Rule::in(InteractionOutcome::all()),
            ],
            'interaction_timestamp' => 'date',
            'geolocation'           => 'string|max:1000',
            'profile_id'            => 'integer|min:1|max:2147483647|exists:profiles,id',
        ];
    }
}
