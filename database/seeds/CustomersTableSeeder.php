<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::truncate();
// am using the create but not DB::table('customers')->insert([]) because create allows the timestamps methods to work and the time(), but DB allows you to insert many values in array and does not allow timestamps methods to work and the time()
        Customer::create([
        'user_id' => 1,
        'country_currency_symbol_id'=>79,
        'customer_name' => 'Taniya Sharma Chirag',
        'phone' => '9537134589',
        'email' => 'taniyaSC@gmail.com',
        'gender' => 'Female',
        'pincode' => '370008',
        'address' => 'Mumbai Central',
        'place' => 'Mumbai'

        ]);

        Customer::create([
        'user_id' => 1,
        'country_currency_symbol_id'=>79,
        'customer_name' => 'Divyesh Kevlani',
        'phone' => '9530096733',
        'email' => 'DKevlani@gmail.com',
        'gender' => 'Male',
        'pincode' => '350003',
        'address' => 'Ahmedabad',
        'place' => 'Ahmedabad'

        ]);

        Customer::create([
        'user_id' => 1,
        'country_currency_symbol_id'=>79,
        'customer_name' => 'Munshi Sohag Hossen',
        'phone' => '8654329086',
        'email' => 'sohagh@yahoo.com',
        'gender' => 'Male',
        'pincode' => '380002',
        'address' => 'Chennai',
        'place' => 'Chennai'
    ]);

}
}
