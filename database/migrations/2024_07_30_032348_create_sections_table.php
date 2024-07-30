<?php

use App\Models\Section;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('sections', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('thumbnail');
      $table->enum('post_as', ['JUMBOTRON', 'ABOUT']);
      $table->longText('content');
      $table->timestamps();
    });

    Section::create([
      'title' => 'Pandu Prasasti',
      'thumbnail' => 'VWml0lNjEJ9H4mD1MaIY0ApRBwHbsM-metaZnJlZWxhbmNlci5wbmc=-.png',
      'post_as' => 'JUMBOTRON',
      'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo non nisi nesciunt aut. Quo itaque ullam laborum tempora atque explicabo amet, sed, quod excepturi consequuntur architecto libero officia tenetur ducimus.'
    ]);
    Section::create([
      'title' => 'About Us',
      'thumbnail' => 'ZCXLvyabsRQkvAEImPIHo0qKzFBA0P-metaODkwNzYuanBn-.jpg',
      'post_as' => 'ABOUT',
      'content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum quos laborum nulla dicta itaque, suscipit accusantium eius necessitatibus doloribus mollitia? Accusantium molestiae fugit officiis consequatur hic pariatur debitis itaque magni!'
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('sections');
  }
};
