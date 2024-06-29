<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {DB::table('users')->insert([
            ['username' => 'Ichinohe',
            'mail' => 'itnhyt@01.com',
            'password' => bcrypt(655),],

        ]);
        //
    }
}
