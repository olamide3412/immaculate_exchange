<?php

namespace App\Providers;

use App\Enums\MatchTypeEnums;
use App\Enums\RoleEnums;
use App\Enums\StatusEnums;
use App\Helpers\EnumHelper;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
            'enums' => fn () => EnumHelper::options([
                'matchTypes' => MatchTypeEnums::class,
                'roles' => RoleEnums::class,
                'statuses' => StatusEnums::class,
                // Add more enums here as needed
            ])
        ]);
    }
}
