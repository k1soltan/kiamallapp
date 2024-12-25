<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\User;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;





class EventTicketController extends Controller
{
    public function show($id)
    {
        $event = Event::with('tickets')->findOrFail($id);
        $tickets = $event->tickets;

        return view('admin.events.show', compact('event', 'tickets'));
    }

    public function book(Request $request, Event $event)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::create([
            'event_id' => $event->id,
            'user_id' => $validated['user_id'],
            'quantity' => $validated['quantity'],
            'status' => 'reserved',
        ]);

        return redirect()->route('admin.tickets.reserved')->with('success', 'Ticket reserved successfully!');
    }

    public function showTickets($id)
    {
        $event = Event::with('tickets')->findOrFail($id);
        $tickets = $event->tickets;

        return view('admin.tickets.show', compact('tickets'));
    }

    public function showBookingForm(Event $event)
    {
        $users = User::all();
        return view('admin.events.book', compact('event', 'users'));
    }

    public function reservedTickets()
    {
        $tickets = Ticket::where('status', 'reserved')->with('event', 'user')->get();

        return view('admin.tickets.reserved', compact('tickets'));
    }

    public function confirmTicket(Ticket $ticket)
    {
        $ticket->update(['status' => 'confirmed']);

        return redirect()->route('admin.tickets.reserved')->with('success', 'Ticket confirmed successfully!');
    }

    public function confirm($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'confirmed';
        $ticket->save();

        return redirect()->route('admin.tickets.reserved')->with('success', 'Ticket confirmed successfully!');
    }

    public function declineTicket(Ticket $ticket)
    {
        $ticket->update(['status' => 'declined']);
        return redirect()->route('admin.tickets.reserved')->with('success', 'Ticket declined successfully.');
    }

    public function deleteTicket(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('admin.tickets.reserved')->with('success', 'Ticket deleted successfully.');
    }



public function generateTicketQrCode($ticketId)
{
    $ticket = Ticket::with(['event', 'user'])->findOrFail($ticketId);

    $qrCode = new QrCode(
        "Ticket ID: {$ticket->id}\nEvent: {$ticket->event->title}\nUser: {$ticket->user->name}\nQuantity: {$ticket->quantity}"
    );
    $qrCode->setEncoding(new Encoding('UTF-8'));

    $writer = new PngWriter();
    $result = $writer->write($qrCode);

    return response($result->getString())
        ->header('Content-Type', $result->getMimeType());
}


    public function userTickets()
    {
        $userId = Auth::id();
        if (is_null($userId)) {
            abort(403, 'Unauthorized action.');
        }

        $tickets = Ticket::with('event')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tickets.index', compact('tickets'));
    }

    public function downloadPdf(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $qrCode = new QrCode(
            "Ticket ID: {$ticket->id}\nEvent: {$ticket->event->title}\nUser: {$ticket->user->name}\nQuantity: {$ticket->quantity}"
        );
        $qrCode->setEncoding(new Encoding('UTF-8'));

        $writer = new PngWriter();
        $qrCodeImage = $writer->write($qrCode);

        $qrCodeBase64 = 'data:' . $qrCodeImage->getMimeType() . ';base64,' . base64_encode($qrCodeImage->getString());

        $pdf = Pdf::loadView('tickets.pdf', [
            'ticket' => $ticket,
            'qrCodeBase64' => $qrCodeBase64,
        ]);

        return $pdf->download("ticket-{$ticket->id}.pdf");
    }
    public function create()
    {
        $events = Event::all();
        $users = User::all();

        return view('admin.tickets.create', compact('events', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,booked,cancelled',
        ]);

        Ticket::create($validated);

        return redirect()->route('tickets.reserved')->with('success', 'Ticket created successfully!');
    }

    public function showTicket(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('tickets.show', compact('ticket'));
    }
}
