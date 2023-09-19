<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\resttime;

class ResttimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        resttime::factory()->count(100)->create();
    }
}
