<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Value;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            ['name' => 'Gat', 'name_en' => 'Floor', 'name_ru' => 'Этаж', 'sort_order' => 1, 'values' => [
                ['name' => '1', 'name_en' => '1',  'name_ru' => '1', 'sort_order' => 1],
                ['name' => '2', 'name_en' => '2',  'name_ru' => '2', 'sort_order' => 2],
                ['name' => '3', 'name_en' => '3',  'name_ru' => '3', 'sort_order' => 3],
                ['name' => '4', 'name_en' => '4',  'name_ru' => '4', 'sort_order' => 4],
                ['name' => '5', 'name_en' => '5',  'name_ru' => '5', 'sort_order' => 5],
                ['name' => '6', 'name_en' => '6',  'name_ru' => '6', 'sort_order' => 6],
                ['name' => '7', 'name_en' => '7',  'name_ru' => '7', 'sort_order' => 7],
                ['name' => '8', 'name_en' => '8',  'name_ru' => '8', 'sort_order' => 8],
                ['name' => '9', 'name_en' => '9',  'name_ru' => '9', 'sort_order' => 9],
                ['name' => '10', 'name_en' => '10', 'name_ru' => '10', 'sort_order' => 10],
                ['name' => '11', 'name_en' => '11', 'name_ru' => '11', 'sort_order' => 11],
                ['name' => '12', 'name_en' => '12', 'name_ru' => '12', 'sort_order' => 12],
                ['name' => '13', 'name_en' => '13', 'name_ru' => '13', 'sort_order' => 13],
                ['name' => '14', 'name_en' => '14', 'name_ru' => '14', 'sort_order' => 14],
            ]],
            ['name' => 'Otag', 'name_en' => 'Room', 'name_ru' => 'Комнат', 'sort_order' => 2, 'values' => [
                ['name' => '1', 'name_en' => '1',  'name_ru' => '1', 'sort_order' => 1],
                ['name' => '2', 'name_en' => '2',  'name_ru' => '2', 'sort_order' => 2],
                ['name' => '3', 'name_en' => '3',  'name_ru' => '3', 'sort_order' => 3],
                ['name' => '4', 'name_en' => '4',  'name_ru' => '4', 'sort_order' => 4],
                ['name' => '5', 'name_en' => '5',  'name_ru' => '5', 'sort_order' => 5],
                ['name' => '6', 'name_en' => '6',  'name_ru' => '6', 'sort_order' => 6],
                ['name' => '7', 'name_en' => '7',  'name_ru' => '7', 'sort_order' => 7],
                ['name' => '8', 'name_en' => '8',  'name_ru' => '8', 'sort_order' => 8],
                ['name' => '9', 'name_en' => '9',  'name_ru' => '9', 'sort_order' => 9],
                ['name' => '10', 'name_en' => '10', 'name_ru' => '10', 'sort_order' => 10],
            ]],
            ['name' => 'Hammam', 'name_en' => 'Bathroom', 'name_ru' => 'Ванна', 'sort_order' => 3, 'values' => [
                ['name' => 'ýok', 'name_en' => 'no', 'name_ru' => 'Нет', 'sort_order' => 1],
                ['name' => '1', 'name_en' => '1', 'name_ru' => '1', 'sort_order' => 2],
                ['name' => '2', 'name_en' => '2', 'name_ru' => '2', 'sort_order' => 3],
                ['name' => '3', 'name_en' => '3', 'name_ru' => '3', 'sort_order' => 4],
                ['name' => '4', 'name_en' => '4', 'name_ru' => '4', 'sort_order' => 5],
            ]],
        ];

        foreach ($options as $option) {
            $opt = new Option();
            $opt->name = $option['name'];
            $opt->name_en = $option['name_en'];
            $opt->name_ru = $option['name_ru'];
            $opt->sort_order = $option['sort_order'];
            $opt->save();

            foreach ($option['values'] as $value) {
                $val = new Value();
                $val->option_id = $opt->id;
                $val->name = $value['name'];
                $val->name_en = $value['name_en'];
                $val->name_ru = $value['name_ru'];
                $val->sort_order = $value['sort_order'];
                $val->save();
            }
        }
    }
}
