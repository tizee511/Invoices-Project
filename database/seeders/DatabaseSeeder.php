<?php

namespace Database\Seeders;

use Database\Seeders\PermissionTableSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    // use WithoutModelEvents;
    public function run(): void
    {
        // 🚀 استدعاء ملفات Seeder الأخرى بالترتيب
        $this->call([
            UserSeeder::class,
            PermissionTableSeeder::class,
        ]);
    }
}
