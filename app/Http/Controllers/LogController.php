<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request){
        $orderBy = request('orderBy', 'id');
        $orderDir = request('orderDir', 'desc');

        $logs = Log::when($request->search, function($query) use($request){
            $query->where('log','like', '%'.$request->search.'%');
        })->with(['user'])->orderBy($orderBy, $orderDir)->paginate(5)->withQueryString();

        //dd($whatsAppResponses);
        return inertia('Auth/Logs/Index', [
            'logs' => $logs
        ]);
    }
}
