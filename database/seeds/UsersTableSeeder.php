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
    		'name'=>'Mohammed',
            'last_name'=>'Adamu',
    		'email'=>'admin@mycota.com',
            'phone'=>'9875244242',
            'gender'=>'Male',
            'active'=>1,
            'email_verified_at'=>time(),
    		'password'=>bcrypt('00mohamed')
    	]);

        $admin2 = User::create([
            'name'=>'Charles',
            'last_name'=>'Spurgeon',
            'email'=>'spurgeon82@gmail.com',
            'phone'=>'6355949454',
            'gender'=>'Male',
            'active'=>1,
            'email_verified_at'=>time(),
            'password'=>bcrypt('00mohamed')
        ]);

    	$accounts = User::create([
    		'name'=>'Parth',
            'last_name'=>'Jadeja',
            'email'=>'parth@gmail.com',
            'phone'=>'9875774242',
            'gender'=>'Male',
            'active'=>1,
            'email_verified_at'=>time(),
            'password'=>bcrypt('00mohamed')
    	]);

    	$sales = User::create([
    		'name'=>'Vishnu',
            'last_name'=>'Pathak',
            'email'=>'vishnu@gmail.com',
            'phone'=>'9135800709‬',
            'gender'=>'Male',
            'active'=>1,
            'email_verified_at'=>time(),
            'password'=>bcrypt('00mohamed')
    	]);

        $admin->roles()->attach($adminRole);
    	$admin2->roles()->attach($adminRole);
    	$accounts->roles()->attach($accountsRole);
    	$sales->roles()->attach($salesRole);

        // factory(App\User::class, 0)->create();
    }
}
