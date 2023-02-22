<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model
{
    use HasFactory,Sluggable;
    protected $fillable = ['category_id','author_type','author_id','title', 'sub_title','slug','description', 'meta_description','meta_keywords','thumbnail', 'image', 'video_url','status'];


    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array{
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
                'includeTrashed'=>true,
            ]
        ];
    }
}
