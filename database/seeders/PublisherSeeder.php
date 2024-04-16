<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publisher;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $publisher = array(
            [
                'store_name' => 'FOLK AND TRIBAL CULTURAL CENTRE',
                // 'type' => 'publisher',
                'address' => 'Lokogram Chittkalikapur, Nitai Nagar',
                'state_id' => 'West Bengal',
                'district_id' => '713',
                'pin_code' => '700099',
                'logo_image' => 'upload/publisher/FTCC_Logo.jpg',
                'mercid' => 'ICADWB',
            ],
            [
                'store_name' => 'SHISHU KISHORE AKADEMI',
                // 'type' => 'publisher',
                'address' => 'Rabindra Sadan, 2nd Floor, Gerasim Lebedev Sarani',
                'state_id' => 'West Bengal',
                'district_id' => '713',
                'pin_code' => '700071',
                'logo_image' => 'upload/publisher/Sisukishor_Akademi_logo.jpg',
                'mercid' => 'ICADWB1',
            ],
            [
                'store_name' => 'BASUMATI CORPORATION LIMITED',
                // 'type' => 'publisher',
                'address' => '166, BB Ganguly Street',
                'state_id' => 'West Bengal',
                'district_id' => '713',
                'pin_code' => '700012',
                'logo_image' => 'upload/publisher/Basumati_Logo.jpg',
                'mercid' => 'ICADWB2',
            ],
            [
                'store_name' => 'PASCHIMBANGA BANGLA AKADEMY',
                // 'type' => 'publisher',
                'address' => '1/1, A J C Bose Road, Lala Lajpat Rai Sarani, Lala Lajpat Rai Sarani',
                'state_id' => 'West Bengal',
                'district_id' => '713',
                'pin_code' => '700020',
                'logo_image' => 'upload/publisher/PASCHIMBANGA_BANGLA_AKADEMY.png',
                'mercid' => 'ICADWB3',
            ],
            );
            foreach ($publisher as $pub)
            {
                Publisher::create($pub);
            }
    }
}
