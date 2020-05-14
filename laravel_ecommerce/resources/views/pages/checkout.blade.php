@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">

        <div class="register-req">
            <p>Please fillup this form...........</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Shipping Details</p>
                        <div class="form-one">
                        <form action="{{url('/save_shipping_details')}}" method="post">
                                @csrf
                                <input type="text" placeholder="Email*" name="shipping_email">
                                <input type="text" placeholder="First Name *" name="shipping_name">
                        
                                <input type="text" placeholder="Address  *" name="address">
                                <input type="text" placeholder="Mobile Number *" name="mobile_number">
                        <input type="hidden"  name="customer_id" value="{{$customer_id=Session::get('customer_id')}}">
                                
                                <input type="submit" class="btn btn-warning" value="C O N F I R M" style="color: rgb(13, 137, 238); font-weight:bold;">
                                 
                                </form>
                        </div>
                        
                    </div>
                </div>
                					
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

         
    </div>
</section> <!--/#cart_items-->


@endsection