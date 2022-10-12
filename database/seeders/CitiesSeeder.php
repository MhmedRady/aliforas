<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
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
            collect([
                [
                    'state_id' => '1',
                    'ar' => ['name' => '15 مايو'],
                    'en' => ['name' => '15 May']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الازبكية'],
                    'en' => ['name' => 'Al Azbakeyah']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'البساتين'],
                    'en' => ['name' => 'Al Basatin']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'التبين'],
                    'en' => ['name' => 'Tebin']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الخليفة'],
                    'en' => ['name' => 'El-Khalifa']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الدراسة'],
                    'en' => ['name' => 'El darrasa']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الدرب الاحمر'],
                    'en' => ['name' => 'Aldarb Alahmar']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الزاوية الحمراء'],
                    'en' => ['name' => 'Zawya al-Hamra']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الزيتون'],
                    'en' => ['name' => 'El-Zaytoun']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الساحل'],
                    'en' => ['name' => 'Sahel']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'السلام'],
                    'en' => ['name' => 'El Salam']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'السيدة زينب'],
                    'en' => ['name' => 'Sayeda Zeinab']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الشرابية'],
                    'en' => ['name' => 'El Sharabeya']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'مدينة الشروق'],
                    'en' => ['name' => 'Shorouk']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الظاهر'],
                    'en' => ['name' => 'El Daher']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'العتبة'],
                    'en' => ['name' => 'Ataba']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'القاهرة الجديدة'],
                    'en' => ['name' => 'New Cairo']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'المرج'],
                    'en' => ['name' => 'El Marg']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'عزبة النخل'],
                    'en' => ['name' => 'Ezbet el Nakhl']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'المطرية'],
                    'en' => ['name' => 'Matareya']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'المعادى'],
                    'en' => ['name' => 'Maadi']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'المعصرة'],
                    'en' => ['name' => 'Maasara']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'المقطم'],
                    'en' => ['name' => 'Mokattam']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'المنيل'],
                    'en' => ['name' => 'Manyal']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الموسكى'],
                    'en' => ['name' => 'Mosky']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'النزهة'],
                    'en' => ['name' => 'Nozha']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الوايلى'],
                    'en' => ['name' => 'Waily']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'باب الشعرية'],
                    'en' => ['name' => 'Bab al-Shereia']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'بولاق'],
                    'en' => ['name' => 'Bolaq']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'جاردن سيتى'],
                    'en' => ['name' => 'Garden City']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'حدائق القبة'],
                    'en' => ['name' => 'Hadayek El-Kobba']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'حلوان'],
                    'en' => ['name' => 'Helwan']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'دار السلام'],
                    'en' => ['name' => 'Dar Al Salam']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'شبرا'],
                    'en' => ['name' => 'Shubra']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'طره'],
                    'en' => ['name' => 'Tura']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'عابدين'],
                    'en' => ['name' => 'Abdeen']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'عباسية'],
                    'en' => ['name' => 'Abaseya']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'عين شمس'],
                    'en' => ['name' => 'Ain Shams']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'مدينة نصر'],
                    'en' => ['name' => 'Nasr City']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'مصر الجديدة'],
                    'en' => ['name' => 'New Heliopolis']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'مصر القديمة'],
                    'en' => ['name' => 'Masr Al Qadima']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'منشية ناصر'],
                    'en' => ['name' => 'Mansheya Nasir']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'مدينة بدر'],
                    'en' => ['name' => 'Badr City']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'مدينة العبور'],
                    'en' => ['name' => 'Obour City']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'وسط البلد'],
                    'en' => ['name' => 'Cairo Downtown']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الزمالك'],
                    'en' => ['name' => 'Zamalek']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'قصر النيل'],
                    'en' => ['name' => 'Kasr El Nile']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الرحاب'],
                    'en' => ['name' => 'Rehab']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'القطامية'],
                    'en' => ['name' => 'Katameya']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'مدينتي'],
                    'en' => ['name' => 'Madinty']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'روض الفرج'],
                    'en' => ['name' => 'Rod Alfarag']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'شيراتون'],
                    'en' => ['name' => 'Sheraton']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الجمالية'],
                    'en' => ['name' => 'El-Gamaleya']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'العاشر من رمضان'],
                    'en' => ['name' => '10th of Ramadan City']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'الحلمية'],
                    'en' => ['name' => 'Helmeyat Alzaytoun']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'النزهة الجديدة'],
                    'en' => ['name' => 'New Nozha']
                ],
                [
                    'state_id' => '1',
                    'ar' => ['name' => 'العاصمة الإدارية'],
                    'en' => ['name' => 'Capital New']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'الجيزة'],
                    'en' => ['name' => 'Giza']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'السادس من أكتوبر'],
                    'en' => ['name' => 'Sixth of October']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'الشيخ زايد'],
                    'en' => ['name' => 'Cheikh Zayed']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'الحوامدية'],
                    'en' => ['name' => 'Hawamdiyah']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'البدرشين'],
                    'en' => ['name' => 'Al Badrasheen']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'الصف'],
                    'en' => ['name' => 'Saf']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'أطفيح'],
                    'en' => ['name' => 'Atfih']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'العياط'],
                    'en' => ['name' => 'Al Ayat']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'الباويطي'],
                    'en' => ['name' => 'Al-Bawaiti']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'منشأة القناطر'],
                    'en' => ['name' => 'ManshiyetAl Qanater']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'أوسيم'],
                    'en' => ['name' => 'Oaseem']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'كرداسة'],
                    'en' => ['name' => 'Kerdasa']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'أبو النمرس'],
                    'en' => ['name' => 'Abu Nomros']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'كفر غطاطي'],
                    'en' => ['name' => 'Kafr Ghati']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'منشأة البكاري'],
                    'en' => ['name' => 'Manshiyet Al Bakari']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'الدقى'],
                    'en' => ['name' => 'Dokki']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'العجوزة'],
                    'en' => ['name' => 'Agouza']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'الهرم'],
                    'en' => ['name' => 'Haram']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'الوراق'],
                    'en' => ['name' => 'Warraq']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'امبابة'],
                    'en' => ['name' => 'Imbaba']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'بولاق الدكرور'],
                    'en' => ['name' => 'Boulaq Dakrour']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'الواحات البحرية'],
                    'en' => ['name' => 'Al Wahat Al Baharia']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'العمرانية'],
                    'en' => ['name' => 'Omraneya']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'المنيب'],
                    'en' => ['name' => 'Moneeb']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'بين السرايات'],
                    'en' => ['name' => 'Bin Alsarayat']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'الكيت كات'],
                    'en' => ['name' => 'Kit Kat']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'المهندسين'],
                    'en' => ['name' => 'Mohandessin']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'فيصل'],
                    'en' => ['name' => 'Faisal']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'أبو رواش'],
                    'en' => ['name' => 'Abu Rawash']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'حدائق الأهرام'],
                    'en' => ['name' => 'Hadayek Alahram']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'الحرانية'],
                    'en' => ['name' => 'Haraneya']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'حدائق اكتوبر'],
                    'en' => ['name' => 'Hadayek October']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'صفط اللبن'],
                    'en' => ['name' => 'Saft Allaban']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'القرية الذكية'],
                    'en' => ['name' => 'Smart Village']
                ],
                [
                    'state_id' => '2',
                    'ar' => ['name' => 'ارض اللواء'],
                    'en' => ['name' => 'Ard Ellwaa']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'ابو قير'],
                    'en' => ['name' => 'Abu Qir']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'الابراهيمية'],
                    'en' => ['name' => 'Al Ibrahimeyah']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'الأزاريطة'],
                    'en' => ['name' => 'Azarita']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'الانفوشى'],
                    'en' => ['name' => 'Anfoushi']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'الدخيلة'],
                    'en' => ['name' => 'Dekheila']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'السيوف'],
                    'en' => ['name' => 'El Soyof']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'العامرية'],
                    'en' => ['name' => 'Ameria']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'اللبان'],
                    'en' => ['name' => 'El Labban']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'المفروزة'],
                    'en' => ['name' => 'Al Mafrouza']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'المنتزه'],
                    'en' => ['name' => 'El Montaza']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'المنشية'],
                    'en' => ['name' => 'Mansheya']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'الناصرية'],
                    'en' => ['name' => 'Naseria']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'امبروزو'],
                    'en' => ['name' => 'Ambrozo']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'باب شرق'],
                    'en' => ['name' => 'Bab Sharq']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'برج العرب'],
                    'en' => ['name' => 'Bourj Alarab']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'ستانلى'],
                    'en' => ['name' => 'Stanley']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'سموحة'],
                    'en' => ['name' => 'Smouha']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'سيدى بشر'],
                    'en' => ['name' => 'Sidi Bishr']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'شدس'],
                    'en' => ['name' => 'Shads']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'غيط العنب'],
                    'en' => ['name' => 'Gheet Alenab']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'فلمينج'],
                    'en' => ['name' => 'Fleming']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'فيكتوريا'],
                    'en' => ['name' => 'Victoria']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'كامب شيزار'],
                    'en' => ['name' => 'Camp Shizar']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'كرموز'],
                    'en' => ['name' => 'Karmooz']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'محطة الرمل'],
                    'en' => ['name' => 'Mahta Alraml']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'مينا البصل'],
                    'en' => ['name' => 'Mina El-Basal']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'العصافرة'],
                    'en' => ['name' => 'Asafra']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'العجمي'],
                    'en' => ['name' => 'Agamy']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'بكوس'],
                    'en' => ['name' => 'Bakos']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'بولكلي'],
                    'en' => ['name' => 'Boulkly']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'كليوباترا'],
                    'en' => ['name' => 'Cleopatra']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'جليم'],
                    'en' => ['name' => 'Glim']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'المعمورة'],
                    'en' => ['name' => 'Al Mamurah']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'المندرة'],
                    'en' => ['name' => 'Al Mandara']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'محرم بك'],
                    'en' => ['name' => 'Moharam Bek']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'الشاطبي'],
                    'en' => ['name' => 'Elshatby']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'سيدي جابر'],
                    'en' => ['name' => 'Sidi Gaber']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'الساحل الشمالي'],
                    'en' => ['name' => 'North Coast\/sahel']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'الحضرة'],
                    'en' => ['name' => 'Alhadra']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'العطارين'],
                    'en' => ['name' => 'Alattarin']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'سيدي كرير'],
                    'en' => ['name' => 'Sidi Kerir']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'الجمرك'],
                    'en' => ['name' => 'Elgomrok']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'المكس'],
                    'en' => ['name' => 'Al Max']
                ],
                [
                    'state_id' => '3',
                    'ar' => ['name' => 'مارينا'],
                    'en' => ['name' => 'Marina']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'المنصورة'],
                    'en' => ['name' => 'Mansoura']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'طلخا'],
                    'en' => ['name' => 'Talkha']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'ميت غمر'],
                    'en' => ['name' => 'Mitt Ghamr']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'دكرنس'],
                    'en' => ['name' => 'Dekernes']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'أجا'],
                    'en' => ['name' => 'Aga']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'منية النصر'],
                    'en' => ['name' => 'Menia El Nasr']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'السنبلاوين'],
                    'en' => ['name' => 'Sinbillawin']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'الكردي'],
                    'en' => ['name' => 'El Kurdi']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'بني عبيد'],
                    'en' => ['name' => 'Bani Ubaid']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'المنزلة'],
                    'en' => ['name' => 'Al Manzala']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'تمي الأمديد'],
                    'en' => ['name' => 'tami al\'amdid']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'الجمالية'],
                    'en' => ['name' => 'aljamalia']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'شربين'],
                    'en' => ['name' => 'Sherbin']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'المطرية'],
                    'en' => ['name' => 'Mataria']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'بلقاس'],
                    'en' => ['name' => 'Belqas']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'ميت سلسيل'],
                    'en' => ['name' => 'Meet Salsil']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'جمصة'],
                    'en' => ['name' => 'Gamasa']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'محلة دمنة'],
                    'en' => ['name' => 'Mahalat Damana']
                ],
                [
                    'state_id' => '4',
                    'ar' => ['name' => 'نبروه'],
                    'en' => ['name' => 'Nabroh']
                ],
                [
                    'state_id' => '5',
                    'ar' => ['name' => 'الغردقة'],
                    'en' => ['name' => 'Hurghada']
                ],
                [
                    'state_id' => '5',
                    'ar' => ['name' => 'رأس غارب'],
                    'en' => ['name' => 'Ras Ghareb']
                ],
                [
                    'state_id' => '5',
                    'ar' => ['name' => 'سفاجا'],
                    'en' => ['name' => 'Safaga']
                ],
                [
                    'state_id' => '5',
                    'ar' => ['name' => 'القصير'],
                    'en' => ['name' => 'El Qusiar']
                ],
                [
                    'state_id' => '5',
                    'ar' => ['name' => 'مرسى علم'],
                    'en' => ['name' => 'Marsa Alam']
                ],
                [
                    'state_id' => '5',
                    'ar' => ['name' => 'الشلاتين'],
                    'en' => ['name' => 'Shalatin']
                ],
                [
                    'state_id' => '5',
                    'ar' => ['name' => 'حلايب'],
                    'en' => ['name' => 'Halaib']
                ],
                [
                    'state_id' => '5',
                    'ar' => ['name' => 'الدهار'],
                    'en' => ['name' => 'Aldahar']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'دمنهور'],
                    'en' => ['name' => 'Damanhour']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'كفر الدوار'],
                    'en' => ['name' => 'Kafr El Dawar']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'رشيد'],
                    'en' => ['name' => 'Rashid']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'إدكو'],
                    'en' => ['name' => 'Edco']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'أبو المطامير'],
                    'en' => ['name' => 'Abu al-Matamir']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'أبو حمص'],
                    'en' => ['name' => 'Abu Homs']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'الدلنجات'],
                    'en' => ['name' => 'Delengat']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'المحمودية'],
                    'en' => ['name' => 'Mahmoudiyah']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'الرحمانية'],
                    'en' => ['name' => 'Rahmaniyah']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'إيتاي البارود'],
                    'en' => ['name' => 'Itai Baroud']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'حوش عيسى'],
                    'en' => ['name' => 'Housh Eissa']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'شبراخيت'],
                    'en' => ['name' => 'Shubrakhit']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'كوم حمادة'],
                    'en' => ['name' => 'Kom Hamada']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'بدر'],
                    'en' => ['name' => 'Badr']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'وادي النطرون'],
                    'en' => ['name' => 'Wadi Natrun']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'النوبارية الجديدة'],
                    'en' => ['name' => 'New Nubaria']
                ],
                [
                    'state_id' => '6',
                    'ar' => ['name' => 'النوبارية'],
                    'en' => ['name' => 'Alnoubareya']
                ],
                [
                    'state_id' => '7',
                    'ar' => ['name' => 'الفيوم'],
                    'en' => ['name' => 'Fayoum']
                ],
                [
                    'state_id' => '7',
                    'ar' => ['name' => 'الفيوم الجديدة'],
                    'en' => ['name' => 'Fayoum El Gedida']
                ],
                [
                    'state_id' => '7',
                    'ar' => ['name' => 'طامية'],
                    'en' => ['name' => 'Tamiya']
                ],
                [
                    'state_id' => '7',
                    'ar' => ['name' => 'سنورس'],
                    'en' => ['name' => 'Snores']
                ],
                [
                    'state_id' => '7',
                    'ar' => ['name' => 'إطسا'],
                    'en' => ['name' => 'Etsa']
                ],
                [
                    'state_id' => '7',
                    'ar' => ['name' => 'إبشواي'],
                    'en' => ['name' => 'Epschway']
                ],
                [
                    'state_id' => '7',
                    'ar' => ['name' => 'يوسف الصديق'],
                    'en' => ['name' => 'Yusuf El Sediaq']
                ],
                [
                    'state_id' => '7',
                    'ar' => ['name' => 'الحادقة'],
                    'en' => ['name' => 'Hadqa']
                ],
                [
                    'state_id' => '7',
                    'ar' => ['name' => 'اطسا'],
                    'en' => ['name' => 'Atsa']
                ],
                [
                    'state_id' => '7',
                    'ar' => ['name' => 'الجامعة'],
                    'en' => ['name' => 'Algamaa']
                ],
                [
                    'state_id' => '7',
                    'ar' => ['name' => 'السيالة'],
                    'en' => ['name' => 'Sayala']
                ],
                [
                    'state_id' => '8',
                    'ar' => ['name' => 'طنطا'],
                    'en' => ['name' => 'Tanta']
                ],
                [
                    'state_id' => '8',
                    'ar' => ['name' => 'المحلة الكبرى'],
                    'en' => ['name' => 'Al Mahalla Al Kobra']
                ],
                [
                    'state_id' => '8',
                    'ar' => ['name' => 'كفر الزيات'],
                    'en' => ['name' => 'Kafr El Zayat']
                ],
                [
                    'state_id' => '8',
                    'ar' => ['name' => 'زفتى'],
                    'en' => ['name' => 'Zefta']
                ],
                [
                    'state_id' => '8',
                    'ar' => ['name' => 'السنطة'],
                    'en' => ['name' => 'El Santa']
                ],
                [
                    'state_id' => '8',
                    'ar' => ['name' => 'قطور'],
                    'en' => ['name' => 'Qutour']
                ],
                [
                    'state_id' => '8',
                    'ar' => ['name' => 'بسيون'],
                    'en' => ['name' => 'Basion']
                ],
                [
                    'state_id' => '8',
                    'ar' => ['name' => 'سمنود'],
                    'en' => ['name' => 'Samannoud']
                ],
                [
                    'state_id' => '9',
                    'ar' => ['name' => 'الإسماعيلية'],
                    'en' => ['name' => 'Ismailia']
                ],
                [
                    'state_id' => '9',
                    'ar' => ['name' => 'فايد'],
                    'en' => ['name' => 'Fayed']
                ],
                [
                    'state_id' => '9',
                    'ar' => ['name' => 'القنطرة شرق'],
                    'en' => ['name' => 'Qantara Sharq']
                ],
                [
                    'state_id' => '9',
                    'ar' => ['name' => 'القنطرة غرب'],
                    'en' => ['name' => 'Qantara Gharb']
                ],
                [
                    'state_id' => '9',
                    'ar' => ['name' => 'التل الكبير'],
                    'en' => ['name' => 'El Tal El Kabier']
                ],
                [
                    'state_id' => '9',
                    'ar' => ['name' => 'أبو صوير'],
                    'en' => ['name' => 'Abu Sawir']
                ],
                [
                    'state_id' => '9',
                    'ar' => ['name' => 'القصاصين الجديدة'],
                    'en' => ['name' => 'Kasasien El Gedida']
                ],
                [
                    'state_id' => '9',
                    'ar' => ['name' => 'نفيشة'],
                    'en' => ['name' => 'Nefesha']
                ],
                [
                    'state_id' => '9',
                    'ar' => ['name' => 'الشيخ زايد'],
                    'en' => ['name' => 'Sheikh Zayed']
                ],
                [
                    'state_id' => '10',
                    'ar' => ['name' => 'شبين الكوم'],
                    'en' => ['name' => 'Shbeen El Koom']
                ],
                [
                    'state_id' => '10',
                    'ar' => ['name' => 'مدينة السادات'],
                    'en' => ['name' => 'Sadat City']
                ],
                [
                    'state_id' => '10',
                    'ar' => ['name' => 'منوف'],
                    'en' => ['name' => 'Menouf']
                ],
                [
                    'state_id' => '10',
                    'ar' => ['name' => 'سرس الليان'],
                    'en' => ['name' => 'Sars El-Layan']
                ],
                [
                    'state_id' => '10',
                    'ar' => ['name' => 'أشمون'],
                    'en' => ['name' => 'Ashmon']
                ],
                [
                    'state_id' => '10',
                    'ar' => ['name' => 'الباجور'],
                    'en' => ['name' => 'Al Bagor']
                ],
                [
                    'state_id' => '10',
                    'ar' => ['name' => 'قويسنا'],
                    'en' => ['name' => 'Quesna']
                ],
                [
                    'state_id' => '10',
                    'ar' => ['name' => 'بركة السبع'],
                    'en' => ['name' => 'Berkat El Saba']
                ],
                [
                    'state_id' => '10',
                    'ar' => ['name' => 'تلا'],
                    'en' => ['name' => 'Tala']
                ],
                [
                    'state_id' => '10',
                    'ar' => ['name' => 'الشهداء'],
                    'en' => ['name' => 'Al Shohada']
                ],
                [
                    'state_id' => '11',
                    'ar' => ['name' => 'المنيا'],
                    'en' => ['name' => 'Minya']
                ],
                [
                    'state_id' => '11',
                    'ar' => ['name' => 'المنيا الجديدة'],
                    'en' => ['name' => 'Minya El Gedida']
                ],
                [
                    'state_id' => '11',
                    'ar' => ['name' => 'العدوة'],
                    'en' => ['name' => 'El Adwa']
                ],
                [
                    'state_id' => '11',
                    'ar' => ['name' => 'مغاغة'],
                    'en' => ['name' => 'Magagha']
                ],
                [
                    'state_id' => '11',
                    'ar' => ['name' => 'بني مزار'],
                    'en' => ['name' => 'Bani Mazar']
                ],
                [
                    'state_id' => '11',
                    'ar' => ['name' => 'مطاي'],
                    'en' => ['name' => 'Mattay']
                ],
                [
                    'state_id' => '11',
                    'ar' => ['name' => 'سمالوط'],
                    'en' => ['name' => 'Samalut']
                ],
                [
                    'state_id' => '11',
                    'ar' => ['name' => 'المدينة الفكرية'],
                    'en' => ['name' => 'Madinat El Fekria']
                ],
                [
                    'state_id' => '11',
                    'ar' => ['name' => 'ملوي'],
                    'en' => ['name' => 'Meloy']
                ],
                [
                    'state_id' => '11',
                    'ar' => ['name' => 'دير مواس'],
                    'en' => ['name' => 'Deir Mawas']
                ],
                [
                    'state_id' => '11',
                    'ar' => ['name' => 'ابو قرقاص'],
                    'en' => ['name' => 'Abu Qurqas']
                ],
                [
                    'state_id' => '11',
                    'ar' => ['name' => 'ارض سلطان'],
                    'en' => ['name' => 'Ard Sultan']
                ],
                [
                    'state_id' => '12',
                    'ar' => ['name' => 'بنها'],
                    'en' => ['name' => 'Banha']
                ],
                [
                    'state_id' => '12',
                    'ar' => ['name' => 'قليوب'],
                    'en' => ['name' => 'Qalyub']
                ],
                [
                    'state_id' => '12',
                    'ar' => ['name' => 'شبرا الخيمة'],
                    'en' => ['name' => 'Shubra Al Khaimah']
                ],
                [
                    'state_id' => '12',
                    'ar' => ['name' => 'القناطر الخيرية'],
                    'en' => ['name' => 'Al Qanater Charity']
                ],
                [
                    'state_id' => '12',
                    'ar' => ['name' => 'الخانكة'],
                    'en' => ['name' => 'Khanka']
                ],
                [
                    'state_id' => '12',
                    'ar' => ['name' => 'كفر شكر'],
                    'en' => ['name' => 'Kafr Shukr']
                ],
                [
                    'state_id' => '12',
                    'ar' => ['name' => 'طوخ'],
                    'en' => ['name' => 'Tukh']
                ],
                [
                    'state_id' => '12',
                    'ar' => ['name' => 'قها'],
                    'en' => ['name' => 'Qaha']
                ],
                [
                    'state_id' => '12',
                    'ar' => ['name' => 'العبور'],
                    'en' => ['name' => 'Obour']
                ],
                [
                    'state_id' => '12',
                    'ar' => ['name' => 'الخصوص'],
                    'en' => ['name' => 'Khosous']
                ],
                [
                    'state_id' => '12',
                    'ar' => ['name' => 'شبين القناطر'],
                    'en' => ['name' => 'Shibin Al Qanater']
                ],
                [
                    'state_id' => '12',
                    'ar' => ['name' => 'مسطرد'],
                    'en' => ['name' => 'Mostorod']
                ],
                [
                    'state_id' => '13',
                    'ar' => ['name' => 'الخارجة'],
                    'en' => ['name' => 'El Kharga']
                ],
                [
                    'state_id' => '13',
                    'ar' => ['name' => 'باريس'],
                    'en' => ['name' => 'Paris']
                ],
                [
                    'state_id' => '13',
                    'ar' => ['name' => 'موط'],
                    'en' => ['name' => 'Mout']
                ],
                [
                    'state_id' => '13',
                    'ar' => ['name' => 'الفرافرة'],
                    'en' => ['name' => 'Farafra']
                ],
                [
                    'state_id' => '13',
                    'ar' => ['name' => 'بلاط'],
                    'en' => ['name' => 'Balat']
                ],
                [
                    'state_id' => '13',
                    'ar' => ['name' => 'الداخلة'],
                    'en' => ['name' => 'Dakhla']
                ],
                [
                    'state_id' => '14',
                    'ar' => ['name' => 'السويس'],
                    'en' => ['name' => 'Suez']
                ],
                [
                    'state_id' => '14',
                    'ar' => ['name' => 'الجناين'],
                    'en' => ['name' => 'Alganayen']
                ],
                [
                    'state_id' => '14',
                    'ar' => ['name' => 'عتاقة'],
                    'en' => ['name' => 'Ataqah']
                ],
                [
                    'state_id' => '14',
                    'ar' => ['name' => 'العين السخنة'],
                    'en' => ['name' => 'Ain Sokhna']
                ],
                [
                    'state_id' => '14',
                    'ar' => ['name' => 'فيصل'],
                    'en' => ['name' => 'Faysal']
                ],
                [
                    'state_id' => '15',
                    'ar' => ['name' => 'أسوان'],
                    'en' => ['name' => 'Aswan']
                ],
                [
                    'state_id' => '15',
                    'ar' => ['name' => 'أسوان الجديدة'],
                    'en' => ['name' => 'Aswan El Gedida']
                ],
                [
                    'state_id' => '15',
                    'ar' => ['name' => 'دراو'],
                    'en' => ['name' => 'Drau']
                ],
                [
                    'state_id' => '15',
                    'ar' => ['name' => 'كوم أمبو'],
                    'en' => ['name' => 'Kom Ombo']
                ],
                [
                    'state_id' => '15',
                    'ar' => ['name' => 'نصر النوبة'],
                    'en' => ['name' => 'Nasr Al Nuba']
                ],
                [
                    'state_id' => '15',
                    'ar' => ['name' => 'كلابشة'],
                    'en' => ['name' => 'Kalabsha']
                ],
                [
                    'state_id' => '15',
                    'ar' => ['name' => 'إدفو'],
                    'en' => ['name' => 'Edfu']
                ],
                [
                    'state_id' => '15',
                    'ar' => ['name' => 'الرديسية'],
                    'en' => ['name' => 'Al-Radisiyah']
                ],
                [
                    'state_id' => '15',
                    'ar' => ['name' => 'البصيلية'],
                    'en' => ['name' => 'Al Basilia']
                ],
                [
                    'state_id' => '15',
                    'ar' => ['name' => 'السباعية'],
                    'en' => ['name' => 'Al Sibaeia']
                ],
                [
                    'state_id' => '15',
                    'ar' => ['name' => 'ابوسمبل السياحية'],
                    'en' => ['name' => 'Abo Simbl Al Siyahia']
                ],
                [
                    'state_id' => '15',
                    'ar' => ['name' => 'مرسى علم'],
                    'en' => ['name' => 'Marsa Alam']
                ],
                [
                    'state_id' => '16',
                    'ar' => ['name' => 'أسيوط'],
                    'en' => ['name' => 'Assiut']
                ],
                [
                    'state_id' => '16',
                    'ar' => ['name' => 'أسيوط الجديدة'],
                    'en' => ['name' => 'Assiut El Gedida']
                ],
                [
                    'state_id' => '16',
                    'ar' => ['name' => 'ديروط'],
                    'en' => ['name' => 'Dayrout']
                ],
                [
                    'state_id' => '16',
                    'ar' => ['name' => 'منفلوط'],
                    'en' => ['name' => 'Manfalut']
                ],
                [
                    'state_id' => '16',
                    'ar' => ['name' => 'القوصية'],
                    'en' => ['name' => 'Qusiya']
                ],
                [
                    'state_id' => '16',
                    'ar' => ['name' => 'أبنوب'],
                    'en' => ['name' => 'Abnoub']
                ],
                [
                    'state_id' => '16',
                    'ar' => ['name' => 'أبو تيج'],
                    'en' => ['name' => 'Abu Tig']
                ],
                [
                    'state_id' => '16',
                    'ar' => ['name' => 'الغنايم'],
                    'en' => ['name' => 'El Ghanaim']
                ],
                [
                    'state_id' => '16',
                    'ar' => ['name' => 'ساحل سليم'],
                    'en' => ['name' => 'Sahel Selim']
                ],
                [
                    'state_id' => '16',
                    'ar' => ['name' => 'البداري'],
                    'en' => ['name' => 'El Badari']
                ],
                [
                    'state_id' => '16',
                    'ar' => ['name' => 'صدفا'],
                    'en' => ['name' => 'Sidfa']
                ],
                [
                    'state_id' => '17',
                    'ar' => ['name' => 'بني سويف'],
                    'en' => ['name' => 'Bani Sweif']
                ],
                [
                    'state_id' => '17',
                    'ar' => ['name' => 'بني سويف الجديدة'],
                    'en' => ['name' => 'Beni Suef El Gedida']
                ],
                [
                    'state_id' => '17',
                    'ar' => ['name' => 'الواسطى'],
                    'en' => ['name' => 'Al Wasta']
                ],
                [
                    'state_id' => '17',
                    'ar' => ['name' => 'ناصر'],
                    'en' => ['name' => 'Naser']
                ],
                [
                    'state_id' => '17',
                    'ar' => ['name' => 'إهناسيا'],
                    'en' => ['name' => 'Ehnasia']
                ],
                [
                    'state_id' => '17',
                    'ar' => ['name' => 'ببا'],
                    'en' => ['name' => 'beba']
                ],
                [
                    'state_id' => '17',
                    'ar' => ['name' => 'الفشن'],
                    'en' => ['name' => 'Fashn']
                ],
                [
                    'state_id' => '17',
                    'ar' => ['name' => 'سمسطا'],
                    'en' => ['name' => 'Somasta']
                ],
                [
                    'state_id' => '17',
                    'ar' => ['name' => 'الاباصيرى'],
                    'en' => ['name' => 'Alabbaseri']
                ],
                [
                    'state_id' => '17',
                    'ar' => ['name' => 'مقبل'],
                    'en' => ['name' => 'Mokbel']
                ],
                [
                    'state_id' => '18',
                    'ar' => ['name' => 'بورسعيد'],
                    'en' => ['name' => 'PorSaid']
                ],
                [
                    'state_id' => '18',
                    'ar' => ['name' => 'بورفؤاد'],
                    'en' => ['name' => 'Port Fouad']
                ],
                [
                    'state_id' => '18',
                    'ar' => ['name' => 'العرب'],
                    'en' => ['name' => 'Alarab']
                ],
                [
                    'state_id' => '18',
                    'ar' => ['name' => 'حى الزهور'],
                    'en' => ['name' => 'Zohour']
                ],
                [
                    'state_id' => '18',
                    'ar' => ['name' => 'حى الشرق'],
                    'en' => ['name' => 'Alsharq']
                ],
                [
                    'state_id' => '18',
                    'ar' => ['name' => 'حى الضواحى'],
                    'en' => ['name' => 'Aldawahi']
                ],
                [
                    'state_id' => '18',
                    'ar' => ['name' => 'حى المناخ'],
                    'en' => ['name' => 'Almanakh']
                ],
                [
                    'state_id' => '18',
                    'ar' => ['name' => 'حى مبارك'],
                    'en' => ['name' => 'Mubarak']
                ],
                [
                    'state_id' => '19',
                    'ar' => ['name' => 'دمياط'],
                    'en' => ['name' => 'Damietta']
                ],
                [
                    'state_id' => '19',
                    'ar' => ['name' => 'دمياط الجديدة'],
                    'en' => ['name' => 'New Damietta']
                ],
                [
                    'state_id' => '19',
                    'ar' => ['name' => 'رأس البر'],
                    'en' => ['name' => 'Ras El Bar']
                ],
                [
                    'state_id' => '19',
                    'ar' => ['name' => 'فارسكور'],
                    'en' => ['name' => 'Faraskour']
                ],
                [
                    'state_id' => '19',
                    'ar' => ['name' => 'الزرقا'],
                    'en' => ['name' => 'Zarqa']
                ],
                [
                    'state_id' => '19',
                    'ar' => ['name' => 'السرو'],
                    'en' => ['name' => 'alsaru']
                ],
                [
                    'state_id' => '19',
                    'ar' => ['name' => 'الروضة'],
                    'en' => ['name' => 'alruwda']
                ],
                [
                    'state_id' => '19',
                    'ar' => ['name' => 'كفر البطيخ'],
                    'en' => ['name' => 'Kafr El-Batikh']
                ],
                [
                    'state_id' => '19',
                    'ar' => ['name' => 'عزبة البرج'],
                    'en' => ['name' => 'Azbet Al Burg']
                ],
                [
                    'state_id' => '19',
                    'ar' => ['name' => 'ميت أبو غالب'],
                    'en' => ['name' => 'Meet Abou Ghalib']
                ],
                [
                    'state_id' => '19',
                    'ar' => ['name' => 'كفر سعد'],
                    'en' => ['name' => 'Kafr Saad']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'الزقازيق'],
                    'en' => ['name' => 'Zagazig']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'العاشر من رمضان'],
                    'en' => ['name' => 'Al Ashr Men Ramadan']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'منيا القمح'],
                    'en' => ['name' => 'Minya Al Qamh']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'بلبيس'],
                    'en' => ['name' => 'Belbeis']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'مشتول السوق'],
                    'en' => ['name' => 'Mashtoul El Souq']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'القنايات'],
                    'en' => ['name' => 'Qenaiat']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'أبو حماد'],
                    'en' => ['name' => 'Abu Hammad']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'القرين'],
                    'en' => ['name' => 'El Qurain']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'ههيا'],
                    'en' => ['name' => 'Hehia']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'أبو كبير'],
                    'en' => ['name' => 'Abu Kabir']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'فاقوس'],
                    'en' => ['name' => 'Faccus']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'الصالحية الجديدة'],
                    'en' => ['name' => 'El Salihia El Gedida']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'الإبراهيمية'],
                    'en' => ['name' => 'Al Ibrahimiyah']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'ديرب نجم'],
                    'en' => ['name' => 'Deirb Negm']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'كفر صقر'],
                    'en' => ['name' => 'Kafr Saqr']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'أولاد صقر'],
                    'en' => ['name' => 'Awlad Saqr']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'الحسينية'],
                    'en' => ['name' => 'Husseiniya']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'صان الحجر القبلية'],
                    'en' => ['name' => 'san alhajar alqablia']
                ],
                [
                    'state_id' => '20',
                    'ar' => ['name' => 'منشأة أبو عمر'],
                    'en' => ['name' => 'Manshayat Abu Omar']
                ],
                [
                    'state_id' => '21',
                    'ar' => ['name' => 'الطور'],
                    'en' => ['name' => 'Al Toor']
                ],
                [
                    'state_id' => '21',
                    'ar' => ['name' => 'شرم الشيخ'],
                    'en' => ['name' => 'Sharm El-Shaikh']
                ],
                [
                    'state_id' => '21',
                    'ar' => ['name' => 'دهب'],
                    'en' => ['name' => 'Dahab']
                ],
                [
                    'state_id' => '21',
                    'ar' => ['name' => 'نويبع'],
                    'en' => ['name' => 'Nuweiba']
                ],
                [
                    'state_id' => '21',
                    'ar' => ['name' => 'طابا'],
                    'en' => ['name' => 'Taba']
                ],
                [
                    'state_id' => '21',
                    'ar' => ['name' => 'سانت كاترين'],
                    'en' => ['name' => 'Saint Catherine']
                ],
                [
                    'state_id' => '21',
                    'ar' => ['name' => 'أبو رديس'],
                    'en' => ['name' => 'Abu Redis']
                ],
                [
                    'state_id' => '21',
                    'ar' => ['name' => 'أبو زنيمة'],
                    'en' => ['name' => 'Abu Zenaima']
                ],
                [
                    'state_id' => '21',
                    'ar' => ['name' => 'رأس سدر'],
                    'en' => ['name' => 'Ras Sidr']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'كفر الشيخ'],
                    'en' => ['name' => 'Kafr El Sheikh']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'وسط البلد كفر الشيخ'],
                    'en' => ['name' => 'Kafr El Sheikh Downtown']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'دسوق'],
                    'en' => ['name' => 'Desouq']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'فوه'],
                    'en' => ['name' => 'Fooh']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'مطوبس'],
                    'en' => ['name' => 'Metobas']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'برج البرلس'],
                    'en' => ['name' => 'Burg Al Burullus']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'بلطيم'],
                    'en' => ['name' => 'Baltim']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'مصيف بلطيم'],
                    'en' => ['name' => 'Masief Baltim']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'الحامول'],
                    'en' => ['name' => 'Hamol']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'بيلا'],
                    'en' => ['name' => 'Bella']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'الرياض'],
                    'en' => ['name' => 'Riyadh']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'سيدي سالم'],
                    'en' => ['name' => 'Sidi Salm']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'قلين'],
                    'en' => ['name' => 'Qellen']
                ],
                [
                    'state_id' => '22',
                    'ar' => ['name' => 'سيدي غازي'],
                    'en' => ['name' => 'Sidi Ghazi']
                ],
                [
                    'state_id' => '23',
                    'ar' => ['name' => 'مرسى مطروح'],
                    'en' => ['name' => 'Marsa Matrouh']
                ],
                [
                    'state_id' => '23',
                    'ar' => ['name' => 'الحمام'],
                    'en' => ['name' => 'El Hamam']
                ],
                [
                    'state_id' => '23',
                    'ar' => ['name' => 'العلمين'],
                    'en' => ['name' => 'Alamein']
                ],
                [
                    'state_id' => '23',
                    'ar' => ['name' => 'الضبعة'],
                    'en' => ['name' => 'Dabaa']
                ],
                [
                    'state_id' => '23',
                    'ar' => ['name' => 'النجيلة'],
                    'en' => ['name' => 'Al-Nagila']
                ],
                [
                    'state_id' => '23',
                    'ar' => ['name' => 'سيدي براني'],
                    'en' => ['name' => 'Sidi Brani']
                ],
                [
                    'state_id' => '23',
                    'ar' => ['name' => 'السلوم'],
                    'en' => ['name' => 'Salloum']
                ],
                [
                    'state_id' => '23',
                    'ar' => ['name' => 'سيوة'],
                    'en' => ['name' => 'Siwa']
                ],
                [
                    'state_id' => '23',
                    'ar' => ['name' => 'مارينا'],
                    'en' => ['name' => 'Marina']
                ],
                [
                    'state_id' => '23',
                    'ar' => ['name' => 'الساحل الشمالى'],
                    'en' => ['name' => 'North Coast']
                ],
                [
                    'state_id' => '24',
                    'ar' => ['name' => 'الأقصر'],
                    'en' => ['name' => 'Luxor']
                ],
                [
                    'state_id' => '24',
                    'ar' => ['name' => 'الأقصر الجديدة'],
                    'en' => ['name' => 'New Luxor']
                ],
                [
                    'state_id' => '24',
                    'ar' => ['name' => 'إسنا'],
                    'en' => ['name' => 'Esna']
                ],
                [
                    'state_id' => '24',
                    'ar' => ['name' => 'طيبة الجديدة'],
                    'en' => ['name' => 'New Tiba']
                ],
                [
                    'state_id' => '24',
                    'ar' => ['name' => 'الزينية'],
                    'en' => ['name' => 'Al ziynia']
                ],
                [
                    'state_id' => '24',
                    'ar' => ['name' => 'البياضية'],
                    'en' => ['name' => 'Al Bayadieh']
                ],
                [
                    'state_id' => '24',
                    'ar' => ['name' => 'القرنة'],
                    'en' => ['name' => 'Al Qarna']
                ],
                [
                    'state_id' => '24',
                    'ar' => ['name' => 'أرمنت'],
                    'en' => ['name' => 'Armant']
                ],
                [
                    'state_id' => '24',
                    'ar' => ['name' => 'الطود'],
                    'en' => ['name' => 'Al Tud']
                ],
                [
                    'state_id' => '25',
                    'ar' => ['name' => 'قنا'],
                    'en' => ['name' => 'Qena']
                ],
                [
                    'state_id' => '25',
                    'ar' => ['name' => 'قنا الجديدة'],
                    'en' => ['name' => 'New Qena']
                ],
                [
                    'state_id' => '25',
                    'ar' => ['name' => 'ابو طشت'],
                    'en' => ['name' => 'Abu Tesht']
                ],
                [
                    'state_id' => '25',
                    'ar' => ['name' => 'نجع حمادي'],
                    'en' => ['name' => 'Nag Hammadi']
                ],
                [
                    'state_id' => '25',
                    'ar' => ['name' => 'دشنا'],
                    'en' => ['name' => 'Deshna']
                ],
                [
                    'state_id' => '25',
                    'ar' => ['name' => 'الوقف'],
                    'en' => ['name' => 'Alwaqf']
                ],
                [
                    'state_id' => '25',
                    'ar' => ['name' => 'قفط'],
                    'en' => ['name' => 'Qaft']
                ],
                [
                    'state_id' => '25',
                    'ar' => ['name' => 'نقادة'],
                    'en' => ['name' => 'Naqada']
                ],
                [
                    'state_id' => '25',
                    'ar' => ['name' => 'فرشوط'],
                    'en' => ['name' => 'Farshout']
                ],
                [
                    'state_id' => '25',
                    'ar' => ['name' => 'قوص'],
                    'en' => ['name' => 'Quos']
                ],
                [
                    'state_id' => '26',
                    'ar' => ['name' => 'العريش'],
                    'en' => ['name' => 'Arish']
                ],
                [
                    'state_id' => '26',
                    'ar' => ['name' => 'الشيخ زويد'],
                    'en' => ['name' => 'Sheikh Zowaid']
                ],
                [
                    'state_id' => '26',
                    'ar' => ['name' => 'نخل'],
                    'en' => ['name' => 'Nakhl']
                ],
                [
                    'state_id' => '26',
                    'ar' => ['name' => 'رفح'],
                    'en' => ['name' => 'Rafah']
                ],
                [
                    'state_id' => '26',
                    'ar' => ['name' => 'بئر العبد'],
                    'en' => ['name' => 'Bir al-Abed']
                ],
                [
                    'state_id' => '26',
                    'ar' => ['name' => 'الحسنة'],
                    'en' => ['name' => 'Al Hasana']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'سوهاج'],
                    'en' => ['name' => 'Sohag']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'سوهاج الجديدة'],
                    'en' => ['name' => 'Sohag El Gedida']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'أخميم'],
                    'en' => ['name' => 'Akhmeem']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'أخميم الجديدة'],
                    'en' => ['name' => 'Akhmim El Gedida']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'البلينا'],
                    'en' => ['name' => 'Albalina']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'المراغة'],
                    'en' => ['name' => 'El Maragha']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'المنشأة'],
                    'en' => ['name' => 'almunsha\'a']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'دار السلام'],
                    'en' => ['name' => 'Dar AISalaam']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'جرجا'],
                    'en' => ['name' => 'Gerga']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'جهينة الغربية'],
                    'en' => ['name' => 'Jahina Al Gharbia']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'ساقلته'],
                    'en' => ['name' => 'Saqilatuh']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'طما'],
                    'en' => ['name' => 'Tama']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'طهطا'],
                    'en' => ['name' => 'Tahta']
                ],
                [
                    'state_id' => '27',
                    'ar' => ['name' => 'الكوثر'],
                    'en' => ['name' => 'Alkawthar']
                ],
            ])->map(fn($data) => City::query()->create($data));
        }

    }
}
