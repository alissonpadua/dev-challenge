<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('paymodes')->insert([
        'description' => 'DINHEIRO',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

      DB::table('paymodes')->insert([
        'description' => 'CARTÃO DE CRÉDITO',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

      DB::table('paymodes')->insert([
        'description' => 'CARTÃO DE DÉBITO',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

      $this->command->info('====== Paymodes Seeded ========');
    }
}
