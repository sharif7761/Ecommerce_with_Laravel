<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

use App\Http\Requests;
use Session;

class ProductController extends Controller
{
    public function index()
    {
      $this->AdminAuthCheck(); 
       return view('admin\add_product') ;
    }

    public function save_product(Request $request)
    {
       $data=array();
       $data['product_name']=$request->product_name;
       $data['category_id']=$request->category_id;
       $data['manufacture_id']=$request->manufacture_id;
       $data['product_short_description']=$request->product_short_description;
       $data['product_long_description']=$request->product_long_description;
       $data['product_price']=$request->product_price;
       $data['product_quantity']=$request->product_quantity;
       $data['product_size']=$request->product_size;
       $data['product_color']=$request->product_color;
       $data['publication_status']=$request->publication_status;

       $image = $request->file('product_image');
        
       if(($image)){
           $image_name=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          $image_full_name=$image_name.'.'.$ext;
          $upload_path='image/';
          $image_url=$upload_path.$image_full_name;
          $success=$image->move($upload_path,$image_full_name);
          $data['product_image']=$image_url;

          DB::table('tbl_products')->insert($data);

          $request->session()->flash('message', $data['product_name'].' product added successfully with image');
    
          
           return redirect('add-product');
        
       }
       else{
        DB::table('tbl_products')->insert($data);

        $request->session()->flash('message', $data['product_name'].' product added successfully without image');
  
        
         return redirect('add-product');
       }
      }
       public function all_product()
       {
   
         $all_product_info = DB::table('tbl_products')
                                ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                                ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                                ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                                ->get();
         
          $manage_product= view('admin\all_product')
                        ->with('all_product_info',$all_product_info);
          return view('admin_layout')
               ->with('admin\all_product',$manage_product);
       }

       public function inactive_product(Request $request,$product_id)
    {
      // echo($category_id);

      DB::table('tbl_products')
         ->where('product_id',$product_id)
         ->update(['publication_status'=> 0 ]);

         $request->session()->flash('message', 'status deativated of product ID: '.$product_id);

         return redirect("/all-product");
    }

    public function active_product(Request $request, $product_id)
    {
      // echo($category_id);

      DB::table('tbl_products')
         ->where('product_id',$product_id)
         ->update(['publication_status'=> 1 ]);
         
         $request->session()->flash('message', 'status activated of product ID: '.$product_id);


         return redirect("/all-product");
    }

       
    public function delete_product(Request $request, $product_id)
    {

      DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->delete();

     $request->session()->flash('message', 'product ID: '.$product_id.' deleted successfully');

     return redirect("/all-product ");
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
