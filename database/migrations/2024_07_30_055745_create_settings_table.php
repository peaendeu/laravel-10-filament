<?php

use App\Models\Setting;
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
    Schema::create('settings', function (Blueprint $table) {
      $table->id();
      $table->string('key');
      $table->string('label');
      $table->string('value')->nullable();
      $table->string('type');
      $table->timestamps();
    });

    Setting::create([
      'key' => '_site_name',
      'label' => 'Judul Situs',
      'value' => 'Situs Sederhana',
      'type' => 'Situs yang dibuat untuk mempermudah pengguna.',
    ]);

    Setting::create([
      'key' => '_location',
      'label' => 'Alamat Kantor',
      'value' => 'Sukabumi, Jawa Barat, Indonesia',
      'type' => 'Alamat kantor situs kami.',
    ]);

    Setting::create([
      'key' => '_youtube',
      'label' => 'Alamat Youtube',
      'value' => 'https://youtube.com/ictummi',
      'type' => 'Alamat Youtube kami.',
    ]);

    Setting::create([
      'key' => '_instagram',
      'label' => 'Alamat Instagram',
      'value' => 'https://instagram.com/ictummi',
      'type' => 'Alamat Instagram kami.',
    ]);

    Setting::create([
      'key' => '_twitter',
      'label' => 'Alamat Twitter',
      'value' => 'https://twitter.com/ictummi',
      'type' => 'Alamat Twitter kami.',
    ]);

    Setting::create([
      'key' => '_facebook',
      'label' => 'Alamat Facebook',
      'value' => 'https://facebook.com/ictummi',
      'type' => 'Alamat Facebook kami.',
    ]);

    Setting::create([
      'key' => '_site_description',
      'label' => 'Deskripsi Situs',
      'value' => 'https://facebook.com/ictummi',
      'type' => 'Situs web yang dirancang untuk mempermudah para pengguna.',
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('settings');
  }
};
