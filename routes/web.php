<?php

use App\Visit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

Route::get('/', function () {
    $today = Carbon::now()->locale('pl');
    $date = new Collection();

    $date->month = $today->monthName . ' ('. $today->format('m') . ')';
    $date->year = $today->year;

    $customer_data = new Collection();

    $customer_data->name = 'Lorem ipsum';
    $customer_data->address = 'Stephen Crossing 92';
    $customer_data->postal_code = '61-250';
    $customer_data->city = 'Falenki';
    $customer_data->nip = '6789054321';
    $customer_data->regon = '123456789';

    $user_data = new Collection();

    $user_data->first_name = 'Ipsum';
    $user_data->last_name = 'lorem';
    $user_data->address = 'Hoffman Hill 67';
    $user_data->postal_code = '94-613';
    $user_data->city = 'Fulton';
    $user_data->pesel = '19283746501';
    $user_data->nip = '1237890456';

    $visit_days = Visit::select(DB::raw('DATE_FORMAT(visit_date, \'%Y-%m-%d\') as date, count(*) as count, SEC_TO_TIME( SUM( TIME_TO_SEC( duration ) ) ) as duration'))
        ->whereDate('visit_date', '>=', Carbon::now()->startOfMonth()->format('Y-m-d'))
        ->whereDate('visit_date', '<=', Carbon::now()->endOfMonth()->format('Y-m-d'))
        ->groupBy('date')
        ->get();

    $total = Visit::select(DB::raw('count(*) as count, SEC_TO_TIME( SUM( TIME_TO_SEC( duration ) ) ) as duration'))
        ->whereDate('visit_date', '>=', Carbon::now()->startOfMonth()->format('Y-m-d'))
        ->whereDate('visit_date', '<=', Carbon::now()->endOfMonth()->format('Y-m-d'))
        ->get();

    $total = $total->first();

    return view('document', compact('customer_data', 'user_data', 'date', 'visit_days', 'total'));
});