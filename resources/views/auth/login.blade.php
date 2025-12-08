<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в CRM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; height: 100vh; display: flex; align-items: center; }
        .login-container { max-width: 400px; margin: 0 auto; }
        .card { border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="card">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Вход в CRM</h2>
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email') }}" required autofocus>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="password" 
                                   name="password" required>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Войти</button>
                        </div>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <p class="text-muted mb-0">Тестовые пользователи:</p>
                        <p class="mb-1"><strong>Админ:</strong> admin@gmail.com / password</p>
                        <p class="mb-0"><strong>Менеджер:</strong> manager@gmail.com / password</p>
                        <p class="mt-2">
                            <a href="/auto-login/admin@gmail.com" class="btn btn-sm btn-outline-primary">Автовход (Админ)</a>
                            <a href="/auto-login/manager@gmail.com" class="btn btn-sm btn-outline-secondary">Автовход (Менеджер)</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>