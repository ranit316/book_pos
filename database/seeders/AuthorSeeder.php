<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = array(
            [
                'name' => 'Rabindranath Tagore',
                'description' => ''
            ],
            [
                'name' => 'Satyajit Ray',
                'description' => ''
            ],
            [
                'name' => 'Sarat Chandra Chattopadhyay',
                'description' => ''
            ],
            [
                'name' => 'Bankim Chandra Chattopadhyay',
                'description' => ''
            ],
            [
                'name' => 'Jibanananda Das',
                'description' => ''
            ],
            [
                'name' => 'Shirshendu Mukhopadhyay',
                'description' => ''
            ],
            [
                'name' => 'Sunil Gangopadhyay',
                'description' => ''
            ],
            [
                'name' => 'Kazi Nazrul Islam',
                'description' => ''
            ],
            [
                'name' => 'Humayun Ahmed',
                'description' => ''
            ],
            [
                'name' => 'Bibhutibhushan Bandyopadhyay',
                'description' => ''
            ],
            [
                'name' => 'Manik Bandopadhyay',
                'description' => ''
            ],
            [
                'name' => 'Ashapurna Devi',
                'description' => ''
            ],
            [
                'name' => 'Bonophool',
                'description' => ''
            ],
            [
                'name' => 'Sharatchandra Chattopadhyay',
                'description' => ''
            ],
            [
                'name' => 'Joy Goswami',
                'description' => ''
            ],
            [
                'name' => 'Muhammad Zafar Iqbal',
                'description' => ''
            ],
            [
                'name' => 'Nirendranath Chakraborty',
                'description' => ''
            ],
            [
                'name' => 'Shakti Chattopadhyay',
                'description' => ''
            ],
            [
                'name' => 'Samaresh Basu',
                'description' => ''
            ],
            [
                'name' => 'Mahasweta Devi',
                'description' => ''
            ],
            [
                'name' => 'Sharadindu Bandyopadhyay',
                'description' => ''
            ],
            [
                'name' => 'Joydeep Mukherjee',
                'description' => ''
            ],
            [
                'name' => 'Shaktipada Rajguru',
                'description' => ''
            ],
            [
                'name' => 'Samaresh Basu',
                'description' => ''
            ],
            [
                'name' => 'Narayan Sanyal',
                'description' => ''
            ],
            [
                'name' => 'Abanindranath Tagore',
                'description' => ''
            ],
            [
                'name' => 'Ashutosh Mukherjee',
                'description' => ''
            ],
            [
                'name' => 'Leela Majumdar',
                'description' => ''
            ],
            [
                'name' => 'Bani Basu',
                'description' => ''
            ],
            [
                'name' => 'Achintya Kumar Sengupta',
                'description' => ''
            ],
            [
                'name' => 'Debesh Roy',
                'description' => ''
            ],
            [
                'name' => 'Samar Sen',
                'description' => ''
            ],
            [
                'name' => 'Tarashankar Bandopadhyay',
                'description' => ''
            ],
            [
                'name' => 'Mahadevi Birla',
                'description' => ''
            ],
            [
                'name' => 'Mukul Kesavan',
                'description' => ''
            ],
            [
                'name' => 'Buddhadeb Guha',
                'description' => ''
            ],
            [
                'name' => 'Shirsendu Mukhopadhyay',
                'description' => ''
            ],
            [
                'name' => 'Jhumpa Lahiri',
                'description' => ''
            ],
            [
                'name' => 'Amitav Ghosh',
                'description' => ''
            ],
            [
                'name' => 'Chitra Banerjee Divakaruni',
                'description' => ''
            ],

        );
        foreach($author as $data)
        {
            Author::create($data);
        }
    }
}
