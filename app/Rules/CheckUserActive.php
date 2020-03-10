<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;


class CheckUserActive implements Rule
{
    protected $email;
    protected $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::where('email', $this->email)->first();
        // dd($this->email);
        if (!$user) {
            return $this->fail("Sorry, wrong email");
            return false;
        }

        if ($user->active == 'Inactive') {
            
            return $this->fail("Sorry you are not Active on the system, please contact system administrator.");
            return false;
        }

        if ($user->email_verified_at == NULL) {
            
            return $this->fail("Sorry please very your email.");
            return false;
        }

        return true;
    }

    protected function fail($message)
    {
        $this->message = $message;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
