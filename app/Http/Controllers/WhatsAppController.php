<?php

namespace App\Http\Controllers;

use App\Enums\MatchTypeEnums;
use App\Models\WhatsAppResponse;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Enum;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Cache;

class WhatsAppController extends Controller
{

    public function index(Request $request){
        $orderBy = request('orderBy', 'id');
        $orderDir = request('orderDir', 'asc');

        $whatsAppResponses = WhatsAppResponse::when($request->search, function($query) use($request){
            $query->where('name','like', '%'.$request->search.'%')
            ->orwhereJsonContains('triggers','like', '%'.$request->search.'%')
            ->orWhere('response','like', '%'.$request->search.'%');
        })->orderBy($orderBy, $orderDir)->paginate(5)->withQueryString();

        //dd($whatsAppResponses);
        return inertia('Auth/WhatsAppResponses/Index', [
            'whatsAppResponses' => $whatsAppResponses
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name'     => ['required','max:255'],
            'match_type' => ['required', new Enum(MatchTypeEnums::class)],
            'triggers' => ['required','array'],
            'response' => ['required', 'string']
        ]);


        //$validatedData['triggers'] = json_encode($validatedData['triggers']);
        $validatedData['triggers'] = json_encode(array_map('strtolower', $validatedData['triggers']));
        dd($validatedData);
        $whatsAppResponse = WhatsAppResponse::create($validatedData);
        log_new("Whatsapp response created name: " .$whatsAppResponse->name);
        return back()->with('message','New whatsapp chat response created');
    }

    public function show(WhatsAppResponse $whatsAppResponse){

        return inertia('Auth/WhatsAppResponses/Show',[
            'whatsAppResponse' => $whatsAppResponse
        ]);
    }

    public function update(Request $request, WhatsAppResponse $whatsAppResponse){
        $validatedData = $request->validate([
            'name'     => ['required','max:255'],
            'triggers' => ['required','array'],
            'response' => ['required', 'string'],
            'is_active' => ['required', 'boolean'],
            'match_type' => ['required', new Enum(MatchTypeEnums::class)]
        ]);

        $validatedData['triggers'] = json_encode(array_map('strtolower', $validatedData['triggers']));
        $whatsAppResponse->update($validatedData);
         log_new("Whatsapp response updated name: " .$whatsAppResponse->name);
        return back()->with('message','Whatsapp chat response update');
    }
    public function destroy(WhatsAppResponse $whatsAppResponse){
        log_new("Whatsapp response deleting name: " .$whatsAppResponse->name);
        $whatsAppResponse->delete();
        return redirect(route('whatsAppResponse.index'))->with('message','Whatsapp chat response deleted');
    }





    public function receiveWebhook(Request $request)
    {
        try {
            // Log incoming request (for debugging)
            Log::info('Incoming WhatsApp Message:', $request->all());


            // Validate webhook structure
            if (!$request->has('entry.0.changes.0.value.messages.0')) {
                Log::warning('Invalid webhook format - no message found');
                return response()->json(['status' => 'ignored - no message']);
            }

            // Extract message data safely
            $messageData = $request->input('entry.0.changes.0.value.messages.0');
            $from = $messageData['from'] ?? null;
            $messageId = $messageData['id'] ?? null;

            // if (RateLimiter::tooManyAttempts('whatsapp-'.$from, 5)) {
            //     return response()->json(['status' => 'too many requests'], 429);
            // }
            // RateLimiter::hit('whatsapp-'.$from);

            // Check for duplicate messages (store processed message IDs)
            if (Cache::has('processed_msg_'.$messageId)) {
                Log::info('Duplicate message ignored', ['message_id' => $messageId]);
                return response()->json(['status' => 'ignored - duplicate']);
            }

            // Mark message as processed
            Cache::put('processed_msg_'.$messageId, true, now()->addHours(24));

            // Handle different message types
            $message = '';
            if (isset($messageData['text'])) {
                $message = $messageData['text']['body'] ?? '';
            } elseif (isset($messageData['button'])) {
                $message = $messageData['button']['text'] ?? '';
            }

            Log::info('Processing WhatsApp message', [
                'from' => $from,
                'message' => $message,
                'message_id' => $messageId
            ]);




            // Generate response
            $response = $this->getResponse($message);

            // Send reply
            $this->sendWhatsAppMessage($from, $response);

            return response()->json(['status' => 'success']);


        } catch (\Exception $e) {
            Log::error('Webhook processing failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['status' => 'error'], 500);
        }

    }

    private function getResponse($message){

        $message = strtolower(trim($message));

        $response = WhatsAppResponse::where('is_active', true)
            ->whereJsonContains('triggers', $message)
            ->first();

        if (!$response) {
            // Optional: Fallback to partial match
            $responses = WhatsAppResponse::where('is_active', true)->get();

            foreach ($responses as $res) {
                if (in_array($message, json_decode($res->triggers))) {
                    $response = $res;
                    break;
                }
            }
        }

        return $response ? $response->response : "Sorry, I didn't understand that.";



    }


    private function sendWhatsAppMessage($to, $message)
    {
        // Validate inputs
        if (empty($to) || !is_numeric($to)) {
            throw new \InvalidArgumentException('Invalid recipient number');
        }

        if (empty($message)) {
            throw new \InvalidArgumentException('Message cannot be empty');
        }

        $token = env('WHATSAPP_TEMP_ACCESS_TOKEN');
        $phoneNumberId = env('WHATSAPP_PHONE_ID');

        // Remove any non-numeric characters from phone number
        $to = preg_replace('/[^0-9]/', '', $to);

        $url = "https://graph.facebook.com/v18.0/{$phoneNumberId}/messages";

        $payload = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $to, // Use the parameter, not hardcoded value
            'type' => 'text',
            'text' => [
                'preview_url' => false,
                'body' => $message, // Use the parameter
            ],
        ];

        Log::info('Sending WhatsApp message', [
            'to' => $to,
            'payload' => $payload
        ]);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ])
            ->timeout(30)
            ->post($url, $payload);

            $responseData = $response->json();

            Log::info('WhatsApp API Response', $responseData);

            if ($response->failed()) {
                Log::error('WhatsApp API Error', [
                    'status' => $response->status(),
                    'response' => $responseData,
                    'payload' => $payload
                ]);
                throw new \Exception('WhatsApp API Error: ' . ($responseData['error']['message'] ?? 'Unknown error'));
            }

            return $responseData;

        } catch (\Exception $e) {
            Log::error('WhatsApp Message Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    // Optional: webhook verification (needed for initial webhook setup)
    public function verify(Request $request)
    {
        $token = "cQxdcljumXdkvibw"; // same token you set in Meta developer console
        if (
            $request->hub_mode === 'subscribe' &&
            $request->hub_verify_token === $token
        ) {
            return response($request->hub_challenge);
        }

        return response('Verification failed', 403);
    }

    private function sendWhatsAppMessageOLD($to, $message)
    {


        $token = env('WHATSAPP_TEMP_ACCESS_TOKEN'); //'YOUR_TEMPORARY_ACCESS_TOKEN';
        $phone_number_id = env('WHATSAPP_PHONE_ID') ; //'YOUR_PHONE_NUMBER_ID';


        Log::info('WhatsApp token and phone_number_id:', [$token, $phone_number_id," to: $to", "message: $message"]);

        // Http::withToken($token)->post("https://graph.facebook.com/v22.0/$phone_number_id/messages", [
        //     'messaging_product' => 'whatsapp',
        //     'to' => $to, // customer's number
        //     'type' => 'text',
        //     'text' => [
        //         'body' => $message,
        //     ],
        // ]);

        $url = "https://graph.facebook.com/v18.0/{$phone_number_id}/messages";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post($url, [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => '2348024004029', //$to,
            'type' => 'text',
            'text' => [
                'preview_url' => false, // Optional: Set to true for link previews
                'body' => 'Hi from immaculate',//$message,
            ],
        ]);

        // Log the response for debugging
        Log::info('WhatsApp API Response:', $response->json());

        if ($response->failed()) {
            Log::error('WhatsApp API Error:', $response->json());
            throw new \Exception('Failed to send WhatsApp message: ' . $response->body());
        }

        return $response->json();
    }




}
