<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'key' => 'billing_footer',
            'value' => 'Created with  by TimD - Tim Digital'

        ]);

        Setting::create([
            'key' => 'billing_footer1',
            'value'=> 'Laravel'
        ]);

        Setting::create([
            'store_id' => 1,
            'key' => 'purchase_tnc',
            'value'=> 'purchase terms and condition contents'
        ]);

        Setting::create([
            'store_id' => 1,
            'key' => 'sale_tnc',
            'value'=> 'sale terms and condition contents'
        ]);

        Setting::create([
            'store_id' => 2,
            'key' => 'purchase_tnc',
            'value'=> 'purchase terms and condition contents'
        ]);

        Setting::create([
            'store_id' => 2,
            'key' => 'sale_tnc',
            'value'=> 'sale terms and condition contents'
        ]);

    }
}
