<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class AssignAllPermissionsToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $permissions = Permission::all();

        User::chunk(100, function ($users) use ($permissions) {
            foreach ($users as $user) {
                $user->syncPermissions($permissions);
            }
        });

        $this->command->info('All users have been assigned all permissions.');
    }
}
