<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('permissions')->insert([
            ['permission_name' => 'accès utilisateurs'],
            ['permission_name' => 'accès projets'],
            ['permission_name' => 'accès type service'],
            ['permission_name' => 'accès liste services'],
            ['permission_name' => 'accès demandes de services'],
            ['permission_name' => 'accès categories'],
            ['permission_name' => 'accès listes des offres'],
            ['permission_name' => 'accès candidatures'],
        ]);
    }
}
