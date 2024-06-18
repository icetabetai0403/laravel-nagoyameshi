<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Auth\Database\Permission;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 管理者ユーザーを作成
        Administrator::truncate();
        Administrator::create([
            'username' => 'admin',
            'email' => 'admin@example.com', // メールアドレスを設定
            'password' => bcrypt('password'),
            'name' => 'Administrator',
        ]);

        // 管理者ロールを作成
        Role::truncate();
        Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);

        // 管理者権限を作成
        Permission::truncate();
        Permission::insert([
            [
                'name' => 'All permission', 
                'slug' => '*',
                'http_path' => '*'
            ],
            [
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'http_path' => '/'
            ]
        ]);

        // 管理者ロールに権限を割り当て
        $adminRole = Role::first();
        $permissions = Permission::all();
        $adminRole->permissions()->saveMany($permissions);

        // 管理者ユーザーにロールを割り当て
        $adminUser = Administrator::first();
        $adminUser->roles()->save($adminRole);
    }
}
