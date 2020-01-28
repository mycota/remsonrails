<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsPasswordStrong implements Rule
{

    protected $password;
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
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

        // if ($this->password < 8) {

        //    return $this->fail("Password length must be more than 8.");

        // }

        if( !preg_match("#[0-9]+#", $this->password) ) {

            return $this->fail("The password must include at least a number!");


        }

        if( !preg_match("#[a-z]+#", $this->password) ) {

            return $this->fail("The password must include at least a lower letter!");


        }

        if( !preg_match("#[A-Z]+#", $this->password) ) {

            return $this->fail("The password must include at least a CAPS!");


        }

        if( !preg_match("#\W+#", $this->password) ) {

            return $this->fail("The password must include at least a symbol!");

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
