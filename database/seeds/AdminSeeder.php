<?php

use Illuminate\Database\Seeder;
use \App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\User::create([
//            'name' => 'Admin',
//            'email' => 'admin@admin.com',
//            'email_verified_at' => now(),
//            'password' => bcrypt('mynameisadmin'),
//            'approved_at' => now(),
//        ]);

        $user = new \App\User();
        $user->name = 'Admin';
        $user->email = 'admin@me.com';
        $user->approved_at = now();
        $user->email_verified_at = now();
        $user->password = bcrypt('mynameisadmin');
        $user->save();
        $roleId = 4;
        $user->roles()->sync($roleId);


    }


}
