<?php

use Illuminate\Database\Seeder;

class DefaultParamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('default_params')->insert([
        	'uuid' => 'project_tree',
        	'json_data' => json_encode([
        					"Level" => [
        						'Room' => [
        							'Element' => [
        								'Item' => []
        							]
        						]
        					]
        				])
        ]);
    }
}
