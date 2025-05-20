<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // User::create([
        //     'name' => 'Immanuel Rini',
        //     'email' => 'immanuelrini@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        // User::create([
        //     'name' => 'dodo oematan',
        //     'email' => 'dodo@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        // User::create([
        //     'name' => 'Jestman Windoe',
        //     'email' => 'jestman@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);
        User::factory(3)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);
        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Post::factory(20)->create();
        // Post::create([
        //     'title' => 'Belajar Laravel',
        //     'slug' => 'belajar-laravel',
        //     'excerpt' => 'Belajar Laravel adalah hal yang sangat menyenangkan',
        //     'body' => 'Belajar Laravel adalah hal yang sangat menyenangkan karena Laravel adalah framework',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);
        // Post::create([
        //     'title' => 'Belajar CodeIgniter',
        //     'slug' => 'belajar-codeigniter',
        //     'excerpt' => 'Belajar codeigniter adalah hal yang sangat menyenangkan',
        //     'body' => 'Belajar codeigniter adalah hal yang sangat menyenangkan karena Laravel adalah framework',
        //     'category_id' => 1,
        //     'user_id' => 2
        // ]);
        // Post::create([
        //     'title' => 'Psikotes',
        //     'slug' => ' psikotes',
        //     'excerpt' => ' Psikotes adalah hal yang sangat menyenangkan',
        //     'body' => 'Psikotes adalah hal yang sangat menyenangkan karena Psikotes adalah hal yang sangat menyenangkan',
        //     'category_id' => 2,
        //     'user_id' => 3
        // ]);


    }
}
