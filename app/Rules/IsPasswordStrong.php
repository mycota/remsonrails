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
        
        
        if( !preg_match("#[0-9]+#", $this->password) ) {
           
           $this->message = "Password must include at least a number!"; 
           return false;
        
        }

        if( !preg_match("#[a-z]+#", $this->password) ) {
         
            $this->message = "Password must include at least a letter!";
            return false;

        }

        if( !preg_match("#[A-Z]+#", $this->password) ) {
        
            $this->message = "Password must include at least a CAPS!";
            return false;

        }

        if( !preg_match("#\W+#", $this->password) ) {
            
            $this->message = "Password must include at least a symbol!";
            return false;

        }

        return true;
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
