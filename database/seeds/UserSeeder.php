<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'       => 'Андрей Павлов',
            'email'      => 'admin@gmail.com',
            'is_admin'   => 1,
            'password'   => bcrypt('adminpass'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name'       => 'Влад Волков',
            'email'      => 'user@gmail.com',
            'is_admin'   => 0,
            'password'   => bcrypt('userpass'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
