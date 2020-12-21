<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class CreateProfileRequest extends FormRequest
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
            'first_name'  => 'string|max:255',
            'last_name'   => 'string|max:255',
            'address_1'   => 'string|max:255',
            'address_2'   => 'string|max:255',
            'city'        => 'string|max:255',
            'state'       => 'string|max:255',
            'zip'         => 'string|max:255',
            'phone_1'     => 'string|max:255',
            'phone_2'     => 'string|max:255',
            'email'       => 'required|email|unique:profiles|max:255',
            'geolocation' => 'string|max:1000',
        ];
    }
}
