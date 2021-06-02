<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasRelationships;

    protected $fillable = [
        'title',
        'content',
        'status_id',
        'creator_id'
    ];

    protected $primaryKey = 'id';
    
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function status()
    {
        return $this->hasOne(PostStatus::class, 'id', 'status_id');
    }
}
