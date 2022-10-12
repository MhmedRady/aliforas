<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::query()->insert([
            [
                'name' => "Arabic",
                'locale' => "ar",
                'currency' => ".",
            ], [
                'name' => "English",
                'locale' => "en",
                'currency' => ".",
            ]
        ]);
    }
}
