<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class PostCategory extends Model
{
    use HasFactory,Sluggable;
    protected $fillable = ['title','slug','description','meta_description','meta_keywords','thumbnail', 'image','sort_order','status'];

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
