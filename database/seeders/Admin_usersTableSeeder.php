<?php

use Illuminate\Database\Seeder;


class Admin_usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert(
            [
                'name' => 'mevivu',
                'email' => 'truong6@gmail.com',
                'password' => bcrypt('12345')
            ]
        );
    }
}