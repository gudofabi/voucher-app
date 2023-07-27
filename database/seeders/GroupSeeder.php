<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;
use Bouncer;

class GroupSeeder extends Seeder
{
    public function run()
    {
        // Get or create a group
        $group = Group::firstOrCreate(['name' => 'Test Group']);

        // Get the regular user and groupAdmin user by their email
        $regularUser = User::where('email', 'regular@example.com')->first();
        $groupAdmin = User::where('email', 'groupadmin@example.com')->first();

        // Assign the regular user and the groupAdmin to the group
        // In your seeder...
        $regularUser->group()->associate($group);
        $regularUser->save();

        $groupAdmin->group()->associate($group);
        $groupAdmin->save();
    }
}
