<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterUomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_uom')->insert([
        	'name' => 'GLN'
        ]);

        DB::table('master_uom')->insert([
        	'name' => 'BH'
        ]);

        DB::table('master_uom')->insert([
        	'name' => 'PCS'
        ]);
    }
}
