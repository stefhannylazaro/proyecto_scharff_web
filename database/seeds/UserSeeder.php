<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert(
            [
                [
                    'id' => 1,
                    'email' => 'superadmin@mail.com',
                    'rol' => 'superadmin',
                    'password' => bcrypt('123456')
                ],
                [
                    'id' => 2,
                    'email' => 'admin@mail.com',
                    'rol' => 'admin',
                    'password' => bcrypt('123456')
                ],
            ]
        );

        DB::table('administrators')->delete();

        DB::table('administrators')->insert(
            [
                [
                    'user_id' => 1,
                    'nombre' => 'Super Admin'
                ],
                [
                    'user_id' => 2,
                    'nombre' => 'Admin'
                ]
            ]

        );
    }
}
