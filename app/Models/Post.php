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
        return $this->belongsTo(User::class, 'user_id'); // membuat relasi antara post dan user, belongTo artinya post memiliki user
        // one to many atau many to one
    }

    public function scopeFilter($query, array $filters)
    {
        // jika ada filter yang diterapkan, maka akan memfilter query berdasarkan filter yang diberikan
        // misalnya jika ada filter 'search', maka akan mencari post yang memiliki judul atau isi yang sesuai dengan keyword yang diberikan
        $query->when($filters['search'] ?? false, function ($query, $search) { // $search adalah keyword yang diberikan untuk mencari post  dari variabel filter dan 
           // $query adalah query builder yang digunakan untuk mengambil data dari database
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) { // $category adalah kategori yang diberikan untuk mencari post dari variabel filter
            return $query->whereHas('category', function ($query) use ($category) { // whereHas digunakan untuk memfilter query berdasarkan relasi yang ada pada model
                $query->where('slug', $category); // mengambil data category berdasarkan slug
            });
        });

        $query->when($filters['author'] ?? false, function ($query, $author) { // $author adalah author yang diberikan untuk mencari post dari variabel filter
            return $query->whereHas('author', function ($query) use ($author) { // whereHas digunakan untuk memfilter query berdasarkan relasi yang ada pada model
                $query->where('username', $author); // mengambil data author berdasarkan username
            });
        });
    }

    public function getRouteKeyName()
    {
        return 'slug'; //menggunakan slug sebagai key untuk route
    }
}
