<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */             
    public function run()
    {

    $users = array(
            [
                'name' => "admin",
                'email' => "dev-sa@wbicabooks.com",
                'type' => "admin",
                'role_id' => 1, 
                'password' => Hash::make("Admin@$2024"),
            ],
            [
                'name' => "FOLK AND TRIBAL CULTURAL CENTRE/ADMIN",
                'address' => "Lokogram Chittkalikapur, Nitai Nagar, Kolkata, West Bengal 700099",
                'email' => "ftcc.pub@wbicabooks.com",
                'phone' => "8820111123",
                'type' => "publisher",
                'role_id' => 5,
                'password' => Hash::make("Ftcc.pub@wbicabooks.com"),
                'publisher_id' => 1,
                // 'store_id' => "1",
                'created_by' => 1,
                
                // \App\Models\Store::get()->random()->id,
            ],
            [
                'name' => "SHISHU KISHORE AKADEMI/ADMIN",
                'address' => "Rabindra Sadan, 2nd Floor, Gerasim Lebedev Sarani, Kolkata, West Bengal 700071",
                'email' => "ska.pub@wbicabooks.com",
                'phone' => "8820111123",
                'type' => "publisher",
                'role_id' => 5,
                'password' => Hash::make("Ska.pub@wbicabooks.com"),
                'publisher_id' => 2,
                // 'store_id' => "1",
                'created_by' => 1,
                // \App\Models\Store::get()->random()->id,
            ],
            [
                'name' => "BASUMATI CORPORATION LIMITED/ADMIN",
                'address' => "166, BB Ganguly Street, Kolkata, West Bengal 700012",
                'email' => "bcl.pub@wbicabooks.com",
                'phone' => "8820111123",
                'type' => "publisher",
                'role_id' => 5,
                'password' => Hash::make("Bcl.pub@wbicabooks.com"),
                'publisher_id' => 3,
                // 'store_id' => "1",
                'created_by' => 1,
                // \App\Models\Store::get()->random()->id,
            ],
            [
                'name' => "PASCHIMBANGA BANGLA AKADEMY/ADMIN",
                'address' => "1/1, A J C Bose Road, Lala Lajpat Rai Sarani, Lala Lajpat Rai Sarani, Kolkata, West Bengal 700020",
                'email' => "pba.pub@wbicabooks.com",
                'phone' => "8820111123",
                'type' => "publisher",
                'role_id' => 5,
                'password' => Hash::make("Pba.pub@wbicabooks.com"),
                'publisher_id' => 4,
                // 'store_id' => "1",
                'created_by' => 1,
                // \App\Models\Store::get()->random()->id,
            ],
            [
                'name' => "central",
                'email' => "icabookpos.cs1@wbicabooks.com",
                'type' => "central-store",
                'role_id' => 3,
                'store_id' => "2",
                'parent_id' => "2",
                'created_by' => 1,
                'password' => Hash::make("icabookpos.cs1@wbicabooks.com"),
            ],
            [
                'name' => "retail",
                'email' => "icabookpos.rs1@wbicabooks.com",
                'type' => "retail-store",
                'role_id' => 1,
                'store_id' => "1",
                'created_by' => 1,
                'password' => Hash::make("icabookpos.rs1@wbicabooks.com"),
            ],
            // [
            //     'name' => "publisher for store 3",
            //     'email' => "publisher3@ica.book.store.com",
            //     'type' => "publisher",
            //     'role_id' => 1,
            //     'store_id' => "3",
            //     'password' => Hash::make("publisher@1234"),
            // ],
            // [
            //     'name' => "publisher for store 4",
            //     'email' => "publisher4@ica.book.store.com",
            //     'type' => "publisher",
            //     'role_id' => 1,
            //     'store_id' => "4",
            //     'password' => Hash::make("publisher@1234"),
            // ],
            // [
            //     'name' => "central",
            //     'email' => "central@ica.book.store.com",
            //     'type' => "central-store",
            //     'role_id' => 2,
            //     'store_id' => "2",
            //     'password' => Hash::make("central@1234"),

            // ],
            // [
            //     'name' => "central",
            //     'email' => "central4@ica.book.store.com",
            //     'type' => "central-store",
            //     'role_id' => 2,
            //     'store_id' => "4",
            //     'password' => Hash::make("central@1234"),

            // ],
            // [
            //     'name' => "retail",
            //     'email' => "retail5@ica.book.store.com",
            //     'type' => "retail-store",
            //     'role_id' => 1,
            //     'store_id' => "5",
            //     'password' => Hash::make("retail@1234"),
            // ],
        );
        foreach($users as $user){
            User::create($user);
        }
    }
}
