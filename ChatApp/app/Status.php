<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'status_body', 
    ];

    public function users()
    {
        return $this->hasMany('\App\User');
    }
}
