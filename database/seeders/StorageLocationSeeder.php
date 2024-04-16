<?php

namespace Database\Seeders;

use App\Models\StorageLocation;
use App\Models\StorageSite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StorageLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = StorageSite::get();

        foreach ($stores as $store)
        {
            StorageLocation::create([
                'name' => 'room-1',
                'sub_location_name' => 'room-1',
                'storage_site_id' => $store->id,
                'description' => 'default',
                'created_by' => 1,
                'flag' => 'default',
            ]);
        }
    }
}
