<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Ichiro',
                'email' => 'ichiro@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => '2',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'name' => 'Hanabi',
                'email' => 'hanabi@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => '1',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'name' => 'Atsu',
                'email' => 'atsu@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => '2',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ]
        ];
        
        $this->user->insert($users);
    }
}
