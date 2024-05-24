<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $primarykey = 'comment_id';

    public function post(){
        return $this->belongsTo(Post::class,'post','post_id');
    }

    public function person(){
        return $this->belongsTo(Person::class,'person','person_id');
    }
}
