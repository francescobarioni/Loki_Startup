<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    use HasFactory;

    protected $table = 'plot';

    protected $fillable = [
        'plot_name',
        'chat_room_name',
        'vocal_room_name',
    ];
}
