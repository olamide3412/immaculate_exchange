<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function handleIncomingMessage(Request $request) {
        // Log incoming request (for debugging)
        Log::info('Incoming WhatsApp Message:', $request->all());

        // Verify Twilio/Service signature (if required)
        // Process message
        $senderNumber = $request->input('From'); // e.g., 'whatsapp:+1234567890'
        $messageBody = $request->input('Body');  // User's message

        // Generate a response based on the message
        $responseText = $this->getResponse($messageBody);

        // Send response back via WhatsApp API
        $this->sendMessage($senderNumber, $responseText);

        return response('OK', 200);
    }

    private function getResponse($message) {
        $message = strtolower($message);

        if (strpos($message, 'hello') !== false) {
            return "Hi! How can we assist you today?";
        } elseif ($message == 'menu') {
            return "Our menu:\n1. Pizza\n2. Burgers\n3. Drinks";
        } else {
            return "Sorry, I didn't understand that. Type 'menu' for options.";
        }
    }

    private function sendMessage($to, $body) {
        $accountSid = env('TWILIO_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_WHATSAPP_NUMBER');

        $client = new Client($accountSid, $authToken);

        return $client->messages->create(
            $to,
            [
                'from' => $twilioNumber,
                'body' => $body
            ]
        );
    }
}
