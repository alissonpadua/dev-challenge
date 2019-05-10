<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name' => 'Admin',
        'email' => 'admin@vendedor.com',
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret,
        'remember_token' => str_random(10),
      ]);


      $this->command->info('====== Users Seeded ===========');
      $this->command->info('user: admin@vendedor.com');
      $this->command->info('pass: secret');
      $this->command->info('===============================');

    }
}
