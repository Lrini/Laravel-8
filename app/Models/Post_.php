<?php

namespace App\Models;

class Post 
{
    private static $blog_posts=[
            [
                "title" => "judul post pertama",
                "slug" => "judul-post-pertama",
                "author" => "sandhika galih",
                "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus officia iusto quibusdam illum voluptatem dignissimos nemo. Consequuntur asperiores explicabo, iste veritatis, 
                            doloribus id cumque nihil quod magnam odio voluptates saepe."
            ],
            [
                "title" => "judul post kedua",
                "slug" => "judul-post-kedua",
                "author" => "sandhika galih",
                "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus officia iusto quibusdam illum voluptatem dignissimos nemo. Consequuntur asperiores explicabo, iste veritatis, 
                            doloribus id cumque nihil quod magnam odio voluptates saepe."
            ]
            ];

            public static function all()
            {
                return collect(self ::$blog_posts);
            }

            public static function find ($slug){
                $posts = static::all();
                return $posts->firstWhere('slug',$slug);
            }
}
 