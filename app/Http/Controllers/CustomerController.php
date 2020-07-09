<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Package;
use App\Models\Package_discount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CustomerController extends Controller
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

    public function getCustomers()
    {
        $data = DB::table('customers')->get();

        // $age['user'] = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
        return json_encode($data);
    }


    public function createCustomer(Request $request)
    {
        $customer = new Customer;

        $customer->name              = $request->name;
        $customer->email             = $request->email;
        $customer->phone             = $request->phone;
        $customer->address           = $request->address;
        $customer->dob               = $request->dob;
        $customer->card_no           = $request->card_no;
        $customer->card_issu_date    = $request->card_issu_date;
        $customer->card_expire_date  = $request->card_expire_date;
        $customer->created_by        = $request->admin;
        $customer->updated_by        = $request->admin;

        $lastInserted = $customer->id;

        $customer->save();

        return ['msg'=>'Success'];
    }

    public function updateCustomer(Request $request)
    {
        $id = $request['id'];
        DB::table('customers')
            ->where('id', $id)
            ->update([
                'name'              => $request['name'],
                'email'             => $request['email'],
                'phone'             => $request['phone'],
                'address'           => $request['address'],
                'dob'               => $request['dob'],
                'card_no'           => $request['card_no'],
                'card_issu_date'    => $request['card_issu_date'],
                'card_expire_date'  => $request['card_expire_date'],
                'created_by'        => $request['created_by'],
                'updated_by'        => $request['admin'],
            ]);

        return ['msg'=>'Customer Update Success'];
    }



    public function createCustomerOffer(Request $request)
    {

        $length = $request->length;
        $package['offer'] = array();
        for ($i=0; $i < $length; $i++) {
            if ($request->$i == null || $request->$i == '') {
                array_push($package['offer'],0);
            }
            else{
                array_push($package['offer'],(int)$request->$i);
            }            
        };

        $last_id = DB::table('customers')->max('id');

        $pckg_id = DB::table('packages')
                ->select(DB::raw(' p_id  as id'))
                ->get();

        $packg_len = count($pckg_id);

        for ($i=0; $i < $packg_len ; $i++) { 

            $packg = new Package_discount;

            $packg->customer_id            = $last_id;
            $packg->package_id             = $pckg_id[$i]->id;
            $packg->discount_percentage    = $package['offer'][$i];

            $packg->save();
        };
        return ['msg'=>'Success'];
    }

    public function updateCustomerOffer(Request $request)
    {
        $id = $request['id'];
        $len = count($request['offerData']);

        $data = DB::table('packages_discount')
                ->where('customer_id', $id)
                ->get();


        for ($i=0; $i<$len; $i++) {

            DB::table('packages_discount')
            ->where('customer_id', $id)
            ->where('package_id', $data[$i]->package_id)
            ->update([
                'discount_percentage'  => $request['offerData'][$i],
                'updated_at'  => Carbon::now(),
            ]);

            // return ['msg'=>'Customer Update Success'];
        }

        return ['msg'=>'Packages Update Success'];
    }



    public function customerService(Request $request)
    {
        $id =  $request['id'];
            
            $total_service = DB::table('services')
                ->join('packages', 'services.package_id', '=', 'packages.p_id')
                ->join('customers', 'services.customer_id', '=', 'customers.id')
                ->select('services.*', 'packages.p_name','customers.name as c_name')
                ->where('customer_id', $id)
                ->get();

            return $total_service;
    }

    public function getTotalService(Request $request)
    {
        $id =  $request['id'];
            
            $total_service = DB::table('services')
                ->join('packages', 'services.package_id', '=', 'packages.p_id')
                ->join('customers', 'services.customer_id', '=', 'customers.id')
                ->select('services.*', 'packages.p_name','customers.name as c_name')
                ->where('customer_id', $id)
                ->get();

            $tt = $total_service->groupBy('package_id')->map->count();

            return $tt;
    }

    public function customerPackagesDisc(Request $request)
    {
        
        $id =  $request['id'];

        // $total_service = DB::table('services')
        //     ->join('packages', 'services.package_id', '=', 'packages.p_id')
        //     ->join('customers', 'services.customer_id', '=', 'customers.id')
        //     ->select('services.*', 'packages.p_name','customers.name as c_name')
        //     ->where('customer_id', $id)
        //     ->get();

        //     $tt = $total_service->groupBy('package_id')->map->count();



        $data = DB::table('packages_discount')
            ->join('customers', 'packages_discount.customer_id', '=', 'customers.id')
            ->join('packages', 'packages_discount.package_id', '=', 'packages.p_id')

            ->select('packages_discount.*', 'packages.p_name','customers.name as c_name')
            ->where('customer_id', $id)
            ->get();

        

        return json_encode($data);
    }

    public function deleteCustomer(Request $request)
    {
        $id = $request['id'];

        $packg = DB::table('services')
                ->where('customer_id', '=', $id)
                ->get();
        $countPakg = count($packg);

        if ($countPakg > 0) {
            return ['msg'=>'You Have Some Customer Service Data'];
        }

        else{
            DB::table('customers')->where('id', '=', $id)->delete();
            $data = 'delete';
            return json_encode($data);
        }
    }
}
