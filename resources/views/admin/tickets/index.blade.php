@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tickets for Event: {{ $event->title }}</h1>

    @if ($tickets->isEmpty())
        <p>No tickets found for this event.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->user_id }}</td>
                        <td>{{ $ticket->quantity }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ $ticket->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Back to Events</a>
</div>
@endsection
