<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
          'description' => 'INSUMOS',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
          'description' => 'PEÇAS',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
          'description' => 'IMPLEMENTOS',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
          'description' => 'AGROQUÍMICO',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);

        $this->command->info('====== Categories Seeded ======');
    }
}
