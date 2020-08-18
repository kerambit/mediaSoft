<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Role::class)->state('Admin')->create();

        factory(\App\Role::class)->state('Manager')->create();

        factory(\App\Role::class)->create();
    }
}
