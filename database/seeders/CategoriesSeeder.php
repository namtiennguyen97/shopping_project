<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cate = new Categories();
        $cate->id = 1;
        $cate->name = 'Women Cloth';
        $cate->save();

        $cate = new Categories();
        $cate->id = 2;
        $cate->name = 'Men Cloth';
        $cate->save();

        $cate = new Categories();
        $cate->id = 3;
        $cate->name = 'Kid Cloth';
        $cate->save();
    }
}
