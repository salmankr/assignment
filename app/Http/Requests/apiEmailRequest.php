<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class apiEmailRequest extends FormRequest
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
            'reference' => ['required', 'string', 'unique:requests'],
            'webhook_url' => ['required', 'string'],
            'data' => ['required'],
            'data.from' => ['required', 'string', 'email'],
            'data.to' => ['required', 'string', 'email'],
            'data.cc' => ['required', 'string', 'email'],
            'data.bcc' => ['required', 'string', 'email'],
            'data.subject' => ['required', 'string'],
            'data.body' => ['required', 'string'],
        ];
    }
}
