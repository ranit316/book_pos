<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i = 1; $i <= 1000; $i++) {
        //     Product::create([
        //         'category_id' =>  rand(1,10),
        //         'supplier_id' => 2,
        //         'gst_slab_id'=>rand(1,3),
        //         'title' => 'Book - '.$i,
        //         'author' => 'auther - '.$i,
        //         'isbn' => '0001'.$i,
        //         'price' => rand(100,9999),
        //         'publication_date' => date('Y-m-d'),
        //         'language' => 'ENG',
        //         'weight' => '100',
        //         'dimensions' => '200x200',
        //         'image' => 'data',
        //         'pages' => rand(100,300),
        //         'description' => 'data',
        //         'created_by' => '1',
           
        //     ]);
        // }
        Product::create([
            'category_id' => 1,
            'supplier_id' => 2,
            'gst_slab_id'=> '1',
            'title' => 'BANGLAR ADIBASHI',
            'author' => 2,
            'isbn' => '978-81-89956-83-7',
            'price' => '1',
            'publication_date' => '2024-04-03',
            'language' => 'Bengali',
            'weight' => '765 gms',
            'dimensions' => '24.6cm x 16.4cm x 2.5cm',
            'image' => 'assets/images/product/bookplaceholder.jpg',
            'pages' => '300',
            'description' => "'আদিবাসী' এই শব্দটির মধ্যে যেন একটি সুরের মূর্ছনা রয়েছে। আদি মানুষ, সুপ্রাচীন সভ্যতা, পরম্পরাগত ঐতিহ্য—সবই যেন একাকার হয়ে মিশে রয়েছে এই শব্দটির মধ্যে। 'আদিবাসী' মানেই খাঁটি, মিশ্রণহীন বিশুদ্ধতার প্রতীক। ভারতীয় সভ্যতায় ভাষা, সংস্কৃতি, জীবনযাপনের মূল ভিত্তি হল ভারতের আদিবাসী সমাজ। ভারতের বৈচিত্র্যময় সংস্কৃতির অঙ্গনটি আলোকিত হয়েছে নানা আদিবাসী সভ্যতার আলোকে। অথচ এই আদিবাসী সমাজ সম্পর্কে আমরা আশ্চর্যজনকভাবে উদাসীন ও নির্লিপ্ত থেকেছি। সেভাবে আমরা স্বীকার করিনি ভারতীয় সভ্যতা ও সংস্কৃতিতে আদিবাসীদের অবদানের কথা। এমনকি জানতে আগ্রহ প্রকাশ করিনি ভারতীয় সভ্যতার আদি স্থপতিদের আচার-বিচার জীবনযাত্রা-প্রণালীর কথা। কখনও আমরা তাঁদের সভ্যতার মূল কেন্দ্র থেকে দূরে সরিয়ে রেখেছি আবার কখনও তাঁরা নিজেরাই অভিমানে দূরে সরে গেছেন। এই বইটি সেতু নির্মাণ৷ করছে আদিবাসী এবং নাগরিক সমাজের মধ্যে।
            এই বই পড়ে বাংলার আদিবাসীদের জীবনযাত্রা সম্পর্কে একটি সম্যক ধারণা পাওয়া যাবে। এ ছাড়া জেলাভিত্তিক আদিবাসী জনগোষ্ঠীগুলির যে পরিসংখ্যান সংযোজন করা হয়েছে বইটিতে, তাতে গবেষক ও প্রশাসকদেরও কাজে সুবিধা হবে।",
            'created_by' => '1',
            'unit_id' => '1',
       
        ]);
        Product::create([
            'category_id' => 2,
            'supplier_id' => 2,
            'gst_slab_id'=>'1',
            'title' => 'BARAK UPATYAKAR LOKONRITYA',
            'author' => 3,
            'isbn' => '81-87360-82-8',
            'price' => '1',
            'publication_date' => '2024-04-03',
            'language' => 'Bengali',
            'weight' => '177 gms',
            'dimensions' => '21.6cm x 13.7cm x 0.8cm',
            'image' => 'assets/images/product/bookplaceholder.jpg',
            'pages' => '148',
            'description' => "এই বইটি আসলে লোকসংস্কৃতি ও আদিবাসী সংস্কৃতি কেন্দ্র আয়োজিত ২০০৪ সালের অরুণকুমার রায় স্মারক বক্তৃতার লিখিত রূপ। উত্তরপূর্ব ভারতের আসামের কাছাড়, করিমগঞ্জ, হাইলাকান্দির ভূভাগে সুপ্রাচীন কাল থেকে বসবাসকারী নানা ভাষাভাষী জনগোষ্ঠীর মধ্যে প্রচলিত লোকনৃত্যগুলির বিস্তৃত পরিচয় দিয়েছে এ গ্রন্থ। দুটি অধ্যায়ে বিভক্ত বইটিতে লোকসংস্কৃতির অন্যতম আঙ্গিক হিসেবে লোকনৃত্য একটি বিশেষ আর্থসামাজিক পরিবেশে যে বিশেষ রূপ লাভ করেছে তার পরিচয় দিয়েছেন লেখক। গীতপ্রধান লোকনৃত্যে বিশেষ বিশেষ ক্ষেত্রে ব্যবহৃত গান তুলে ধরে আলোচনা এগিয়েছে বইটিতে। পরিশেষে যুক্ত হয়েছে বিভিন্ন লোকনৃত্যের নৃত্যরত অবস্থার মোট ১১টি সাদা-কালো ছবি।",
            'created_by' => '1',
            'unit_id' => '1',
       
        ]);
    }
}
