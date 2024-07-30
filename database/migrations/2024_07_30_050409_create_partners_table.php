<?php

use App\Models\Partner;
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
    Schema::create('partners', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('thumbnail');
      $table->longText('content');
      $table->string('link');
      $table->timestamps();
    });

    Partner::create([
      'title' => 'Grab',
      'thumbnail' => 'grab.png',
      'content' => 'Grab merupakan salah satu platform layanan on demand asal Malaysia yang bermarkas di Singapura. Berawal dari layanan transportasi, perusahaan tersebut kini telah mempunyai layanan lain seperti pengantaran makanan dan pembayaran yang bisa diakses lewat aplikasi mobile.',
      'link' => 'grab.com'
    ]);

    Partner::create([
      'title' => 'Gojek',
      'thumbnail' => 'gojek.png',
      'content' => 'Gojek merupakan sebuah perusahaan teknologi asal Indonesia yang melayani angkutan melalui jasa ojek. Perusahaan ini didirikan pada tahun 2009 di Jakarta oleh Nadiem Makarim. Saat ini, Gojek telah tersedia di 50 kota di Indonesia.',
      'link' => 'gojek.com'
    ]);

    // Partner::create([
    //   'title' => 'X',
    //   'thumbnail' => 'x4.png',
    //   'content' => 'X atau Twitter, Inc. adalah sebuah perusahaan media sosial Amerika yang berbasis di San Francisco, California. Perusahaan ini mengoperasikan layanan jejaring sosial Twitter dan sebelumnya aplikasi video pendek Vine dan layanan streaming langsung Periscope.',
    //   'link' => 'x.com'
    // ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('partners');
  }
};
