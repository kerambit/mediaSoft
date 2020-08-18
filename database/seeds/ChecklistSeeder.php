<?php

use Illuminate\Database\Seeder;

class ChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Checklist::class, 12)->make(['user_id' => null])
            ->each(function ($checklist) {
                $user = \App\User::inRandomOrder()->first();
                $checklist->user_id = $user->id;
                $checklist->save();
            });
    }
}
