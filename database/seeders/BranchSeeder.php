<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $branches = [];
        $users = User::query()->where('is_seller',1)->select('id')->get();
        foreach ($users as $key => $user){
            $faker = \Faker\Factory::create();
            $branchs = [
                [
                    'address'=> '27-29 Souk Al Sabaeen, Safar, El Sayeda Zeinab, Cairo Governorate 4281061, Egypt',
//                    'lng' => $faker->randomFloat(5,30,35),
//                    'lat' => $faker->randomFloat(5,30,35),
                    'lng' => 31.2468458,
                    'lat' => 30.0387896,
                    'seller_id' => $user->id,
                    'is_active'=> true,
                    'created_at' => now()
                ],
                [
                    'address'=> '27VC+GMJ, El-Gamaleya, Manshiyat Naser, Cairo Governorate 4420110, Egypt',
                    'lng' => 31.2716785,
                    'lat' => 30.0437918,
                    'seller_id' => $user->id,
                    'is_active'=> true,
                    'created_at' => now()
                ]
            ];

            foreach ($branchs as $key => $branch):
                $branch = Branch::query()->create($branch);
                $index = $key + 1;
                $trans = [
                    ['name'=>"branch {$index}",'locale'=>'en', 'branch_id'=>$branch->id],
                    ['name'=>"الفرع {$index}", 'locale'=>'ar', 'branch_id'=>$branch->id]
                ];
                $branch->translations()->insert($trans);
            endforeach;

        }
//        for ($i=1;$i<= 10;$i++){
//            Branch::query()->insert($branches);
//        }
    }
}
