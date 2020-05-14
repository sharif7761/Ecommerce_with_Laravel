<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

use App\Http\Requests;
use Session;

class ManufactureController extends Controller
{
    public function index()
    {
       return view('admin\add_manufacture') ;
    }

    public function save_manufacture(Request $request)
    {
       $data=array();
       
       $data['manufacture_name']=$request->manufacture_name;
       $data['manufacture_description']=$request->manufacture_description;
       $data['publication_status']=$request->publication_status;

     // print_r($data);
      DB::table('tbl_manufacture')->insert($data);

      $request->session()->flash('message', $data['manufacture_name'].' manufacturer added successfully');

      
       return redirect('add-manufacture');
    }


    public function all_manufacture()
    {

      $all_manufacture_info = DB::table('tbl_manufacture')->get();
      
       $manage_manufacture= view('admin\all_manufacture')
                     ->with('all_manufacture_info',$all_manufacture_info);
       return view('admin_layout')
            ->with('admin\all_manufacture',$manage_manufacture);
    }


    public function inactive_manufacture(Request $request,$manufacture_id)
    {
      // echo($manufacture_id);

      DB::table('tbl_manufacture')
         ->where('manufacture_id',$manufacture_id)
         ->update(['publication_status'=> 0 ]);

         $request->session()->flash('message', 'status deativated of manufacture ID: '.$manufacture_id);

         return redirect("/all-manufacture");
    }

    public function active_manufacture(Request $request, $manufacture_id)
    {
      // echo($manufacture_id);

      DB::table('tbl_manufacture')
         ->where('manufacture_id',$manufacture_id)
         ->update(['publication_status'=> 1 ]);
         
         $request->session()->flash('message', 'status activated of manufacture ID: '.$manufacture_id);


         return redirect("/all-manufacture");
    }

    public function edit_manufacture(Request $request, $manufacture_id)
    {
      
      $manufacture_info= DB::table('tbl_manufacture')
               ->where('manufacture_id',$manufacture_id)
               ->first();
         $manufacture_info= view('admin\edit_manufacture')
               ->with('manufacture_info',$manufacture_info);
 return view('admin_layout')
      ->with('admin\edit_manufacture',$manufacture_info);         


         return view("admin/edit_manufacture");
    }


    public function update_manufacture(Request $request, $manufacture_id)
    {
       $data=array();
       
       $data['manufacture_name']=$request->manufacture_name;
       $data['manufacture_description']=$request->manufacture_description;
      
   //  print_r($data);
      DB::table('tbl_manufacture')
            ->where('manufacture_id',$manufacture_id)
            ->update($data);

     $request->session()->flash('message', $data['manufacture_name'].' manufacturer updated successfully');

     return redirect("/all-manufacture");
    }


    public function delete_manufacture(Request $request, $manufacture_id)
    {

      DB::table('tbl_manufacture')
            ->where('manufacture_id',$manufacture_id)
            ->delete();

     $request->session()->flash('message', 'manufacture ID: '.$manufacture_id.' deleted successfully');

     return redirect("/all-manufacture");
    }

}
