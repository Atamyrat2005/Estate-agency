<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {$objects = [
        ['Jaýlar', 'Houses', 'Дома', 1],
        ['Söwda emläkler', 'Commercial estates', 'Коммерческая недвижимость', 2],
        ['Ofislar', 'Offices', 'Офисы', 3],
        ['Beýlekiler', 'Others', 'Другие', 4],
    ];

        foreach ($objects as $object) {
            $obj= new Category();
            $obj->name = $object[0];
            $obj->name_en = $object[1];
            $obj->name_ru = $object[2];
            $obj->slug = Str::slug($object[0]);
            $obj->sort_order = $object[3];
            $obj->save();
        }
    }
}