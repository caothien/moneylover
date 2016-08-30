<?php

use Illuminate\Database\Seeder;

class TypeMoneyData extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('typemoneys')->insert(
                [
                    [
                        'id_type' => '1',
                        'name_type' => 'Vnd',              
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()
                    ],
                    [
                        'id_type' => '2',
                        'name_type' => 'Dollar',              
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()
                    ]
                ]
        );
    }

}
