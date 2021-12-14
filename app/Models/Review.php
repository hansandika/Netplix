<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'review';
    public $timestamps = false;
    protected $fillable = [
        'show_id',
        'user_id',
        'rating',
        'body',
        'review_date'
    ];
    protected $dates = [
        'review_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
