<?php

use Illuminate\Database\Seeder;

class TypeOfCanvasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_of_canvas')->insert([
            'uuid' => 'business_model',
        	'name' => 'Business Model Canvas',
        	'content' => json_encode([
        					0 => [
                                    "Sequence" => 0,
                                    "MaxCardRow" => 1,
                                    "MaxCardColumn" => 5,
                                    "Name" => "Key Partners"
        						],
                            1 => [
                                    "Sequence" => 1,
                                    "MaxCardRow" => 2,
                                    "MaxCardColumn" => 5,
                                    "Name" => "Key Activities"
                                ],
                            2 => [
                                    "Sequence" => 2,
                                    "MaxCardRow" => 2,
                                    "MaxCardColumn" => 5,
                                    "Name" => "Key Resources"
                                ],
                            3 => [
                                    "Sequence" => 3,
                                    "MaxCardRow" => 1,
                                    "MaxCardColumn" => 5,
                                    "Name" => "Value Propositions"
                                ],
                            4 => [
                                    "Sequence" => 4,
                                    "MaxCardRow" => 2,
                                    "MaxCardColumn" => 5,
                                    "Name" => "Customer Relationships"
                                ],
                            5 => [
                                    "Sequence" => 5,
                                    "MaxCardRow" => 2,
                                    "MaxCardColumn" => 5,
                                    "Name" => "Channels"
                                ],
                            6 => [
                                    "Sequence" => 6,
                                    "MaxCardRow" => 1,
                                    "MaxCardColumn" => 5,
                                    "Name" => "Customer Segments"
                                ],
                            7 => [
                                    "Sequence" => 7,
                                    "MaxCardRow" => 1,
                                    "MaxCardColumn" => 2,
                                    "Name" => "Cost Structure"
                                ],
                            8 => [
                                    "Sequence" => 8,
                                    "MaxCardRow" => 1,
                                    "MaxCardColumn" => 2,
                                    "Name" => "Revenue Streams"
                                ]
        				])
        ]);
    }
}