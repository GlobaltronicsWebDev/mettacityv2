<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'visit_date' => 'required|date|after:today',
            ]);

            // Set default values for optional fields
            $validated['email'] = null;
            $validated['number_of_guests'] = 1;
            $validated['message'] = null;

            $booking = Booking::create($validated);

            // Send SMS notification
            $this->sendSMS($booking);

            return redirect()->route('visit')->with('success', 'Your booking has been submitted! You will receive a confirmation SMS shortly.');
        } catch (\Exception $e) {
            \Log::error('Booking error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'There was an error processing your booking. Please try again.'])->withInput();
        }
    }

    private function sendSMS($booking)
    {
        // Using Semaphore SMS API (Philippine SMS provider)
        // You can replace this with your preferred SMS provider
        
        $apiKey = env('SEMAPHORE_API_KEY', ''); // Add your API key in .env
        
        if (empty($apiKey)) {
            // Skip SMS if no API key configured
            return;
        }

        $message = "Hello {$booking->name}! Your booking at Mettacity for {$booking->visit_date->format('M d, Y')} has been received. We'll confirm your reservation soon. Thank you!";

        try {
            Http::post('https://api.semaphore.co/api/v4/messages', [
                'apikey' => $apiKey,
                'number' => $booking->phone,
                'message' => $message,
                'sendername' => 'METTACITY'
            ]);
        } catch (\Exception $e) {
            // Log error but don't fail the booking
            \Log::error('SMS sending failed: ' . $e->getMessage());
        }
    }
}
