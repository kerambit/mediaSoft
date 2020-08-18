<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Task::class, 25)->make([
            'checklist_id' => null,
            'user_id' => null,
        ])->each(function ($task) {
            $checklist = \App\Checklist::inRandomOrder()->first();
            $task->checklist_id = $checklist->id;
            $task->user_id = $checklist->user_id;
            $task->save();
        });
    }
}
