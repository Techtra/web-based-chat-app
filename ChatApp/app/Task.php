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

    public function getNumberOfDaysToDueDateAttribute(){
        if($this->due_date){
            $ret = ceil((strtotime($this->due_date) - strtotime('now'))/(60));

            if($ret == 0)
                return $ret;
        }
    }
}
