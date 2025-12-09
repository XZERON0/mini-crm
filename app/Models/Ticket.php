<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'subject',
        'text',
        'status',
        'manager_id',
        'customer_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('ticket_files')
            ->useDisk('public')
            ->withResponsiveImages();
    }

    public function scopeCreatedInPeriod($query, $period)
    {
        $now = now();
        return match ($period) {
            'day' => $query->whereDate('created_at', $now->toDateString()),
            'week' => $query->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()]),
            'month' => $query->whereBetween('created_at', [$now->startOfMonth(), $now->endOfMonth()]),
            default => $query,
        };
    }
}