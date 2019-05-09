<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('clients')->insert([
        'name' => 'ALISSON DE PÁDUA',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

      DB::table('clients')->insert([
        'name' => 'RAFAELA CARMACIO',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

      DB::table('clients')->insert([
        'name' => 'PEDRO PAULO',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

      DB::table('clients')->insert([
        'name' => 'RAFAEL COIMBRA',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

      $this->command->info('====== Clients Seeded =========');
    }
}
