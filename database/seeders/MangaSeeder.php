<?php

namespace Database\Seeders;

use App\Models\Manga;
use Illuminate\Database\Seeder;

class MangaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Manga::factory(60)->create();
    }
}
