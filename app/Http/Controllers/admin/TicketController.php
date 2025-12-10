<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Services\TicketService;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class TicketController extends Controller
{
    public function __construct(protected TicketService $ticketService)
    {
    }
    private function checkAdminAccess()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        if (!$user->hasAnyRole(['admin', 'manager'])) {
            abort(403, 'Доступ запрещен. Требуется роль администратора или менеджера.');
        }
    }
    public function index(Request $request)
    {
        $this->checkAdminAccess();

        $tickets = $this->ticketService->getFilteredTickets($request->all());
        return view('admin.tickets.index', compact('tickets'));
    }
    public function show(Ticket $ticket)
    {
        $this->checkAdminAccess();

        $ticket->load(['customer', 'manager', 'media']);
        return view('admin.tickets.show', compact('ticket'));
    }
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $this->checkAdminAccess();

        $request->validate(['status' => 'required|in:Новый,В работе,Обработан']);

        $this->ticketService->updateTicket($ticket, [
            'status' => $request->status,
            'response_date' => now(),
        ]);
        return back()->with('success', 'Статус обновлён.');
    }
    public function download($mediaId)
    {
        $this->checkAdminAccess();

        $media = Media::findOrFail($mediaId);

        if ($media->model_type !== Ticket::class) {
            abort(403, 'Доступ запрещен');
        }

        return response()->download($media->getPath(), $media->file_name);
    }
}