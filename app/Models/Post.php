<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $primarykey = 'post_id';

    public function comment(){
        return $this->hasMany(Comment::class,'post','post_id');
    }

    public function person(){
        return $this->belongsTo(Person::class,'person','person_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category','category_id');
    }
}
