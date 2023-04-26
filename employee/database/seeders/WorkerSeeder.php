<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkerSeeder extends Seeder
{
    public function run()
    {
        $worker = [
            'password' => bcrypt('12345678'),
            'worker_name' => 'Admin',
            'sex' => '男',
            'age' => '20',
            'address' => '東京都XXX市XX町',
            'department' => '営業部',
            'division' => '営業第一課',
            'hire_date' => '2023/01/01',
        ];
        DB::table('workers')->insert($worker);
    }
}
