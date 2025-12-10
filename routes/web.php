<?php

use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Главная страница
Route::get('/', function () {
    return redirect('/admin/tickets');
});

// Виджет
Route::get('/widget', function () {
    return view('widget.form');
})->name('widget.form');

// Маршруты аутентификации
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin/tickets');
    }

    return back()->withErrors([
        'email' => 'Неверные учетные данные.',
    ])->onlyInput('email');
});
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Для быстрого входа
Route::get('/auto-login/{email}', function ($email) {
    $user = \App\Models\User::where('email', $email)->first();
    
    if ($user) {
        Auth::login($user);
        return redirect('/admin/tickets');
    }
    
    return 'Пользователь не найден';
});
// Админка - только auth
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/tickets', [AdminTicketController::class, 'index'])
        ->name('admin.tickets.index');
    
    Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])
        ->name('admin.tickets.show');
    
    Route::put('/tickets/{ticket}/status', [AdminTicketController::class, 'updateStatus'])
        ->name('admin.tickets.updateStatus');
});
Route::get('/download/{mediaId}', [AdminTicketController::class, 'download'])->name('file.download');