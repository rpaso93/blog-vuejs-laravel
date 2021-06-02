<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostStatus extends Model
{
    use HasFactory;

    protected $table = 'post_status';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}
