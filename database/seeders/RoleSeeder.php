<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = array(
          
            [
                'name' => "Admin",
                'type' => "retail-store",
            ],
            [
                'name' => "POS Manager",
                'type' => "retail-store",
            ],
            [
                'name' => "Admin",
                'type' => "central-store",
            ],
            [
                'name' => "POS Manager",
                'type' => "central-store",
            ],
            [
                'name' => "Admin",
                'type' => "publisher",
            ],
            [
                'name' => "Executive",
                'type' => "publisher",
            ],
            [
                'name' => "Executive",
                'type' => "central-store",
            ],
            [
                'name' => "Executive",
                'type' => "retail-store",
            ],
            [
                'name' => "Admin",
                'type' => "Sub-Central-Store",
            ],
            [
                'name' => "POS Manager",
                'type' => "Sub-Central-Store",
            ],
            [
                'name' => "Executive",
                'type' => "Sub-Central-Store",
            ],
        );

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
