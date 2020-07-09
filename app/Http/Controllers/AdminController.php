<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminController extends Controller
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

    public function allUsers()
    {
        $data = DB::table('users')
                ->get();
        return json_encode($data);
    }

    public function createUser(Request $request)
    {
        $user = new User;

        $user->name             = $request[0]['name'];
        $user->email            = $request[0]['email'];
        $user->user_type        = $request[0]['user_type'];
        $user->password         = Hash::make($request[0]['password']);

        $insert = $user->save();

        return ['msg'=>'Insert Successfully'];
    }

    public function updateUser(Request $request)
    {
        $id       = $request[0]['id'];

        DB::table('users')
            ->where('id', $id)
            ->update([
                'name'          => $request[0]['name'],
                'email'         => $request[0]['email'],
                'user_type'     => $request[0]['user_type']
            ]);
        return ['msg'=>'Update Success'];
    }
}
