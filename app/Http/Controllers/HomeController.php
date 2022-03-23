<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Courier;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $couriers = Courier::pluck('title', 'code');
        // $provinces = Courier::pluck('title', 'province_id');

        return view('home');
    }
}
