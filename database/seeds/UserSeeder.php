<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = factory(\App\User::class)->create([
            'email' => 'admin@example.com'
        ]);

        $admin->roles()->attach(1);

        $manager = factory(\App\User::class)->create([
            'email' => 'manager@example.com'
        ]);

        $manager->roles()->attach(2);

        $basicUsers = factory(\App\User::class, 7)->create()
            ->each(function ($user){
                $user->roles()->attach(3);
            });
    }
}
