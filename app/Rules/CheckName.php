<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckName implements Rule
{
    protected $name;
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
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
        if( preg_match("#[0-9]+#", $this->name) ) {

            return $this->fail("Name must not include a number!");


        }


        if( preg_match("#\W+#", $this->name) ) {

            return $this->fail("Name must not include a symbol!");

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
