<?php

use Illuminate\Database\Seeder;
use App\PaymentTerm;

class PaymentTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentTerm::truncate();

        $paymentTerms = array('50% Advance On Order Confirmation', '50% On Material Dispatch', '25% Advance On Order Confirmation', '25% On Material Dispatch', '40% On Glass Being Order', '10% On Installation'); // in future just add more to this array if you get new payment terms

        for($i = 0; $i < count($paymentTerms); $i++)
        {
        	PaymentTerm::create(['user_id'=>1, 'name'=>$paymentTerms[$i], 'comment'=>'Company default payment terms']);
        }
    }
}
