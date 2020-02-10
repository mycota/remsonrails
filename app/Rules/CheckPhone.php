<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;
use App\Customer;

class CheckPhone implements Rule
{
    protected $phone;
    // protected $id;
    protected $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($phone)
    {
        $this->phone = $phone;
        // $this->id = $id;
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
        // if ($this->id != NULL) {
        //     @$phoneUser = User::where('phone', $this->phone)->first();
        //     @$phoneCustomer = Customer::where('phone', $this->phone)->first();

        //     if ($phoneUser or $phoneCustomer) {
        //         @$dbuser = @$phoneUser->id;
        //         @$dbcust = @$phoneCustomer->id;
        
        //         if (($this->id != @$dbuser) or ($this->id != @$dbcust))   {

        //             return $this->fail("Phone number already exist.".@$dbuser.','.@$dbcust);
        //         }
            
        //     }
            
        
        // }


        if (strlen($this->phone) < 10) {

           return $this->fail("Phone number must be exactly 10 digits.");

        }

        if( preg_match("#\W+#", $this->phone) ) {

            return $this->fail("Phone number must not include a symbol!");

        }

        if( preg_match("#[a-z]+#", $this->phone) ) {

            return $this->fail("Phone number must not include a letter!");

        }

        if( preg_match("#[A-Z]+#", $this->phone) ) {

            return $this->fail("Phone number must not include a letter!");

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
