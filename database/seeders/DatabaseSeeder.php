<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\Section;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run()
  {
    // \App\Models\User::factory(10)->create();

    User::create([
      'name' => 'Admin',
      'email' => 'admin@admin.com',
      'password' => Hash::make('admin@admin.com')
    ]);

    $faker = Factory::create();
    $name = $faker->name();

    Category::create([
      'name' => $name,
      'slug' => str_replace(' ', '-', strtolower($name)),
    ]);

    Post::create([
      'category_id' => '1',
      'title' => 'Belajar Laravel',
      'slug' => 'belajar-laravel',
      'content' => $faker->sentence(),
      'status' => rand(0, 1),
      'image' => 'avatar-' . rand(1, 5) . '.png'
    ]);

    // Section::create([
    //   'title' => 'Merah Muda',
    //   'thumbnail' => 'avatar-' . rand(1, 5) . '.png',
    //   'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum culpa quam, temporibus minima amet quas praesentium dolorum, incidunt, sunt velit cumque illo neque excepturi earum? Quia quas voluptatum in aliquam.',
    //   'post_as' => 'JUMBOTRON'
    // ]);

    // Section::create([
    //   'title' => 'Jingga Mula',
    //   'thumbnail' => 'avatar-' . rand(1, 5) . '.png',
    //   'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore quam dolorem ea eveniet iste nesciunt, nobis eligendi, nostrum unde rerum dicta tempora temporibus vitae, at porro neque natus aspernatur dolorum!',
    //   'post_as' => 'ABOUT'
    // ]);
  }
}
