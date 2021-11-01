<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Users = User::factory(1)->create();
        $role = Role::where("slug", "admin")->first();

        $Users->each(function($user) use ($role){
            $user->role()->attach($role->id);
        });
    }
    
}
