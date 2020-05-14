<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

use App\Http\Requests;
use Session;

class SliderController extends Controller
{
    public function index()
    {
       return view('admin\add_slider') ;
    }

    public function save_slider(Request $request)
    {
       $data=array();
       $data['publication_status']=$request->publication_status;

       $image = $request->file('slider_image');
        
       if(($image)){
           $image_name=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          $image_full_name=$image_name.'.'.$ext;
          $upload_path='slider/';
          $image_url=$upload_path.$image_full_name;
          $success=$image->move($upload_path,$image_full_name);
          $data['slider_image']=$image_url;

          DB::table('tbl_slider')->insert($data);

          $request->session()->flash('message', ' slider added successfully with image');
    
          
           return redirect('add-slider');
        
       }
       else{
        
        $request->session()->flash('message', 'Error!!! Please Upload a image');
  
        
         return redirect('add-slider');
       }
      }

      
      public function all_slider()
       {
   
         $all_slider_info = DB::table('tbl_slider')
                                ->get();
         
          $manage_slider= view('admin\all_slider')
                        ->with('all_slider_info',$all_slider_info);
          return view('admin_layout')
               ->with('admin\all_slider',$manage_slider);
       }


       public function inactive_slider(Request $request,$slider_id)
       {
         // echo($category_id);
   
         DB::table('tbl_slider')
            ->where('slider_id',$slider_id)
            ->update(['publication_status'=> 0 ]);
   
            $request->session()->flash('message', 'status deativated of slider ID: '.$slider_id);
   
            return redirect("/all-slider");
       }
   
       public function active_slider(Request $request, $slider_id)
       {
         // echo($category_id);
   
         DB::table('tbl_slider')
            ->where('slider_id',$slider_id)
            ->update(['publication_status'=> 1 ]);
            
            $request->session()->flash('message', 'status activated of slider ID: '.$slider_id);
   
   
            return redirect("/all-slider");
       }
   
          
       public function delete_slider(Request $request, $slider_id)
       {
   
         DB::table('tbl_slider')
               ->where('slider_id',$slider_id)
               ->delete();
   
        $request->session()->flash('message', 'slider ID: '.$slider_id.' deleted successfully');
   
        return redirect("/all-slider");
       }
   
    
}
