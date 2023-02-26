<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    protected $fillable = ['user_type','user_id', 'post_id', 'parent_id', 'comment','status'];

    public function admin()
    {
        return $this->belongsTo(Admin::class,"user_id");
    }
    /**
     * The belongs to Relationship
     *
     * @var array
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function replies()
    {
        return $this->hasMany(PostComment::class, 'parent_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
