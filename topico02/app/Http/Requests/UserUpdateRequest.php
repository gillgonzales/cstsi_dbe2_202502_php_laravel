<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return $this->user()->can('update',UserPolicy::class);
        // return Gate::allows('update',[$this->user(),User::class]);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => ' nullable | string | max:50 | min:3',
            'email'     => ' nullable | email | unique:users',
            'password'  => ' nullable | confirmed | string | min:8',
        ];
    }
}
