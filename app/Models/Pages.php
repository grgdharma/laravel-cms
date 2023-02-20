<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Pages extends Model
{
    use HasFactory, Sluggable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id','title', 'sub_title','slug','image', 'thumbnail','description','meta_description', 'video_url','meta_keywords','template','sort_order','status'];

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
