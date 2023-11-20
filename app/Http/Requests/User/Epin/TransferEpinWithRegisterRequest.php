<?php

namespace App\Http\Requests\User\Epin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class TransferEpinWithRegisterRequest extends FormRequest
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
            'name' => 'required|max:25|string',
            'user_id' => 'nullable',
            'mobile' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'referred_by' => 'nullable',
            'referral_code' => 'nullable',
            'role' => 'nullable',
            'wallet' => 'nullable',
            'level' => 'nullable'
        ];
    }

    public function passedValidation()
    {
        $this->validator->setData(
            $this->safe()->except('role', 'user_id')
                +
                [
                    'role' => 'user',
                    'user_id' => 'ESGOLD#' . str_pad(User::count() + 1, 5, '0', STR_PAD_LEFT),
                    'referral_code' => 'RC#' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT)
                ]
        );
    }
}
