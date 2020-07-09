<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\Package;
use App\Models\Package_discount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;



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
        
        return view('home');

        // return view('home');
    }
    public function adminId()
    {
        $admin = Auth::user()->id;
        return $admin;

        // return view('home');
    }

    public function getNewCustomer()
    {
        $now = Carbon::now();
        $firstOfMonth = $now->firstOfMonth();
        $lastOfMonth = Carbon::now();

        $data = DB::table('customers')
            ->whereBetween('created_at', [$firstOfMonth, $lastOfMonth])
            ->count();

        return $data;
    }

    public function getTotalCustomer()
    {
        $data = DB::table('customers')
                ->count();

        return $data;
    }

    public function getServices()
    {
        $now = Carbon::now();
        $firstOfMonth = $now->firstOfMonth()->format('d-M-Y');
        $lastOfMonth = Carbon::now()->format('d-M-Y');

        $data = DB::table('services')
            ->whereBetween('service_date', [$firstOfMonth, $lastOfMonth])
            ->count();

        return $data;
    }

    public function getTotalService()
    {
        $data = DB::table('services')
                ->count();

        return $data;
    }
    
}
