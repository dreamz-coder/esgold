<?php

namespace App\Http\Requests\User\Withdraw;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreWithdrawRequest extends FormRequest
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
            'amount' => 'required',
            'user_id' => 'nullable',
            'account_number' => 'nullable',
            'notes' => 'nullable',
            'withdraw_amount' => 'nullable',
            'tax' => 'nullable'
        ];
    }

    public function passedValidation()
    {
        $this->validator->setData(
            $this->safe()->except('account_number', 'user_id')
                +
                [
                    'user_id' => Auth::id(),
                    'account_number' => Auth::user()->account_number
                ]
        );
    }
}
