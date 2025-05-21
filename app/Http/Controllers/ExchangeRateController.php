<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    public function index(Request $request){
        $orderBy = request('orderBy', 'id');
        $orderDir = request('orderDir', 'asc');

        $exchangeRates = ExchangeRate::when($request->search, function($query) use($request){
            $query->where('name','like', '%'.$request->search.'%')
                    ->orWhere('amount','like', '%'.$request->search.'%')
                    ->orWhere('rate','like', '%'.$request->search.'%');
        })->orderBy($orderBy, $orderDir)->paginate(5)->withQueryString();

        //dd($whatsAppResponses);
        return inertia('Auth/ExchangeRates/Index', [
            'exchangeRates' => $exchangeRates
        ]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'amount' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'string', 'max:255'],
        ]);

        $validateData['sort_order'] = ExchangeRate::count() + 1;

        $exchangeRate = ExchangeRate::create($validateData);
        log_new("New exchange rate created name: " .$exchangeRate->name);
        return back()->with('message','New exchange rate created');
    }

    public function show(ExchangeRate $exchangeRate){

        return inertia('Auth/ExchangeRates/Show', [
            'exchangeRate' => $exchangeRate
        ]);
    }

    public function update(Request $request, ExchangeRate $exchangeRate){
        $validateData = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'amount' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'string', 'max:255'],
            'sort_order' => ['required','integer'],
            'is_visible' => ['required', 'boolean']
        ]);

        $exchangeRate->update($validateData);
        log_new("Exchange rate updated name: " .$exchangeRate->name);
        return back()->with('message','Exchange rate updated');
    }

    public function destroy(ExchangeRate $exchangeRate){
        log_new("Exchange rate deleting name: " .$exchangeRate->name);
        $exchangeRate->delete();
         return redirect(route('exchangeRate.index'))->with('message','Exchange rate deleted');
    }
}
