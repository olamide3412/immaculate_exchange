<?php

namespace Database\Seeders;

use App\Enums\RoleEnums;
use App\Models\User;
use App\Models\WhatsAppResponse;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        WhatsAppResponse::factory(25)->create();

        // User::factory()->create([
        //     'name' => 'Supper Admin',
        //     'email' => 'superadmin@gmail.com',
        //     'role' => RoleEnums::SuperAdministrator->value,
        // ]);
    }
}
