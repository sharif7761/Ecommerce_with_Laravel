<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Cart;
use App\Http\Requests;
use Session;
class CheckoutController extends Controller
{
    public function login_check()
    {
        return view('pages\login');
    }

    public function customer_registration(Request $request)
    {
        $data=array();
        $data['customer_name']=$request->customer_name;
        $data['customer_email']=$request->customer_email;
        $data['password']=md5($request->password);
        $data['mobile_number']= $request->mobile_number;
        $data['address']=$request->address;

        $customer_id=DB::table('tbl_customer')
                        ->insertGetId($data);
                 Session::put('customer_id',$customer_id);
                 Session::put('customer_name',$request->customer_name);
                 return redirect('/checkout');       
    }


    public function customer_login(Request $request)
    {
        $customer_email=$request->customer_email;
        $password=md5($request->password);
        $result=DB::table('tbl_customer')
                ->where('customer_email',$customer_email)
                ->where('password',$password)
                ->first();
               // echo "<pre>";
               // print_r($result);
                //exit();

                if($result)
                {       
                       $request->session()->put('customer_name', $result->customer_name);
                       $request->session()->put('customer_id', $result->customer_id);

                 
                       return redirect('/checkout'); 
                }
                else
                {
                    $request->session()->flash('message', 'invalid username/password');
                    return redirect('/login-check');
                }

    }


    public function checkout()
    {
        return view('pages\checkout');
    }


    public function save_shipping_details(Request $request)
    {
        

        $data=array();
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_name']=$request->shipping_name;
        $data['address']=$request->address;
        $data['mobile_number']= $request->mobile_number;
        $data['customer_id']= $request->customer_id;
        
        $shipping_id=DB::table('tbl_shipping')
                        ->insertGetId($data);
                        Session::put('shipping_id',$shipping_id);
                        return redirect('/payment');
                
                
    } 
    
    public function payment(Request $request)
    {
        $all_published_category=DB::table('tbl_category')
                                ->where('publication_status',1)
                                ->get();

                                $manage_published_category= view('pages\payment')
                                ->with('all_published_category',$all_published_category);
                                return view('layout')
                                ->with('pages\payment',$manage_published_category);
  
    }

    public function place_order(Request $request)
    {
        $payment_gateway=$request->payment_gateway;
        $pData=array();
        $pData['payment_method']=$payment_gateway;    
        $pData['payment_status']='pending';

        $payment_id=DB::table('tbl_payment')
                ->insertGetId($pData);
    
        //$contents=Cart::content();
        //echo $contents;

        $oData=array();
        $oData['customer_id']=Session::get('customer_id');
        $oData['shipping_id']=Session::get('shipping_id');    
        $oData['payment_id']=$payment_id;
        $oData['order_total']=Cart::total();
        $oData['order_status']='pending';

        $order_id=DB::table('tbl_order')
                ->insertGetId($oData);
        
        $contents=Cart::content();        
        $odData=array();
        foreach($contents as $content)
        {
            $odData['order_id']=$order_id;
            $odData['product_id']=$content->id;
            $odData['product_name']=$content->name;
            $odData['product_price']=$content->price;
            $odData['product_sales_quantity']=$content->qty;
            
            $order_id=DB::table('tbl_order_details')
                ->insert($odData);
        
        }

        if($payment_gateway=='handcash')
        {   
            Cart::destroy();
            return view('pages/handcash');
            
        }
        elseif($payment_gateway=='bkash')
        {
            echo "order placed by bkash";
        }
        elseif($payment_gateway=='paypal')
        {
            echo "order placed by paypal";
        }

    }


    public function manage_order(Request $request)
    {
        $all_order_info = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')
        ->get();

$manage_order= view('admin\manage_order')
->with('all_order_info',$all_order_info);
return view('admin_layout')
->with('admin\manage_order',$manage_order);

    }
    
    public function view_order($order_id)
    {
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->select('tbl_order.*','tbl_order_details.*','tbl_customer.*','tbl_shipping.*')
        ->first();

$view_order= view('admin\view_order')
->with('order_by_id',$order_by_id);
return view('admin_layout')
->with('admin\view_order',$view_order);
 
    }

    public function inactive_order(Request $request,$order_id)
    {
      // echo($category_id);

      DB::table('tbl_order')
         ->where('order_id',$order_id)
         ->update(['order_status'=> 'pending' ]);

         $request->session()->flash('message', 'status deativated of order ID: '.$order_id);

         return redirect("/manage-order");
    }

    public function active_order(Request $request, $order_id)
    {
      // echo($category_id);

      DB::table('tbl_order')
         ->where('order_id',$order_id)
         ->update(['order_status'=> 'approved' ]);
         
         $request->session()->flash('message', 'status activated of order ID: '.$order_id);


         return redirect("/manage-order");
    }

    public function delete_order(Request $request, $order_id)
    {

      DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->delete();

     $request->session()->flash('message', 'order ID: '.$order_id.' deleted successfully');

     return redirect("/manage-order");
    }

}
