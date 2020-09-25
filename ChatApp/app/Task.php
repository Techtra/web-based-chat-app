<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Task extends Model
{
    use SoftDeletes, LogsActivity;
    
    protected $fillable = [
        'task_title', 'task_body', 'created_by_id', 'due_date', 
    ];
    
    
    public function users(){
        return $this->belongsTo('App\User', 'created_by_id');
    }

    //Activity Logs

    protected static $logAttributes = ['task_title', 'task_body', 'due_date'];


    public function getDescriptionForEvent(string $eventName): string
    {
        return "Task {$eventName}";
    }

    protected static $logName = 'Task Log';


    protected static $logOnlyDirty = true;
//     public function getNumberOfDaysToDueDateAttribute(){
//         $ret = ceil((strtotime($this->due_date) - strtotime('now'))/(60));
//             if($ret >= 0){
//                 return $ret;
//             }
//             return 0;
// }

// public function getTotalTimeAttribute(){
//     $total = ceil((strtotime($this->due_date) - strtotime($this->updated_at))/(60));
//         if($total >=0){
//             return $total;
//         }
//         return 1;
// }

// public function getTimePercentageAttribute(){
//     $percentage = 100 - ceil((($this->number_of_days_to_due_date)/($this->total_time))*100);
//         return $percentage;
// }

// public function getProgressBarColorAttribute(){
    
//     if($this->time_percentage <=20){
//         return 'bg-green';
//     }

//     if($this->time_percentage <=50){
//         return 'bg-yellow';
//     }

//     return 'bg-red';
// }

// public function getCardRibbonAttribute(){
//     if($this->time_percentage == 100){
//         return'';
//     }
// }

}
