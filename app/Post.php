<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

use Authenticatable;

class Post extends Model
{
    use Sluggable;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    public function user()
     {
         User::class == 'App\User';
         return $this->belongsTo(User::class);
     }
     public function sluggable()
     {
         return [
             'slug' => [
                 'source' => 'title'
             ]
         ];
     }
}
