<?php
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $user = [
            [
                'email'     => 'admin@gmail.com',
                'password'  => bcrypt('password'),
                'activation_token' => NULL,
                'active' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'email'     => 'clerk@gmail.com',
                'password'  => bcrypt('password'),
                'activation_token' => NULL,
                'active' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'email'     => 'customer@gmail.com',
                'password'  => bcrypt('password'),
                'activation_token' => NULL,
                'active' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        ];
        User::insert($user);
    }
}
