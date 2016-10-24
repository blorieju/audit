<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->delete();
        $plans = [
            [
                'name' => 'small',
                'slug' => 'small',
                'stripe_plan' => 'Small Plan',
                'cost' => 5.00,
                'description' => 'Small Plan Package',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'big',
                'slug' => 'Big',
                'stripe_plan' => 'Big Plan',
                'cost' => 10.00,
                'description' => 'Big Plan Package',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        ];

        Plan::insert($plans);
    }
}
