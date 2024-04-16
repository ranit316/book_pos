<?php

namespace Database\Seeders;
use App\Models\CmsPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CmsPage::create([
            'name' => 'Terms & Conditions',
            'description' => 'https://www.wbicabooks.com/terms-and-conditions/'

        ]);

        CmsPage::create([
            'name' => 'Privacy Policy',
            'description'=> 'https://www.wbicabooks.com/privacy-policy/'
        ]);

        CmsPage::create([
            'name' => 'Get Support',
            'description'=> 'https://www.wbicabooks.com/'
        ]);

        CmsPage::create([
            'name' => 'Share Feedback',
            'description'=> 'https://www.wbicabooks.com/share-feedback/'
        ]);
        
    }
}
