@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Заявка #{{ $ticket->id }}</h1>
        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">← Назад к списку</a>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Информация о заявке</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="200">Тема:</th>
                            <td>{{ $ticket->subject }}</td>
                        </tr>
                        <tr>
                            <th>Текст:</th>
                            <td>{{ $ticket->text }}</td>
                        </tr>
                        <tr>
                            <th>Статус:</th>
                            <td>
                                <span class="badge bg-{{ 
                                    $ticket->status == 'Новый' ? 'warning' : 
                                    ($ticket->status == 'В работе' ? 'info' : 'success') 
                                }}">
                                    {{ $ticket->status }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Дата создания:</th>
                            <td>{{ $ticket->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Дата ответа:</th>
                            <td>{{ $ticket->response_date ? $ticket->response_date->format('d.m.Y H:i') : '—' }}</td>
                        </tr>
                        <tr>
                            <th>Менеджер:</th>
                            <td>{{ $ticket->manager ? $ticket->manager->name : 'Не назначен' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Информация о клиенте</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="200">Имя:</th>
                            <td>{{ $ticket->customer->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $ticket->customer->email }}</td>
                        </tr>
                        <tr>
                            <th>Телефон:</th>
                            <td>{{ $ticket->customer->phone }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Смена статуса</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tickets.updateStatus', $ticket) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Новый статус</label>
                            <select name="status" class="form-select">
                                <option value="Новый" {{ $ticket->status == 'Новый' ? 'selected' : '' }}>Новый</option>
                                <option value="В работе" {{ $ticket->status == 'В работе' ? 'selected' : '' }}>В работе</option>
                                <option value="Обработан" {{ $ticket->status == 'Обработан' ? 'selected' : '' }}>Обработан</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Обновить статус</button>
                    </form>
                </div>
            </div>
            
            @if($ticket->media->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Прикрепленные файлы</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($ticket->media as $file)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $file->file_name }}</span>
                            <a href="{{ $file->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                Скачать
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection