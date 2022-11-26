<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {$objects = [
        ['Aşgabat','Ashgabat', 'Ашхабад', 1],
        ['Ahal', 'Akhal', 'Ахал', 2],
        ['Balkan', 'Balkan', 'Балкан', 3],
        ['Daşoguz','Dashoguz', 'Дашогуз', 4],
        ['Lebap','Lebap', 'Лебап', 5],
        ['Mary', 'Mary', 'Мары', 6],
    ];

        foreach ($objects as $object) {
            $obj= new Location();
            $obj->name = $object[0];
            $obj->name_en = $object[1];
            $obj->name_ru = $object[2];
            $obj->slug = Str::slug($object[0]);
            $obj->sort_order = $object[3];
            $obj->save();
        }
    }
}