<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
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
        \App\Models\User::factory(10)->create();
        $roles = \App\Models\Role::all();

// Populate the pivot table
        \App\Models\User::all()->each(function ($user) use ($roles) { 
            $user->roles()->attach(
                $roles->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });
    }
}
