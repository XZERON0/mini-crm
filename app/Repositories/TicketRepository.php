<?php
namespace App\Repositories;
use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
class TicketRepository
{
    public function __construct(protected Ticket $model) {}

    public function create(array $data): Ticket
    {
        return $this->model->create($data);
    }

    public function find(int $id): ?Ticket
    {
        return $this->model->find($id);
    }

    public function update(Ticket $ticket, array $data): bool
    {
        return $ticket->update($data);
    }

    public function delete(Ticket $ticket): bool
    {
        return $ticket->delete();
    }

    public function getFiltered(array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->with(['customer', 'manager']);

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['email'])) {
            $query->whereHas('customer', function ($q) use ($filters) {
                $q->where('email', 'like', "%{$filters['email']}%");
            });
        }

        if (!empty($filters['phone'])) {
            $query->whereHas('customer', function ($q) use ($filters) {
                $q->where('phone', 'like', "%{$filters['phone']}%");
            });
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }
        if (!empty($filters['manager_id']))
            {
                $query->where('manager_id', $filters['manager_id']);
            }

        return $query->orderBy('created_at', 'desc')->paginate(20);
    }

    public function getStatistics(string $period): array
    {
        $total = $this->model->createdInPeriod($period)->count();
        $byStatus = $this->model->createdInPeriod($period)
        ->selectRaw('status, count(*) as count')
        ->groupBy('status')
        ->pluck('count', 'status')
        ->toArray();

        return [
            'period' => $period,
            'total' => $total,
            'by_status' => $byStatus,
        ];
    }

    public function countTodayByEmailOrPhone(string $email, string $phone): int
    {
        return $this->model->whereDate('created_at', Carbon::today())
            ->whereHas('customer', function ($query) use ($email, $phone) {
                $query->where('email', $email)
                      ->orWhere('phone', $phone);
            })
            ->count();
    }
}