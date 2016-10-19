<?php

use App\Profile;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->delete();
        $profiles = [
            [
                'user_id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'mobile' => '09222122432',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'user_id' => 2,
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'mobile' => '09262140562',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'user_id' => 3,
                'first_name' => 'Maria',
                'last_name' => 'Doe',
                'mobile' => '09262140562',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        ];

        Profile::insert($profiles);
    }
}
