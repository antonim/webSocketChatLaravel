<?php

use Illuminate\Database\Seeder;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'username' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('123123'),
        ]);

        User::create([
            'username' => 'test1',
            'email' => 'test1@test.com',
            'password' => bcrypt('123123'),
        ]);

        User::create([
            'username' => 'test2',
            'email' => 'test2@test.com',
            'password' => bcrypt('123123'),
        ]);

        User::create([
            'username' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('123123'),
            'is_admin' => true,
        ]);
    }
}
