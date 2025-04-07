<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            // Step 1: Create Account
            $account = Account::factory()->create();

            // Step 2: Create User linked to Account (using the relationship)
            $account->user()->create(User::factory()->make()->toArray());
        }
    }
}
