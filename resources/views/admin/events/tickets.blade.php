@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tickets for {{ $event->title }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Ticket Code</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($event->tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->code }}</td>
                <td>{{ $ticket->price }}</td>
                <td>{{ $ticket->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <td>
        <a href="{{ route('tickets.qrCode', $ticket->id) }}" class="btn btn-primary">View QR Code</a>
        <form action="{{ route('tickets.book', $ticket->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-success">Book</button>
        </form>
    </td>
    
</div>
@endsection
