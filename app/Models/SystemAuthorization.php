<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemAuthorization extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id','name', 'route_url','icon','role_id','status','sort_order','route_name'];
    
    public function children(){
        return $this->hasMany(self::class, 'parent_id')
            ->where('status', 1)
            ->orderBy('sort_order');
    }

}
