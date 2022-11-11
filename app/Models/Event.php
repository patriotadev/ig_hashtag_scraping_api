<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $primaryKey = 'id';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'event',
        'hashtag',
        'transition',
        'grid',
        'data_instagram'
    ];
}
