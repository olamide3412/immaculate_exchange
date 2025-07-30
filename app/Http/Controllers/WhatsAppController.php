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

    public function handleIncomingMessage(Request $request) {
        // Log incoming request (for debugging)
        Log::info('Incoming WhatsApp Message:', $request->all());

        // Verify Twilio/Service signature (if required)
        // Process message
        $senderNumber = $request->input('From'); // e.g., 'whatsapp:+1234567890'
        $messageBody = $request->input('Body');  // User's message

        log_new("Incoming WhatsApp Message: " .$messageBody);
        // Generate a response based on the message
        $responseText = $this->getResponse($messageBody);

        // Send response back via WhatsApp API
        $this->sendMessage($senderNumber, $responseText);

        return response('OK', 200);
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

        // $response = WhatsAppResponse::where('is_active', true)->get()->first(function ($res) use ($message) {
        //     return in_array($message, json_decode($res->triggers));
        // });

        // foreach ($responses as $res) {
        //     if ($res->match_type === 'exact' && in_array($message, $res->triggers)) {
        //         return $res->response;
        //     }

        //     if ($res->match_type === 'contains') {
        //         foreach ($res->triggers as $trigger) {
        //             if (str_contains($message, $trigger)) {
        //                 return $res->response;
        //             }
        //         }
        //     }
        // }

    }

    private function sendMessage($to, $body) {
        $accountSid = env('TWILIO_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_WHATSAPP_NUMBER');

        $client = new Client($accountSid, $authToken);


        return $client->messages->create(
            $to,
            [
                'from' =>  'whatsapp:'.$twilioNumber,
                'body' => $body
            ]
        );
    }

    private function getResponseOLD($message) {
        $message = strtolower($message);

        if (strpos($message, 'hello') !== false) {
            return "Hi! How can we assist you today?";
        } elseif ($message == 'menu') {
            return "Our menu:\n1. Pizza\n2. Burgers\n3. Drinks";
        } else {
            return "Sorry, I didn't understand that. Type 'menu' for options.";
        }
    }
    private function getResponseOLD2($message)
    {
        $message = strtolower(trim($message));

        $faqs = [
            'hello' => "Hi! How can we assist you today?",
            'hi' => "Hello! How may I help you?",
            'menu' => "Our menu:\n1. Pizza\n2. Burgers\n3. Drinks",
            'price' => "Prices vary:\nPizza - ₦1500\nBurgers - ₦1000\nDrinks - ₦500",
            'hours' => "We are open from 8 AM to 10 PM daily.",
            'location' => "We are located at 123 Main Street, Lagos.",
            'contact' => "You can reach us at +234 812 345 6789.",
            'order' => "To place an order, just type the item name and quantity.",
            'payment' => "We accept cash, POS, and bank transfer.",
            'delivery' => "We offer delivery within 5km for ₦500.",
            'company' => "EEW Tech X Skyway Digital Hub.",
            'ola' => "Olamide is someone that loves you very well. X Empress",
            'ble' => "Empress is a woman who loves unconditionally with her heart but she is currently in love with.......",
            'help' => "You can type 'menu', 'hours', 'location', 'order', 'company' or 'contact' to get help."
        ];

        return $faqs[$message] ?? "Sorry, I didn't understand that. Type 'help' for available commands.";
    }

     private function getResponseOLD3($message){
         $message = strtolower(trim($message));
            // Find matching response
        $response = WhatsAppResponse::where('is_active', true)
            ->whereRaw("JSON_CONTAINS(triggers, '\"$message\"')") // Exact match
            ->orWhere(function ($query) use ($message) {
                $query->whereJsonContains('triggers', '%' . $message . '%')
                    ->where('match_type', 'like');
            })
            ->first();


        if ($response) {
            $reply = $response->response;
        } else {
            $reply = "Sorry, I didn't understand that.";
        }

        return $reply;
    }

    //Using Direct Whatsapp api without twillo


    public function receiveWebhook(Request $request)
    {
        // Log incoming request (for debugging)
        Log::info('Incoming WhatsApp Message:', $request->all());
        // Get incoming message
        $message = $request->input('entry.0.changes.0.value.messages.0.text.body');
        $from = $request->input('entry.0.changes.0.value.messages.0.from');

        Log::info('WhatsApp Message and from:',[$message,$from]);

        // Simple response based on keyword
        $response = "Thanks for messaging us!";
        if (strpos(strtolower($message), 'price') !== false) {
            $response = "Our prices are affordable. Visit immaculateexchange.com/rate.";
        } elseif (strpos(strtolower($message), 'hello') !== false) {
            $response = "Hello! How can we help you today?";
        }

        // Send reply using WhatsApp Cloud API
        $this->sendWhatsAppMessage($from, $response);

        return response()->json(['status' => 'message sent']);
    }

    private function sendWhatsAppMessage($to, $message)
    {
        $token = env('WHATSAPP_TEMP_ACCESS_TOKEN'); //'YOUR_TEMPORARY_ACCESS_TOKEN';
        $phone_number_id = env('WHATSAPP_PHONE_ID') ; //'YOUR_PHONE_NUMBER_ID';


        Log::info('WhatsApp token and phone_number_id:', [$token, $phone_number_id]);

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
            'to' => $to,
            'type' => 'text',
            'text' => [
                'preview_url' => false, // Optional: Set to true for link previews
                'body' => $message,
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


}
