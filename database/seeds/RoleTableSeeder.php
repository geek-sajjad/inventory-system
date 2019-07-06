<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stockManager = new Role();
        $stockManager->name = 'Stock Manager';
        $stockManager->save();

        $logisticManager = new Role();
        $logisticManager->name = 'Logistic Manager';
        $logisticManager->save();

        $assistant = new Role();
        $assistant->name = 'Assistant';
        $assistant->save();

        $admin = new Role();
        $admin->name = 'Admin';
        $admin->save();

        $simpleUser = new Role();
        $simpleUser->name = 'Simple User';
        $simpleUser->save();
    }
}
