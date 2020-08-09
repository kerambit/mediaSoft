<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{


    /**
     * Get the task for user.
     */
    public function task()
    {
        return $this->belongsTo('App\Checklist', 'checklist_id', 'id');
    }
}
