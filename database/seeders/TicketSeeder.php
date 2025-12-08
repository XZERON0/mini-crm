<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Customer;
class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = User::factory()->create();
        $manager->assignRole('manager');
        $customers = Customer::factory()->count(50)->create();
        Ticket::factory()->count(20)->make()->each(function ($ticket) use ($manager, $customers) {
            $ticket->manager_id = $manager->id;
            $ticket->customer_id = $customers->random()->id;
            $ticket->save();
        });
    }

}
