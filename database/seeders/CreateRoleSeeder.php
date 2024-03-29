<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                ['name' => 'admin', 'display_name' => 'Quản trị hệ thống'],
                ['name' => 'Nhân viên', 'display_name' => 'Quản lý sản phẩm'],
                ['name' => 'guest', 'display_name' => 'Khách hàng']
            ]
        );
    }
}
