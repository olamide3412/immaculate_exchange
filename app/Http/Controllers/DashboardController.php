<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnums;
use App\Models\ExchangeRate;
use App\Models\Log;
use App\Models\User;
use App\Models\WhatsAppResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::latest()->limit(25)->get();
        $usersCount = User::count();
        $adminsCount = User::where('role', RoleEnums::Administrator->value)->count();
        $superAdminsCount = User::where('role', RoleEnums::SuperAdministrator->value)->count();
        $activeResponseCount = WhatsAppResponse::where('is_active', true)->count();
        $inactiveResponseCount = WhatsAppResponse::where('is_active', false)->count();
        $exchangeRateCount = ExchangeRate::count();

        $logsCount = Log::count();

        //dd($users->toArray());
        return inertia('Auth/Dashboard', [
            'counts' => [
                'users' => $usersCount,
                'admins' => $adminsCount,
                'superAdmins' => $superAdminsCount,
                'activeResponseCount' => $activeResponseCount,
                'inactiveResponseCount' => $inactiveResponseCount,
                'exchangeRateCount'  =>  $exchangeRateCount,
                'logs' => $logsCount,
            ],
        ]);
    }

}
