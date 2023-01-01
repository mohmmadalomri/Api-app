<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['title','content','user_id','image'];

    public function coments(){
        return $this->hasMany(Coment::class,'post_id','id');
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

}
