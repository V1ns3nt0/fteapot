<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ru_RU');
        $kinds = ['Зеленый Чай', 'Черный Чай', 'Желтый Чай',
                  'Красный Чай', 'Белый Чай', 'Пу Эр', 'Улун'];
        $tastes = ['Цветочный', 'Фруктовый', 'Ореховый', 'Травяной',
                  'Цитрусовый', 'Ягодный', 'Сливочный', 'Землистый'];

        $categories = ['Чай'];

        $tea_names = ['Лун Цзин', 'Красный Кминун', 'Снежный Барс',
        'Богована', 'Сент Джеймс', 'Адамс Пик', 'Генмайча', 'Жасмин Чан Хао',
        'Девять Драконов', 'Веретено Джейд', 'Хей Чжу','Бай Му Дань',
        'Юн Ву','Желтые Пики Юннаня','Инь Чжень'];

        $images = ['5cfe35ffd1c06976807c2785e6494d76.png', '07f3da4ce4aa913517.jpg', '9d26940ed7d4b6356869fff2655b7286.jpg',
        '306e4e9d7b8b16c8a19e01.jpg', '55955a77e95fd83fb50ba6.jpg', 'ee7c68f47cef513db5e6138.jpg',
        'd13c86738408a2790fa.jpg', 'b2f106df7b206a5118.jpg', 'da85af7f95ca8025ade775ebfad83d33.jpg'];

        $path = '/storage/tea/';
        $library_path='/storage/library/';
        $news_path='/storage/news/';

        $lib_img= ['pexels-photo-92327.jpeg', 'pexels-photo-230491.jpeg', 'pexels-photo-1591245.jpeg', 'pexels-photo-1662816.jpeg',
        'pexels-photo-1831744.jpeg', 'pexels-photo-1872893.jpeg', 'pexels-photo-2378498.jpeg', 'pexels-photo-2609565.jpeg',
        'pexels-photo-3123918.jpeg'];

        $news_img = ['3373643.jpg', '3373630.jpg', '3284554.png'];

        DB::table('users')->insert([
          'last_name' => 'Ogami',
          'first_name' => 'Koga',
          'email' => 'kogaOgam@gmail.jp',
          'password' => Hash::make('root12345'),
          'is_admin' => 1,
        ]);

        foreach ($categories as $category) {
          DB::table('categories')->insert([
              'name' => $category,
          ]);
        }

        foreach ($kinds as $kind) {
          DB::table('tea_kinds')->insert([
              'name' => $kind,
          ]);
        }

        foreach ($tastes as $taste) {
          DB::table('tea_tastes')->insert([
              'name' => $taste,
          ]);
        }

        for($i=0; $i<18; $i++) {
          $nameKey = array_rand($tea_names, 1);
          $kindKey = array_rand($kinds, 1)+1;
          $tasteKey = array_rand($tastes, 1)+1;
          $img = $path.$images[array_rand($images, 1)];
          DB::table('products')->insert([
            'category_id' => 1,
            'name' => $tea_names[$nameKey],
            'card_description' => $faker->realText(150),
            'full_description' => $faker->realText(650),
            'tea_kind' => $kindKey,
            'tea_taste' => $tasteKey,
            'path' => $img,
            'price' => rand(150, 870),
          ]);
        }

        for($i=0; $i<14; $i++) {
          $libi = $library_path.$lib_img[array_rand($lib_img, 1)];
          DB::table('articles')->insert([
            'title' => $faker->realText(35),
            'path' =>$libi,
            'description'=> $faker->realText(110),
            'content'=>$faker->realText(700),
            'user_id' => 1
          ]);
        }

        for($i=0; $i<3; $i++) {
          $newpat = $news_path.$news_img[array_rand($news_img, 1)];
          DB::table('news')->insert([
            'path' => $newpat,
            'actual' => 1,
            'user_id' => 1
          ]);
        }
    }
}
