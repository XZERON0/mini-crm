<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Customer;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class TicketController extends Controller
{
    public function __construct(protected TicketService $ticketService)
    {
    }
    public function store(StoreTicketRequest $request): JsonResponse
    {
        // Отладка
        Log::info('Store ticket request:', [
            'has_files' => $request->hasFile('files'),
            'files_count' => $request->hasFile('files') ? count($request->file('files')) : 0,
            'all_files' => $request->file('files'),
            'all_data' => $request->all(),
        ]);
        if (
            !$this->ticketService->canCreateTicket(
                $request->input('customer.email'),
                $request->input('customer.phone')
            )
        ) {
            return response()->json([
                'message' => 'Вы можете отправить только одну заявку в сутки с одного email или телефона.'
            ], 422);
        }

        return DB::transaction(function () use ($request) {
            $customer = Customer::firstOrCreate(
                [
                    'phone' => $request->input('customer.phone'),
                    'email' => $request->input('customer.email'),
                ],
                [
                    'name' => $request->input('customer.name'),
                ]
            );
            $ticket = $this->ticketService->createTicket([
                'customer_id' => $customer->id,
                'subject' => $request->input('subject'),
                'text' => $request->input('text'),
            ]);
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $ticket->addMedia($file)->toMediaCollection('ticket_files');
                }
            }

            return response()->json([
                'message' => 'Заявка успешно создана.',
                'data' => new TicketResource($ticket->load('customer', 'media'))
            ], 201);
        });
    }

    public function statistics(Request $request): JsonResponse
    {
        $period = $request->get('period', 'day');
        $stats = $this->ticketService->getStatistics($period);

        return response()->json($stats);
    }
}