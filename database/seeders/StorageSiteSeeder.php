<?php

namespace Database\Seeders;

use App\Models\StorageSite;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StorageSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = Store::all();

        foreach ($stores as $i=> $store) {
            StorageSite::create([
                'store_id'=> $store->id,
                'name'=>'storage_site default',
                'address'=>$store->address,
                'pincode'=>'700058',
                'description'=>'default',
                'created_by'=>1,
                'flag' => 'default',

            ]);
        }
    }
}
