<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppResponse extends Model
{
    /** @use HasFactory<\Database\Factories\WhatsAppResponseFactory> */
    use HasFactory;

    protected $fillable = ['name','triggers', 'response', 'match_type', 'is_active'];
}
