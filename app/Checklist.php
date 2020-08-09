<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = [
        'user_id', 'title'
    ];

    /**
     * Get the task for user.
     */
    public function tasks()
    {
        return $this->hasMany('App\Task', 'checklist_id', 'id');
    }
}
