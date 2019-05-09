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
        'name' => 'Vendedor 01',
        'email' => '01@vendedor.com',
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret,
        'remember_token' => str_random(10),
      ]);

      DB::table('users')->insert([
        'name' => 'Vendedor 02',
        'email' => '02@vendedor.com',
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret,
        'remember_token' => str_random(10),
      ]);

      $this->command->info('====== Users Seeded ===========');
      $this->command->info('user: 01@vendedor.com');
      $this->command->info('pass: secret');
      $this->command->info('user: 02@vendedor.com');
      $this->command->info('pass: secret');
      $this->command->info('===============================');

    }
}
