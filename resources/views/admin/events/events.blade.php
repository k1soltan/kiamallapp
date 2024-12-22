@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Events</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Start</th>
                <th>End</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->start }}</td>
                <td>{{ $event->end }}</td>
                <td>{{ $event->type }}</td>
                <td>
                    <a href="{{ $event->qr_code_url }}" class="btn btn-primary">QR Code</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
