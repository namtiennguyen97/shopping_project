<?php

namespace Database\Seeders;

use App\Models\Roles;
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
        $role = new Roles();
        $role->id = 1;
        $role->name = 'user';
        $role->save();

        $role = new Roles();
        $role->id = 2;
        $role->name = 'admin';
        $role->save();
    }
}
