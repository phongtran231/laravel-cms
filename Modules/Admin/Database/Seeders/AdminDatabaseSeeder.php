<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Admin;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Admin::create([
          'user_name' => 'phongtran',
          'email' => 'phongtran.nvl@gmail.com',
          'password' => bcrypt(123),
        ]);

        \Spatie\Permission\Models\Role::create([
          'guard_name' => 'admin',
          'name' => 'Super admin',
        ]);

        /** @var Admin $admin */
        $admin = Admin::where('user_name', 'phongtran')->first();
        $admin->assignRole('Super admin');
    }
}
