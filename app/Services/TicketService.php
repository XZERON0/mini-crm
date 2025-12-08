<?php
namespace App\Services;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class TicketService
{
    public function __construct(protected TicketRepository $repository) {}

    public function createTicket(array $data): Ticket
    {
        return $this->repository->create($data);
    }

    public function getTicket(int $id): ?Ticket
    {
        return $this->repository->find($id);
    }

    public function updateTicket(Ticket $ticket, array $data): bool
    {
        return $this->repository->update($ticket, $data);
    }

    public function deleteTicket(Ticket $ticket): bool
    {
        return $this->repository->delete($ticket);
    }

    public function getFilteredTickets(array $filters = []): LengthAwarePaginator
    {
        return $this->repository->getFiltered($filters);
    }

    public function getStatistics(string $period): array
    {
        return $this->repository->getStatistics($period);
    }

    public function canCreateTicket(string $email, string $phone): bool
    {
        $countToday = $this->repository->countTodayByEmailOrPhone($email, $phone);
        return $countToday < 1; 
    }
}