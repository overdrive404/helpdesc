<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Ticket;
use App\Models\TicketEvent;
use App\Enums\TicketPriority;
use App\Enums\TicketStatus;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@demo',
        ],
            [
                'password' => Hash::make('password')
            ]);

        User::firstOrCreate([
            'name' => 'Agent',
            'email' => 'agent@demo'],
            [
                'password' => Hash::make('password'),
            ]);

        $user = User::firstOrCreate([
            'name' => 'User',
            'email' => 'user@demo'
        ], [
            'password' => Hash::make('password'),
        ]);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'Не работает авторизация',
            'description' => 'Пишет "invalid credentials" при вводе правильного пароля',
            'status' => TicketStatus::OPEN,
            'priority' => TicketPriority::HIGH,
        ]);

        TicketEvent::create([
            'ticket_id' => $ticket->id,
            'user_id' => $admin->id,
            'type' => 'comment_added',
            'message' => 'Проверим логирование ошибок',
        ]);
    }
}
