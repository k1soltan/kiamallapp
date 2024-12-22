<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\Event;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\BinaryWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Font\NotoSans;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar');
    }

    /**
     * Fetch events from the database and convert dates to Jalali for the response.
     * Add QR code URL for each event.
     */
    public function fetchEvents(Request $request)
    {
        $type = $request->type ?? 'event';

        // Fetch events based on type and map them to include Jalali dates and QR code URLs
    $events = Event::where('type', $type)->get()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => Jalalian::fromDateTime($event->start)->format('Y/m/d H:i'),
                'end' => $event->end ? Jalalian::fromDateTime($event->end)->format('Y/m/d H:i') : null,
                'type' => $event->type,
                'qr_code_url' => route('admin.calendar.qrCode', ['id' => $event->id]),
            ];
        });

        return response()->json($events);
    }

    /**
     * Store a new event, converting Jalali dates to Gregorian before saving.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
            'type' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'tickets_available' => 'required|boolean',
            'quantity' => 'required|integer|min:1',
        ]);
    
        try {
            // Create the event
            Event::create($validated);
    
            // Redirect to events index with success message
            return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error($e->getMessage());
    
            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while creating the event.');
        }
    }

    /**
     * Update an existing event with new dates, converting Jalali to Gregorian.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:events,id',
            'start' => 'required|string', // Expect Jalali date from frontend
            'end' => 'nullable|string', // Expect Jalali date from frontend
        ]);

        // Find the event
        $event = Event::findOrFail($validated['id']);

        // Convert Jalali dates to Gregorian
        $event->start = CalendarUtils::createCarbonFromFormat('Y-m-d H:i', $validated['start']);
        $event->end = $validated['end'] ? CalendarUtils::createCarbonFromFormat('Y-m-d H:i', $validated['end']) : null;

        // Save updated event
        $event->save();

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully.',
            'event' => $event,
        ]);
    }

    /**
     * Generate a QR code for the specified event.
     */
    

     
     public function generateQrCode($id)
     {
         // Find the event
         $event = Event::findOrFail($id);
         
     
         // Create a new QR code instance with UTF-8 encoding
         $qrCode = new QrCode(
             "Event ID: {$event->id}\nTitle: {$event->title}\nStart: {$event->start}",
             new Encoding('UTF-8') // Specify the encoding
         );
     
         // Use PngWriter to generate the QR code as a PNG image
         $writer = new PngWriter();
         $result = $writer->write($qrCode);
     
         // Return the QR code image as a response
         return response($result->getString())
             ->header('Content-Type', $result->getMimeType()); // Specify the correct MIME type
     }
     public function showEvents()
     {
           // Fetch all events with the count of related tickets
    $events = Event::withCount('tickets')->get();

    // Pass events to the view
    return view('admin.events.index', compact('events'));
    }
    public function create()
{
    return view('admin.events.create');
}


    
    
    
}