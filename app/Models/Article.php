<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image',
        'status',
        'featured',
        'spotlight',
        'trashed_reason',
        'category_id',
        'view_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(ArticleLike::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->latest();
    }

    public function allComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function isLikedBy($user)
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) return null;

        // Jika sudah berupa URL penuh (misal dari seeder), langsung kembalikan
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // Ambil URL secara dinamis dari storage disk yang aktif
        // Ini akan otomatis bekerja baik di Supabase maupun Laravel Cloud
        return \Illuminate\Support\Facades\Storage::disk(config('filesystems.default'))->url($this->image);
    }
}