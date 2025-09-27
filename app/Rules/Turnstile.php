<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Turnstile implements ValidationRule
{
    protected $errorMessage;
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
       try {
            $response = Http::asForm()->timeout(10)->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => config('services.turnstile.secret_key'),
                'response' => $value,
                'remoteip' => request()->ip(),
            ]);

            $data = $response->json();

            if (!$response->successful() || !isset($data['success'])) {
                $this->errorMessage = 'CAPTCHA verification service unavailable.';
                Log::error('Turnstile API error: ' . $response->body());
                $fail($this->errorMessage);
            }

            if (!$data['success']) {
                $this->errorMessage = 'CAPTCHA verification failed. Please try again.';
                Log::warning('Turnstile verification failed', [
                    'errors' => $data['error-codes'] ?? [],
                    'ip' => request()->ip()
                ]);
               $fail($this->errorMessage);
            }


        } catch (\Exception $e) {
            Log::error('Turnstile validation exception: ' . $e->getMessage());
            $this->errorMessage = 'CAPTCHA verification service temporarily unavailable.';
           $fail('Cloudflare Turnstile verification failed.');
        }
    }

    public function message()
    {
        return $this->errorMessage ?? 'CAPTCHA verification failed.';
    }
}
