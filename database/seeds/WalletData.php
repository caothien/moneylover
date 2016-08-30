<?php

use Illuminate\Database\Seeder;

class WalletData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallets')->insert(
                [
                    [
                        'id_wallet' => '1',
                        'name_wallet' => 'Agribank',
                        'money_wallet' => '1000000',
                        'id_type' => '1',
                        'note_wallet' => 'No',
                        'avatar_wallet' => 'images/default.png',
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()
                    ],
                    [
                        'id_wallet' => '2',
                        'name_wallet' => 'Seccombank',
                        'money_wallet' => '4000000',
                        'id_type' => '2',
                        'note_wallet' => 'No',
                        'avatar_wallet' => 'images/default.png',
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()
                    ]
                ]
        );
    }
}
