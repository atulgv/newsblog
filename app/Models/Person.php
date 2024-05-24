<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $primarykey = 'person_id';

    public function post(){
        return $this->hasMany(Post::class,'person','person_id');
    }

    public function comment(){
        return $this->hasMany(Comment::class,'person','person_id');
    }
}
