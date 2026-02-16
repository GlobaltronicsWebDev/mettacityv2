# SMS Notification Setup Guide

## Overview
The booking system is configured to send SMS notifications to users when they make a booking. This uses the Semaphore SMS API (Philippine SMS provider).

## Setup Instructions

### 1. Get Semaphore API Key

1. Go to [https://semaphore.co](https://semaphore.co)
2. Sign up for an account
3. Purchase SMS credits
4. Get your API key from the dashboard

### 2. Add API Key to .env File

Open your `.env` file and add:

```env
SEMAPHORE_API_KEY=your_api_key_here
```

### 3. SMS Message Format

When a user books, they receive:

```
Hello [Name]! Your booking at Mettacity for [Date] has been received. We'll confirm your reservation soon. Thank you!
```

## Alternative SMS Providers

If you want to use a different SMS provider, edit `app/Http/Controllers/BookingController.php`:

### Twilio (International)
```php
use Twilio\Rest\Client;

private function sendSMS($booking)
{
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_TOKEN');
    $from = env('TWILIO_FROM');
    
    $client = new Client($sid, $token);
    
    $client->messages->create(
        $booking->phone,
        [
            'from' => $from,
            'body' => "Hello {$booking->name}! Your booking at Mettacity for {$booking->visit_date->format('M d, Y')} has been received."
        ]
    );
}
```

### Vonage/Nexmo
```php
use Vonage\Client;
use Vonage\Client\Credentials\Basic;

private function sendSMS($booking)
{
    $basic = new Basic(env('VONAGE_KEY'), env('VONAGE_SECRET'));
    $client = new Client($basic);
    
    $client->sms()->send(
        new \Vonage\SMS\Message\SMS(
            $booking->phone,
            'METTACITY',
            "Hello {$booking->name}! Your booking has been received."
        )
    );
}
```

## Testing Without SMS

If you don't want to set up SMS immediately, the system will work fine without it. Bookings will still be saved and visible in the admin dashboard. The SMS sending will be skipped if no API key is configured.

## Phone Number Format

The form automatically adds +63 prefix for Philippine numbers. Users only need to enter their 10-digit mobile number (e.g., 9171234567).

The system stores it as: +639171234567

## Troubleshooting

**SMS not sending?**
- Check if SEMAPHORE_API_KEY is set in .env
- Verify you have SMS credits
- Check Laravel logs: `storage/logs/laravel.log`

**Wrong phone format?**
- Ensure phone numbers start with +63
- Remove any spaces or dashes

## Cost Estimate

Semaphore SMS pricing (as of 2024):
- ₱0.50 - ₱1.00 per SMS (depending on volume)
- Minimum load: ₱100

For 100 bookings/month = approximately ₱50-100/month
