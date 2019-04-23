<?php

use App\Models\StudTransaction;
use App\Models\Student;
use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        StudTransaction::truncate();
        StudTransaction::flushEventListeners();

        $transactionsQuantity = 21;

        factory(StudTransaction::class, $transactionsQuantity)->create();

    }
}
