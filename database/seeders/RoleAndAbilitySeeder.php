<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Bouncer;

class RoleAndAbilitySeeder extends Seeder
{
    public function run()
    {
        // Define Roles
        Bouncer::role()->create([
            'name' => 'Regular',
            'title' => 'Regular User',
        ]);

        Bouncer::role()->create([
            'name' => 'GroupAdmin',
            'title' => 'Group Admin',
        ]);

        Bouncer::role()->create([
            'name' => 'SuperAdmin',
            'title' => 'Super Admin',
        ]);

        // Define Abilities for each Role

        // Abilities for Regular Users
        Bouncer::allow('Regular')->to('view-own-codes');
        Bouncer::allow('Regular')->to('generate-codes');
        Bouncer::allow('Regular')->to('delete-own-codes');

        // Abilities for GroupAdmin
        Bouncer::allow('GroupAdmin')->to('view-assigned-groups');
        Bouncer::allow('GroupAdmin')->to('view-users-in-group');
        Bouncer::allow('GroupAdmin')->to('assign-users-to-group');
        Bouncer::allow('GroupAdmin')->to('remove-users-from-group');
        Bouncer::allow('GroupAdmin')->to('export-group-codes');

        // Abilities for SuperAdmin
        Bouncer::allow('SuperAdmin')->to('view-all-users-and-codes');
        Bouncer::allow('SuperAdmin')->to('view-all-groupadmins-and-groups');
        Bouncer::allow('SuperAdmin')->to('export-all-codes');
        Bouncer::allow('SuperAdmin')->to('create-update-delete-group');
        Bouncer::allow('SuperAdmin')->to('assign-users-to-group');
        Bouncer::allow('SuperAdmin')->to('remove-users-from-group');
        Bouncer::allow('SuperAdmin')->to('assign-groupadmin-to-groups');
    }

}
