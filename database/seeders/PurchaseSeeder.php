<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purchasesData = [
            [
                'user_id' => 2,
                'course_id' => 1,
            ]
        ];

        DB::table('purchases')->insert($purchasesData);
    }
}
