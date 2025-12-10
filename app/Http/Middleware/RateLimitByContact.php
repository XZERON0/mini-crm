<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RateLimitByContact
{
    public function handle(Request $request, Closure $next)
    {
        $email = $request->input('email');
        $phone = $request->input('phone');

        // Проверяем по email
        if ($email) {
            $recentTicket = Ticket::where('email', $email)
                ->where('created_at', '>', Carbon::now()->subDay())
                ->exists();
            
            if ($recentTicket) {
                return response()->json([
                    'error' => 'Вы можете отправить только одну заявку в сутки'
                ], 429);
            }
        }

        // Проверяем по телефону (если указан)
        if ($phone) {
            $recentTicket = Ticket::where('phone', $phone)
                ->where('created_at', '>', Carbon::now()->subDay())
                ->exists();
            
            if ($recentTicket) {
                return response()->json([
                    'error' => 'Вы можете отправить только одну заявку в сутки'
                ], 429);
            }
        }

        return $next($request);
    }
}