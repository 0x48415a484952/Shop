<?php

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            'Eastern Azarbayjan Province' => 'استان آذربایجان شرقی',
            'Western Azarbayjan Province' => 'استان آذربایجان غربی',
            'Ardebil Province' => 'استان اردبیل',
            'Isfahan Province' => 'استان اصفهان',
            'Alborz Province' => 'استان البرز',
            'Ilam Province' => 'استان ایلام',
            'Bousher Province' => 'استان بوشهر',
            'Tehran Province' => 'استان تهران',
            'Chahar Mahal o Bakhtiari Province' => 'استان چهارمحال و بختیاری',
            'Khorasan Jonoubi Province' => 'استان خراسان جنوبی',
            'Khorasan Razavi Province' => 'استان خراسان رضوی',
            'Khorasan Shomali Province' => 'استان خراسان شمالی',
            'Khouzestan Province' => 'استان خوزستان',
            'Zanjan Province' => 'استان زنجان',
            'Semnan Province' => 'استان سمنان',
            'Sistan O Balouchestan Province' => 'استان سیستان و بلوچستان',
            'Fars Province' => 'استان فارس',
            'Qazvin Province' => 'استان قزوین',
            'Qom Province' => 'استان قم',
            'Kurdistan Province' => 'استان کردستان',
            'Kerman Province' => 'استان کرمان',
            'Kermanshah Province' => 'استان کرمانشاه',
            'Kohkiloyeh va Bouyerahmad Province' => 'استان کهکیلویه و بویراحمد',
            'Golestan Province' => 'استان گلستان',
            'Gilan Province' => 'استان گیلان',
            'Lorestan Province' => 'استان لرستان',
            'Mazandaran Province' => 'استان مازندران',
            'Markazi Province' => 'استان مرکزی',
            'Hormozgan_ rovince' => 'استان هرمزگان',
            'Hamedan Province' => 'استان همدان',
            'Yazd Province' => 'استان یزد',
        ];

        collect($provinces)->each(function ($persianName, $englishName) {
            Province::create([
                'province_name_en' => $englishName,
                'province_name_fa' => $persianName
            ]);
        });
    }
}
