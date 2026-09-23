<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'Free',
            'price' => 0,
            'max_invoice_limit' => 5,
        ]);

        Plan::create([
            'name' => 'Pro',
            'price' => 100,
            'max_invoice_limit' => null,
        ]);
    }
}
