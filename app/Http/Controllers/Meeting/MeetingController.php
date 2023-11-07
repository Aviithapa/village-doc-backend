<?php

namespace App\Http\Controllers\Meeting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class MeetingController extends Controller
{
    //
    public function create()
    {
        // Authenticate with Google using Laravel Socialite
        $client = Socialite::driver('google')->stateless()->user();

        // Initialize the Google Calendar API client
        $googleClient = new Google_Client();
        $googleClient->setAuthConfig('path-to-client-secret-json'); // Replace with the actual path to your client secret JSON file
        $googleClient->setAccessToken($client->token);
        $calendarService = new Google_Service_Calendar($googleClient);

        // Create a new Google Calendar event with a Google Meet link
        $event = new Google_Service_Calendar_Event([
            'summary' => 'Meeting Title',
            'description' => 'Meeting Description',
            'start' => ['dateTime' => '2023-01-01T08:00:00Z'],
            'end' => ['dateTime' => '2023-01-01T09:00:00Z'],
            'conferenceData' => [
                'createRequest' => [
                    'conferenceSolutionKey' => ['type' => 'hangoutsMeet'],
                ],
            ],
        ]);

        $calendarId = 'primary'; // The primary calendar of the authenticated user
        $event = $calendarService->events->insert($calendarId, $event, ['conferenceDataVersion' => 1]);

        $meetLink = $event->getHangoutLink(); // Google Meet link

        return redirect($meetLink);
    }
}
