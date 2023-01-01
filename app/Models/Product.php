<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $hidden=['updated_at','created_at'];
    protected $fillable=['name','price','description','quntity','category_id'];

    public  function category(){
        return $this->belongsTo(Category::class);
    }
}
