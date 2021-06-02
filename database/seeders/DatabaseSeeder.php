<?php

namespace Database\Seeders;

use App\Models\PostStatus;
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
       PostStatus::create(['name' => 'publicado']);
       PostStatus::create(['name' => 'inactivo']);
       PostStatus::create(['name' => 'borrador']);
    }
}
