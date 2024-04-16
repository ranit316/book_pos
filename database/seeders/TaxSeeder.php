<?php

namespace Database\Seeders;

use App\Models\GstSlab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GstSlab::create([
            'name'=> 'Gstslab@',
            'tax'=> '0',
            'description' => 'none',
            'created_by' => 1,
            'is_default' => 1,
        ]);
     }
    }