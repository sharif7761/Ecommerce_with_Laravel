<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

use App\Http\Requests;
use Session;

class CategoryController extends Controller
{
    public function index()
    {
      $this->AdminAuthCheck(); 
         return view('admin\add_category') ;
    }

    public function all_category()
    {
      $this->AdminAuthCheck(); 
      
      $all_category_info = DB::table('tbl_category')->get();
      
       $manage_category= view('admin\all_category')
                     ->with('all_category_info',$all_category_info);
       return view('admin_layout')
            ->with('admin\all_category',$manage_category);
    }

    public function save_category(Request $request)
    {
       $data=array();
       
       $data['category_name']=$request->category_name;
       $data['category_description']=$request->category_description;
       $data['publication_status']=$request->publication_status;

     // print_r($data);
      DB::table('tbl_category')->insert($data);

      $request->session()->flash('message', $data['category_name'].' category added successfully');

      
       return redirect('add-category');
    }

    public function inactive_category(Request $request,$category_id)
    {
      // echo($category_id);

      DB::table('tbl_category')
         ->where('category_id',$category_id)
         ->update(['publication_status'=> 0 ]);

         $request->session()->flash('message', 'status deativated of Category ID: '.$category_id);

         return redirect("/all-category");
    }

    public function active_category(Request $request, $category_id)
    {
      // echo($category_id);

      DB::table('tbl_category')
         ->where('category_id',$category_id)
         ->update(['publication_status'=> 1 ]);
         
         $request->session()->flash('message', 'status activated of Category ID: '.$category_id);


         return redirect("/all-category");
    }

    public function edit_category(Request $request, $category_id)
    {
      
      $category_info= DB::table('tbl_category')
               ->where('category_id',$category_id)
               ->first();
         $category_info= view('admin\edit_category')
               ->with('category_info',$category_info);
 return view('admin_layout')
      ->with('admin\edit_category',$category_info);         


         return view("admin/edit_category");
    }


    public function update_category(Request $request, $category_id)
    {
       $data=array();
       
       $data['category_name']=$request->category_name;
       $data['category_description']=$request->category_description;
      
   //  print_r($data);
      DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->update($data);

     $request->session()->flash('message', $data['category_name'].' category updated successfully');

     return redirect("/all-category");
    }


    public function delete_category(Request $request, $category_id)
    {

      DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->delete();

     $request->session()->flash('message', 'category ID: '.$category_id.' deleted successfully');

     return redirect("/all-category");
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
