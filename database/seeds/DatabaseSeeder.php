<?php

use App\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(employeeSeeder::class);
        $roles = ['admin', 'employee'];
        foreach($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
