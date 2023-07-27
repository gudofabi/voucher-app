<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Bouncer;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a GroupAdmin user
        $groupAdmin = User::factory()->create([
            'email' => 'groupadmin@example.com',  // Set a specific email for testing
            'password' => bcrypt('password'),
        ]);
        Bouncer::assign('GroupAdmin')->to($groupAdmin);

        // Create a SuperAdmin user
        $superAdmin = User::factory()->create([
            'email' => 'superadmin@example.com',  // Set a specific email for testing
            'password' => bcrypt('password'),
        ]);
        Bouncer::assign('SuperAdmin')->to($superAdmin);
    }
}
