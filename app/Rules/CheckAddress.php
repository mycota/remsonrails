<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckAddress implements Rule
{
    protected $address;
    protected $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($address)
    {
        $this->address = $address;
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
        if( preg_match("/^[a-zA-Z0-9 _\-.,:]+$/", $this->address) === 0 ) {

            return $this->fail("This field must be only letters, numbers or one of the following _ - . , :");

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
