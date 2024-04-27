<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = [
        'title',
        'body',];


    protected $fillable = [
        'title',
        'body',
        'image',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function getCreatedAtHourAttribute()
    {
        if (app()->getLocale() === 'ar') {
            Carbon::setLocale('ar');
            return Carbon::parse($this->attributes['created_at'])->isoFormat('h:mm A');
        } else {
            return Carbon::parse($this->attributes['created_at'])->format('h:i A');
        }
    }

    public function getFormattedCreatedDateAttribute()
    {
        if (app()->getLocale() === 'ar') {
            Carbon::setLocale('ar');
            return Carbon::parse($this->start_date)->isoFormat('dddd - MMMM D');
        } else {
            return Carbon::parse($this->attributes['created_at'])->format('d M');
        }
    }


    public function getImageUrlAttribute()
    {
        if ($this->image) {
            $imagePath = "images/posts/{$this->image}";
            if (file_exists(public_path($imagePath))) {
                return asset($imagePath);
            } else {
                return $this->image;
            }
        }
        return null;
    }
}
