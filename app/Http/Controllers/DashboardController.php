<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnums;
use App\Models\Log;
use App\Models\User;
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

         $logsCount = Log::count();

        //dd($users->toArray());
        return inertia('Users/Dashboard', [
            'counts' => [
                'users' => $usersCount,
                'admins' => $adminsCount,
                'superAdmins' => $superAdminsCount,
                'logs' => $logsCount,
            ],
        ]);
    }

}
