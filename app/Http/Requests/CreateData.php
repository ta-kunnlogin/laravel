<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateData extends FormRequest
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
            'date' => 'required|date',
            'morning' => 'required|max:50',
            'type_id_1' => 'required',
            'afternoon' => 'required|max:50',
            'type_id_2' => 'required',
            'comment' => 'max:400',
        ];
    }
}
