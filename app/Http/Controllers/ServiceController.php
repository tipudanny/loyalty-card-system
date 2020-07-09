<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\Package;
use App\Models\Package_discount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ServiceController extends Controller
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
    public function allService()
    {
        // $data = DB::table('services')
        //         ->get();

        // When Date Wise Search Coming.............!!!

        // $now = Carbon::now();
        // $firstOfMonth = $now->firstOfMonth()->format('d-M-Y');
        // $lastOfMonth = Carbon::now()->format('d-M-Y');

        $data = DB::table('services')
            ->join('packages', 'services.package_id', '=', 'packages.p_id')
            ->join('customers', 'services.customer_id', '=', 'customers.id')
            ->join('users as cr_users', 'services.created_by', '=', 'cr_users.id')
            ->join('users as up_user', 'services.updated_by', '=', 'up_user.id')
            ->select('services.*', 'packages.p_name','customers.name as c_name','cr_users.name as create_user','up_user.name as update_user')
            // ->whereBetween('service_date', [$firstOfMonth, $lastOfMonth])
            ->get();

        return $data;
    }

    public function createService(Request $request)
    {
        $last_id = DB::table('services')->max('id');
        $bill = 'slc-'.($last_id+1);

        $service = new Service;
        // $s_date = strtotime($request[0]['service_date']);
        // $s_dateformat = date('Y-m-d',$s_date);
        

        $service->bill_no                   = $bill;
        $service->customer_id               = $request[0]['customer_id'];
        $service->package_id                = $request[0]['package_id'];
        $service->service_discount          = $request[0]['service_discount'];
        $service->amount                    = $request[0]['amount'];
        $service->service_date              = $request[0]['service_date'];
        $service->remark                    = $request[0]['remark'];
        $service->created_by                = $request[0]['admin'];
        $service->updated_by                = $request[0]['admin'];

        $insert = $service->save();

        return ['msg'=>'Service Insert Successfully'];

        // return $request[0]['admin'];
    }

    public function updateService(Request $request)
    {
        $id = $request[0]['id'];

        DB::table('services')
            ->where('id', $id)
            ->update([
                'customer_id'           => $request[0]['customer_id'],
                'package_id'            => $request[0]['package_id'],
                'service_discount'      => $request[0]['service_discount'],
                'amount'                => $request[0]['amount'],
                'service_date'          => $request[0]['service_date'],
                'remark'                => $request[0]['remark'],
                'updated_by'            => $request[0]['admin']
            ]);

        return ['msg'=>'Service Update Success'];
    }

    public function deleteService(Request $request)
    {
        $id = $request['id'];

        $delete = DB::table('services')->where('id', '=', $id)->delete();

        if ($delete) {
            $data = 'delete';
        }
        return json_encode($data);
    }
}
