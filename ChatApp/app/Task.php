<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_title', 'task_body', 'created_by_id', 'due_date', 
    ];
    
    
    public function users(){
        return $this->belongsTo('App\User', 'created_by_id');
    }
}
