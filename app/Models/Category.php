<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'showcategory';
    public function movie()
    {
        return $this->hasMany(Movie::class, 'show_id');
    }
}
