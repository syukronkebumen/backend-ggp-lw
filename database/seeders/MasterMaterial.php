<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterMaterial extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_material')->insert([
        	'material_code' => 'SSPA0200100',
        	'material_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed ea quaerat animi in! Dolor rem sint, dolorum explicabo sunt quaerat?',
        	'uom' => "GLN",
        	'batch' => 'ya',
        	'plant' => '1000',
        ]);

        DB::table('master_material')->insert([
        	'material_code' => 'SSPA0200438',
        	'material_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed ea quaerat animi in! Dolor rem sint, dolorum explicabo sunt quaerat?',
        	'uom' => "BH",
        	'batch' => 'ya',
        	'plant' => '1000',
        ]);

        DB::table('master_material')->insert([
        	'material_code' => '9A-BE02-TXCA3-EBGA',
        	'material_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed ea quaerat animi in! Dolor rem sint, dolorum explicabo sunt quaerat?',
        	'uom' => "PCS",
        	'batch' => 'tidak',
        	'plant' => '2003',
        ]);
    }
}
