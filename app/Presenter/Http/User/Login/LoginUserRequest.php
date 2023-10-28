<?php

declare(strict_types=1);

namespace App\Presenter\Http\User\Login;

use App\Application\User\Login\LoginUserCommand;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function toCommand(): LoginUserCommand
    {
        return new LoginUserCommand(
            ...$this->safe()->all()
        );
    }
}
