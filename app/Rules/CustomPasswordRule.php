<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CustomPasswordRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the password has at least 6 characters
        if (strlen($value) < 6) {
            return false;
        }

        // Check if the password contains at least one uppercase letter
        if (!preg_match('/[A-Z]/', $value)) {
            return false;
        }

        // Check if the password contains at least one number
        if (!preg_match('/[0-9]/', $value)) {
            return false;
        }

        // Check if the password contains at least one special symbol
        if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $value)) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'The password must be at least 6 characters long and contain at least one uppercase letter, one number, and one special symbol.';
    }
}

