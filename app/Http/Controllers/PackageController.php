<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use App\Models\Service;
use App\Models\Package_discount;
use Illuminate\Http\Request;

class PackageController extends Controller
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

    /*Get All Packages-*/
    public function getAllPackages()
    {
        $data = DB::table('packages')
                // ->where('p_status',1)
                ->get();
        return json_encode($data);
    }

    /*Get All Packages Discount */

    public function getAllPackagesDisc()
    {
        $data = DB::table('packages_discount')
                ->get();
        return json_encode($data);
        // return $data[0]->customer_id;
    }

    /*Create New Packages-*/
    public function createPackages(Request $request)
    {
        $admin_id   = $request[1]['admin'];
        $package = new package;

        $package->p_name              = $request[0]['p_name'];
        $package->p_amount            = 0;
        $package->p_status            = $request[0]['p_status'];
        $package->created_by          = $admin_id;

        $insert = $package->save();

        if($insert){
            $data = DB::table('packages_discount')
                     ->distinct()->get(['customer_id']);

            $countDisc = count($data);
            $last_id = DB::table('packages')->max('p_id');

            for ($i=0; $i < $countDisc ; $i++) {
                $packg = new Package_discount;

                $packg->customer_id            = $data[$i]->customer_id;
                $packg->package_id             = $last_id;
                $packg->discount_percentage    = 0;
                $packg->updated_by             = $admin_id;

                $save = $packg->save();
            }
            return ['msg'=>'Insert Successfully'];
        }

        
    }
    public function updatePackages(Request $request)
    {   
        // return $request;
        $admin_id   = $request[1]['admin'];
        $p_id       = $request[0]['p_id'];

        DB::table('packages')
            ->where('p_id', $p_id)
            ->update([
                'p_name'        => $request[0]['p_name'],
                'p_status'      => $request[0]['p_status'],
                'updated_by'    => $admin_id
            ]);
        return ['msg'=>'Update Success'];
    }

    public function deletePackages(Request $request)
    {
        $id = $request['id'];

        $packg = DB::table('services')
                ->where('package_id', '=', $id)
                ->get();
        $countPakg = count($packg);

        if ($countPakg > 0) {
            return ['msg'=>'You Have Some Packages Data'];
        }

        else{
            DB::table('packages')->where('p_id', '=', $id)->delete();
            $data = 'delete';
            return json_encode($data);
        }
        
    }   
}
