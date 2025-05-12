<?php

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

if (!function_exists('log_new')) {
    function log_new ($log_msg) {

        Log::create([
            'log' => $log_msg,
            'user_id' => Auth::check() ? Auth::user()->id : null
        ]);


    }
}
