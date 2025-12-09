@extends('layouts.base')

@section('body')
<div class="min-h-screen flex flex-col items-center justify-center px-4 relative overflow-hidden">
    <!-- Декоративный фон -->
    <div class="absolute inset-0 -z-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100 dark:bg-blue-900/20 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-100 dark:bg-purple-900/20 rounded-full blur-3xl opacity-50"></div>
    </div>

    <div class="w-full max-w-md">
        <!-- Логотип и заголовок -->
        <div class="text-center mb-8 starting:translate-y-6 starting:opacity-0 transition-all duration-750 delay-300">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">CRM System</h1>
            <p class="text-[#706f6c] dark:text-[#A1A09A]">Вход в административную панель</p>
        </div>

        <!-- Карточка формы -->
        <div class="bg-white dark:bg-[#161615] rounded-2xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-xl p-8 starting:translate-y-4 starting:opacity-0 transition-all duration-750">
            @if($errors->any())
                <div class="mb-6 p-4 bg-[#fff2f2] dark:bg-[#1D0002] border border-[#F53003]/20 dark:border-[#F61500]/20 rounded-xl starting:opacity-0 transition-opacity duration-750">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-[#F53003] dark:text-[#FF4433] mr-3 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-[#F53003] dark:text-[#FF4433] text-sm font-medium">{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Поле Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                        Email адрес
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-[#706f6c] dark:text-[#A1A09A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               required 
                               autofocus
                               class="w-full pl-10 pr-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FDFDFC] dark:bg-[#1b1b18] text-[#1b1b18] dark:text-[#EDEDEC] rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-[#706f6c] dark:placeholder-[#A1A09A]"
                               placeholder="admin@gmail.com">
                    </div>
                </div>

                <!-- Поле Пароль -->
                <div>
                    <label for="password" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                        Пароль
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-[#706f6c] dark:text-[#A1A09A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               class="w-full pl-10 pr-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FDFDFC] dark:bg-[#1b1b18] text-[#1b1b18] dark:text-[#EDEDEC] rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-[#706f6c] dark:placeholder-[#A1A09A]"
                               placeholder="••••••••">
                    </div>
                </div>

                <!-- Кнопка входа -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-[#161615] shadow-lg hover:shadow-xl">
                    Войти в систему
                </button>
            </form>

            <!-- Тестовые пользователи -->
            <div class="mt-8 pt-6 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                <h3 class="text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-4 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                    Тестовые пользователи
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between bg-[#dbdbd7] dark:bg-[#1b1b18] p-4 rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] hover:border-blue-500 dark:hover:border-blue-500 transition-all group">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-red-500 rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                                A
                            </div>
                            <div>
                                <div class="font-semibold text-[#1b1b18] dark:text-[#EDEDEC] text-sm">Администратор</div>
                                <div class="text-xs text-[#706f6c] dark:text-[#A1A09A]">admin@gmail.com / password</div>
                            </div>
                        </div>
                        <a href="/auto-login/admin@gmail.com" 
                           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-all group-hover:scale-105">
                            Войти
                        </a>
                    </div>
                    
                    <div class="flex items-center justify-between bg-[#dbdbd7] dark:bg-[#1b1b18] p-4 rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] hover:border-blue-500 dark:hover:border-blue-500 transition-all group">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-teal-500 rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                                M
                            </div>
                            <div>
                                <div class="font-semibold text-[#1b1b18] dark:text-[#EDEDEC] text-sm">Менеджер</div>
                                <div class="text-xs text-[#706f6c] dark:text-[#A1A09A]">manager@gmail.com / password</div>
                            </div>
                        </div>
                        <a href="/auto-login/manager@gmail.com" 
                           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-all group-hover:scale-105">
                            Войти
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-6 text-center text-sm text-[#706f6c] dark:text-[#A1A09A] starting:opacity-0 transition-opacity duration-750 delay-300">
            <p>© 2024 CRM System. Все права защищены.</p>
        </div>
    </div>
</div>
@endsection