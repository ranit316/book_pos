<?php

namespace Database\Seeders;

use App\Models\AppInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppinfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppInfo::create([
            'title' => 'I&CA BOOK Store',
            'description' => 'I&CA BOOK Store Description',
            'version' => '2.0',
            'logo' => 'images/setting/logo-lg1.jpg',
            'dark_logo' => 'images/setting/logo-sm1.jpg',
            'fav_icon' => 'images/setting/favicon1.jpg',
            'email' => 'support@wbicabooks.com',
            'email2' => 'tech-support@wbicabooks.com',
            'live_url' => 'https://pos.wbicabooks.com/',


            'purchase_tnc' => 

            '1.Verify stock before requisition.
             2.Ensure accurate order details.
             3.Timely dispatch of approved orders.
             4.GRN for received goods verification.
             5.Use Purchase Invoice for billing.',

            'sale_tnc' =>
            
            '1.Payment due on receipt.
             2.Prices include applicable taxes.
             3.Report issues within [number] days.
             4.Ownership upon full payment.
             5.Refer to our return policy for queries.',
             'footer_left' => ' © Information & Cultural Affairs Department, Government of West Bengal.',
             'email_sign_name' => 'I&CA Books Store - By I&CA Dept, Govt. of West Benga',
        ]);
    }
}
