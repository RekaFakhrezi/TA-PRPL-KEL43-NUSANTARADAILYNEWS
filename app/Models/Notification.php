<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type', // article_approved, article_rejected, new_like, new_comment
        'message',
        'link',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
