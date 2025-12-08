@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Заявки</h1>
    
    <form method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="email" class="form-control" placeholder="Email клиента" value="{{ request('email') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="phone" class="form-control" placeholder="Телефон" value="{{ request('phone') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-control">
                    <option value="">Все статусы</option>
                    <option value="Новый" {{ request('status') == 'Новый' ? 'selected' : '' }}>Новый</option>
                    <option value="В работе" {{ request('status') == 'В работе' ? 'selected' : '' }}>В работе</option>
                    <option value="Обработан" {{ request('status') == 'Обработан' ? 'selected' : '' }}>Обработан</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Фильтр</button>
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">Сбросить</a>
            </div>
        </div>
    </form>

    @if($tickets->isEmpty())
        <div class="alert alert-info">Заявки не найдены</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Клиент</th>
                    <th>Тема</th>
                    <th>Статус</th>
                    <th>Дата создания</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>
                        <strong>{{ $ticket->customer->name }}</strong><br>
                        <small>{{ $ticket->customer->email }}</small><br>
                        <small>{{ $ticket->customer->phone }}</small>
                    </td>
                    <td>{{ $ticket->subject }}</td>
                    <td>
                        @php
                            $badgeClass = match($ticket->status) {
                                'Новый' => 'bg-warning',
                                'В работе' => 'bg-info',
                                'Обработан' => 'bg-success',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">
                            {{ $ticket->status }}
                        </span>
                    </td>
                    <td>{{ $ticket->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-sm btn-info">Просмотр</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $tickets->links() }}
    @endif
</div>
@endsection