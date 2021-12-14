<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;
    protected $table = 'watchlist';
    public $timestamps = false;
    protected $primaryKey = ["show_id", "user_id"];
    public $incrementing = false;


    protected $fillable = [
        'show_id',
        'user_id',
        'status'
    ];
}
