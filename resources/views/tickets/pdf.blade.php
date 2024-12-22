<!DOCTYPE html>
<html>
<head>
    <title>Ticket Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
        img {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Ticket Details</h1>
    <p><strong>Ticket ID:</strong> {{ $ticket->id }}</p>
    <p><strong>Event:</strong> {{ $ticket->event->title }}</p>
    <p><strong>User:</strong> {{ $ticket->user->name }}</p>
    <p><strong>Quantity:</strong> {{ $ticket->quantity }}</p>
    <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
    <p><strong>Created At:</strong> {{ $ticket->created_at }}</p>

    <div class="qr-code">
        <strong>Ticket QR Code:</strong><br>
        <img src="{{ $qrCodeBase64 }}" alt="QR Code">
    </div>
</body>
</html>
