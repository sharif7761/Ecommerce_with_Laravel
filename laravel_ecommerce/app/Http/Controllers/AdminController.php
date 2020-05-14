<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

use App\Http\Requests;
use session;

session_start();

class AdminController extends Controller
{
    public function index()
    {
       return view('admin/admin_login');
    }

    public function show_dashboard()
    {
                      
        return view('admin/dashboard');
    }

    public function dashboard(Request $request)
    {
        $admin_email=$request->admin_email;
        $admin_password=md5($request->admin_password);
        $result=DB::table('tbl_admin')
                ->where('admin_email',$admin_email)
                ->where('admin_password',$admin_password)
                ->first();
               // echo "<pre>";
               // print_r($result);
                //exit();

                if($result)
                {       
                       $request->session()->put('admin_name', $result->admin_name);
                       $request->session()->put('admin_id', $result->admin_id);

                 
                       return redirect('/dashboard'); 

                }
                else
                {
                    $request->session()->flash('message', 'invalid username/password');
                    return redirect('/admin');
                }

    }
}
