<?php

namespace App\Http\Middleware;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth.user' => fn () => Auth::check()
                    ? Auth::user()
                    : null,
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
            'support' => [
                'phone' => '+2348151702840',
                'phone_whatsapp' => '2348151702840', //'2348151702840',
                'phone_formatted' => '+234 815170 2840',
                'email' => 'support@immaculateexchange.com',
                'location' => 'Delta State, Nigeria',
                'telegram_bot' => 'https://t.me/immaculate_exchange_bot?start=hello', //
            ],
            'exchangeRates' => ExchangeRate::where('is_visible', true)->orderBy('sort_order', 'asc')->limit(15)->get(),
        ];
    }
}
