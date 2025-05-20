<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //protected $fillable = ['title','category_id','slug','excerpt','body'];
    protected $guarded =['id']; //protected id mengindikasikan bahwa id hanya bisa diakases di halaman post dan turunannya(subclass)
    //guarded menentukan atribut yang tidak bisa diakses
    public function category()
    {
        return $this->belongsTo(Category::class); //membuat relasi antara post dan category, belongTo artinya post memiliki category
        //one to many atau many to one
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
