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
            'name' => 'admin',
            'email' => 'phongtran.nvl@gmail.com',
            'password' => bcrypt('admin@123'),
        ]);

        \Spatie\Permission\Models\Role::create([
            'name' => 'Super admin',
        ]);

        $user = \App\Models\User::where('name', 'admin')->first();
        $user->assignRole('Super admin');

        \App\Models\MainCategory::insert([
            'title' => 'main test'
        ]);

        \App\Models\SubCategory::insert([
            'title' => 'sub test',
            'main_category_id' => 1,
        ]);

        \App\Models\Post::insert([
            [
                'title' => 'post test',
                'main_category_id' => 1,
            ]
        ]);

        \App\Models\Post::insert([
            [
                'title' => 'post test',
                'sub_category_id' => 1,
            ]
        ]);
    }
}
