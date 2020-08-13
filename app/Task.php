<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'checklist_id', 'user_id', 'text', 'checked'
    ];

    /**
     * Get the task for user.
     */
    public function task()
    {
        return $this->belongsTo('App\Checklist', 'checklist_id', 'id');
    }
}
