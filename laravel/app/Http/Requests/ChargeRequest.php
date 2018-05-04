<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChargeRequest extends FormRequest
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
            'cardnumber'    => 'required|max:19',
            'expiration'    => 'required|date_format:"m/d/Y"',
            'cvc'           => 'required|min:3|max:4|numeric',
            'zip'           => 'required|max:5',
        ];
    }
}
