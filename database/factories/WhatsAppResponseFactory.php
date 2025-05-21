<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WhatsAppResponse>
 */
class WhatsAppResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $whatsAppResponses = [
            [
                'triggers' => ['hi','hello','good morning', 'good afternoon', 'good eveing'],
                'response' => 'Hi there! How can we help?',
                'name' => 'Greetings'
            ],
            [
                'triggers' => ['payment'],
                'response' => 'We accept bank transfer.',
                'name' => 'Payment'
            ],
            [
                'triggers' => ['rate'],
                'response' => 'Rates vary:\nAbove $1000 - NGN 1713/$\n$100+ to $999 - NGN 1709/$\nLess than $100 - NGN 1700/$',
                'name' => 'Rate'
            ],
            [
                'triggers' => ['about'],
                'response' => 'At Immaculate Exchange, we are committed to offering the fastest, most trusted, and most reliable cryptocurrency transactions.',
                'name' => 'About'
            ],
        ];

        $randomIndex = array_rand($whatsAppResponses);
        $randomResponse  = $whatsAppResponses[$randomIndex];
        return [
            'triggers' => json_encode($randomResponse['triggers']),
            'response' => $randomResponse['response'],
            'name' => $randomResponse['name']
        ];
    }
}
