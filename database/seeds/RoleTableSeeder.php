<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $roles = [
            [
                'name' => 'admin',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'clerk',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'customer',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        ];

        Role::insert($roles);

        // Admin Role
        $user = User::find(1);
        $user->roles()->attach(1);
        //Clerk Role
        $user = User::find(2);
        $user->roles()->attach(2);
        //Customer Role
        $user = User::find(3);
        $user->roles()->attach(3);
    }
}
