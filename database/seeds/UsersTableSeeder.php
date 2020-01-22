<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        // getting the roles to attact it to the user
        $adminRole = Role::where('name', 'Admin')->first();
        $accountsRole = Role::where('name', 'Accounts')->first();
        $salesRole = Role::where('name', 'Sales')->first();
    	
    	$admin = User::create([
    		'name'=>'Admin',
            'last_name'=>'Adamu',
    		'email'=>'admin@mycota.com',
            'phone'=>'9875244242',
            'gender'=>'Male',
            'active'=>1,
    		'password'=>bcrypt('00mohamed')
    	]);

    	$accounts = User::create([
    		'name'=>'Yash',
            'last_name'=>'Hanj',
            'email'=>'hanj@mycota.com',
            'phone'=>'9875774242',
            'gender'=>'Male',
            'active'=>1,
            'password'=>bcrypt('00mohamed')
    	]);

    	$sales = User::create([
    		'name'=>'Kumari',
            'last_name'=>'Kumar',
            'email'=>'kumar@mycota.com',
            'phone'=>'6752944242',
            'gender'=>'Female',
            'active'=>1,
            'password'=>bcrypt('00mohamed')
    	]);


    	$admin->roles()->attach($adminRole);
    	$accounts->roles()->attach($accountsRole);
    	$sales->roles()->attach($salesRole);

        // factory(App\User::class, 0)->create();
    }
}
