@extends('layouts.admin')

@section('title', 'Заявка #' . $ticket->id . ' - CRM System')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.tickets.index') }}" 
       class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Назад к списку заявок
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Основная информация -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Карточка заявки -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Заявка #{{ $ticket->id }}</h1>
                    <div class="mt-2 flex items-center space-x-4">
                        @php
                            $statusColors = [
                                'Новый' => 'bg-yellow-100 text-yellow-800',
                                'В работе' => 'bg-blue-100 text-blue-800',
                                'Обработан' => 'bg-green-100 text-green-800',
                            ];
                            $color = $statusColors[$ticket->status] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span class="px-3 py-1 text-sm font-medium rounded-full {{ $color }}">
                            {{ $ticket->status }}
                        </span>
                        <span class="text-sm text-gray-500">
                            {{ $ticket->created_at->format('d.m.Y в H:i') }}
                        </span>
                    </div>
                </div>
                
                @if($ticket->manager)
                <div class="text-right">
                    <div class="text-sm text-gray-500">Ответственный</div>
                    <div class="font-medium text-gray-900">{{ $ticket->manager->name }}</div>
                </div>
                @endif
            </div>

            <!-- Тема и текст -->
            <div class="space-y-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Тема</h3>
                    <p class="text-gray-700">{{ $ticket->subject }}</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Сообщение</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700 whitespace-pre-line">{{ $ticket->text }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Карточка клиента -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Информация о клиенте</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <div class="text-sm text-gray-500 mb-1">Имя</div>
                    <div class="font-medium text-gray-900">{{ $ticket->customer->name }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500 mb-1">Email</div>
                    <div class="font-medium text-gray-900">{{ $ticket->customer->email }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500 mb-1">Телефон</div>
                    <div class="font-medium text-gray-900">{{ $ticket->customer->phone }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Боковая панель -->
    <div class="space-y-6">
        <!-- Смена статуса -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Изменить статус</h3>
            <form action="{{ route('admin.tickets.updateStatus', $ticket) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <select name="status" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="Новый" {{ $ticket->status == 'Новый' ? 'selected' : '' }}>Новый</option>
                        <option value="В работе" {{ $ticket->status == 'В работе' ? 'selected' : '' }}>В работе</option>
                        <option value="Обработан" {{ $ticket->status == 'Обработан' ? 'selected' : '' }}>Обработан</option>
                    </select>
                </div>
                
                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Обновить статус
                </button>
            </form>
            
            <!-- Дата ответа -->
            @if($ticket->response_date)
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="text-sm text-gray-500">Дата ответа</div>
                <div class="font-medium text-gray-900">
                    {{ $ticket->response_date->format('d.m.Y в H:i') }}
                </div>
            </div>
            @endif
        </div>

        <!-- Прикрепленные файлы -->
        @if($ticket->media->count() > 0)
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Прикрепленные файлы</h3>
            <div class="space-y-3">
                @foreach($ticket->media as $file)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center">
                        <div class="mr-3">
                            @php
                                $icon = match($file->mime_type) {
                                    'image/jpeg', 'image/png', 'image/gif' => 'image',
                                    'application/pdf' => 'pdf',
                                    'text/plain' => 'document',
                                    default => 'file'
                                };
                            @endphp
                            @if($icon === 'image')
                            <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                            </svg>
                            @elseif($icon === 'pdf')
                            <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                            </svg>
                            @else
                            <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                            </svg>
                            @endif
                        </div>
                        <div>
                            <div class="font-medium text-gray-900 text-sm truncate max-w-xs">
                                {{ $file->file_name }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ number_format($file->size / 1024, 1) }} KB
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('file.download', ['mediaId'=>$file->id]) }}" 
                       target="_blank"
                       class="text-blue-600 hover:text-blue-800 font-medium text-sm whitespace-nowrap">
                        Скачать
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection