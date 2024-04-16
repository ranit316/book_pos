<?php

namespace Database\Seeders;

use App\Models\Rack;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = Store::get();
        
        foreach ($stores as $i=>$store)
        {
            Rack::create([
                'name' => 'rack-1',
                'position' => 'rack-1',
                'store_id' => $store->id,
                'storage_site_id' => $i + 1,
                'storage_location_id' => $i + 1,
                'description' => 'default',
                'created_by' => 1,
                'flag' => 'default',
        
            ]);
        }
       
    }
}
