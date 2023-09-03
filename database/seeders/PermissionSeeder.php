<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           [
               'id'=>1,
               'name'=>'user_access'
           ],
           [
               'id'=>2,
               'name'=>'user_create'
           ],
           [
               'id'=>3,
               'name'=>'user_edit'
           ],
           [
               'id'=>4,
               'name'=>'user_show'
           ],
           [
               'id'=>5,
               'name'=>'user_delete'
           ],
            [
                'id'=>6,
                'name'=>'task_access'
            ],
            [
                'id'=>7,
                'name'=>'task_create'
            ],
            [
                'id'=>8,
                'name'=>'task_edit'
            ],
            [
                'id'=>9,
                'name'=>'task_show'
            ],
            [
                'id'=>10,
                'name'=>'task_delete'
            ],
        ];

        Permission::insert($permissions);
    }
}
