<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //require to be an admin in production.
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
            'name'      => 'required|min:3|unique:events',
            'location'  => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required|time',
            'description' => 'required|min:10',
            'price'     => 'required',
        ];
    }
}
