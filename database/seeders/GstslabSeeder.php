<?php

namespace Database\Seeders;

use App\Models\GstSlab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GstslabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 5; $i <= 20;) {

            if($i==20){
                GstSlab::create([
                    'name'=>'GstSlab@'.$i,
                    'tax'=>$i,
                    'description'=>'none',
                    'created_by'=>1,
                    'is_default'=>1
                ]);

            }else{
                GstSlab::create([
                    'name'=>'GstSlab@'.$i,
                    'tax'=>$i,
                    'description'=>'none',
                    'created_by'=>1,
                    'is_default'=>0
                ]);

            }
            


            $i=$i+5;
        }
    }
}
