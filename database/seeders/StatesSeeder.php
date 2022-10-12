<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Country $country */
        $country = Country::query()->where('country_code', 'EG')->first();
        if ($country) {
            $country->states()->createMany([
                [
                    'ar' => ['name' => 'القاهرة'],
                    'en' => ['name' => 'Cairo']
                ],
                [
                    'ar' => ['name' => 'الجيزة'],
                    'en' => ['name' => 'Giza']
                ],
                [
                    'ar' => ['name' => 'الأسكندرية'],
                    'en' => ['name' => 'Alexandria']
                ],
                [
                    'ar' => ['name' => 'الدقهلية'],
                    'en' => ['name' => 'Dakahlia']
                ],
                [
                    'ar' => ['name' => 'البحر الأحمر'],
                    'en' => ['name' => 'Red Sea']
                ],
                [
                    'ar' => ['name' => 'البحيرة'],
                    'en' => ['name' => 'Beheira']
                ],
                [
                    'ar' => ['name' => 'الفيوم'],
                    'en' => ['name' => 'Fayoum']
                ],
                [
                    'ar' => ['name' => 'الغربية'],
                    'en' => ['name' => 'Gharbiya']
                ],
                [
                    'ar' => ['name' => 'الإسماعلية'],
                    'en' => ['name' => 'Ismailia']
                ],
                [
                    'ar' => ['name' => 'المنوفية'],
                    'en' => ['name' => 'Menofia']
                ],
                [
                    'ar' => ['name' => 'المنيا'],
                    'en' => ['name' => 'Minya']
                ],
                [
                    'ar' => ['name' => 'القليوبية'],
                    'en' => ['name' => 'Qaliubiya']
                ],
                [
                    'ar' => ['name' => 'الوادي الجديد'],
                    'en' => ['name' => 'New Valley']
                ],
                [
                    'ar' => ['name' => 'السويس'],
                    'en' => ['name' => 'Suez']
                ],
                [
                    'ar' => ['name' => 'اسوان'],
                    'en' => ['name' => 'Aswan']
                ],
                [
                    'ar' => ['name' => 'اسيوط'],
                    'en' => ['name' => 'Assiut']
                ],
                [
                    'ar' => ['name' => 'بني سويف'],
                    'en' => ['name' => 'Beni Suef']
                ],
                [
                    'ar' => ['name' => 'بورسعيد'],
                    'en' => ['name' => 'Port Said']
                ],
                [
                    'ar' => ['name' => 'دمياط'],
                    'en' => ['name' => 'Damietta']
                ],
                [
                    'ar' => ['name' => 'الشرقية'],
                    'en' => ['name' => 'Sharkia']
                ],
                [
                    'ar' => ['name' => 'جنوب سيناء'],
                    'en' => ['name' => 'South Sinai']
                ],
                [
                    'ar' => ['name' => 'كفر الشيخ'],
                    'en' => ['name' => 'Kafr Al sheikh']
                ],
                [
                    'ar' => ['name' => 'مطروح'],
                    'en' => ['name' => 'Matrouh']
                ],
                [
                    'ar' => ['name' => 'الأقصر'],
                    'en' => ['name' => 'Luxor']
                ],
                [
                    'ar' => ['name' => 'قنا'],
                    'en' => ['name' => 'Qena']
                ],
                [
                    'ar' => ['name' => 'شمال سيناء'],
                    'en' => ['name' => 'North Sinai']
                ],
                [
                    'ar' => ['name' => 'سوهاج'],
                    'en' => ['name' => 'Sohag']
                ],
            ]);
        }
    }
}
