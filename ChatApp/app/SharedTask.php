<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SharedTask extends Model
{
    public function sharedBy(){
        $this->belongsTo('\App\User', 'shared_by_id');
    }
    
    public function sharedWith(){
        $this->belongsTo('\App\User', 'shared_with_id');
    }
}
