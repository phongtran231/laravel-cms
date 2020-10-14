<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    \App\Models\User::create([
      'user_name' => 'phongtran',
      'name' => 'admin',
      'email' => 'phongtran@gmail.com',
      'password' => bcrypt('admin@123'),
    ]);

    \App\Models\CoreConfig::insert([
      [
        'name' => 'lang_number',
        'value' => 2,
      ],
      [
        'name' => 'default_lang',
        'value' => 'vn',
      ]
    ]);


  }
}
