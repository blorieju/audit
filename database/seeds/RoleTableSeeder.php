<?php

use App\Models\Role;
use App\Models\User;
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
                'description' => 'Owner of Audit System from United Kingdom'
            ],
            [
                'name' => 'clerk',
                'description' => 'Clerk registered to update and create events'
            ],
            [
                'name' => 'customer',
                'descriptio' => 'User of services offered by Audit System'
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
