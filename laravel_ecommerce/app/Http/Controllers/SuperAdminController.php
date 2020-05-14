<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class SuperAdminController extends Controller
{
    
    public function index()
    {
        $this->AdminAuthCheck();              
        return view('admin/dashboard');
    }
    
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/admin');
    
    }

    public function AdminAuthCheck()
    {
       $admin_id=Session::get('admin_id');
       if($admin_id){
        return;
       }
       else{
        return redirect('/admin')->send();
       }
    }

    
}
