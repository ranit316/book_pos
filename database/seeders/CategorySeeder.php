<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Fiction', 'created_by' => '1'],
            ['name' => 'Non-Fiction', 'created_by' => '1'],
            ['name' => 'Romance', 'created_by' => '1'],
            ['name' => 'Mystery/Thriller', 'created_by' => '1'],
            ['name' => 'Science Fiction/Fantasy', 'created_by' => '1'],
            ['name' => 'Horror', 'created_by' => '1'],
            ['name' => 'Children\'s and Young Adult', 'created_by' => '1'],
            ['name' => 'Historical', 'created_by' => '1'],
            ['name' => 'Biography/Autobiography', 'created_by' => '1'],
            ['name' => 'Poetry', 'created_by' => '1'],
            ['name' => 'Science', 'created_by' => '1'],
            ['name' => 'Self-Help/Motivational', 'created_by' => '1'],
            ['name' => 'Business/Finance', 'created_by' => '1'],
            ['name' => 'Travel', 'created_by' => '1'],
            ['name' => 'Cookbooks', 'created_by' => '1'],
            ['name' => 'Graphic Novels/Comics', 'created_by' => '1'],
            ['name' => 'Religion/Spirituality', 'created_by' => '1'],
            ['name' => 'Art/Photography', 'created_by' => '1'],
            ['name' => 'Drama/Play', 'created_by' => '1'],
            ['name' => 'Others', 'created_by' => '1'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
