<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primarykey = 'category_id';

    public function post(){
        return $this->hasMany(Post::class,'category','category_id');
    }
}
