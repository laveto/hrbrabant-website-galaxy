<?php

namespace Database\Seeders;

use Galaxy\Admin\Models\User;
use Galaxy\Core\Services\AvatarGenerator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function run(): void
    {
        $password = Str::random(12);

        // Add default user.
        $user = User::create([
            'name' => 'Laveto',
            'email' => 'info@laveto.nl',
            'password' => Hash::make($password),
        ]);

        // Create avatar.
        AvatarGenerator::forModel($user);
    }
}
