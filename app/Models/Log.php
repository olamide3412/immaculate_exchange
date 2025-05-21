<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'log',
        'user_id',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
