@extends('admin_layout')
@section('admin_content')

<div class="d-inline-block">

<div class="row-fluid sortable">		
    <div class="box span5">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Customer Details</h2>
            
        </div>
        <div class="box-content">

            @if (session('message'))
						
					<p class="alert-danger">
					
						<h3 class="alert alert-dismissible alert-danger">{{session('message')}}</h3>

				</p>
				@endif

            <table class="table">
              <thead>
                  <tr>
                      <th>Customer Name</th>
                      <th>Mobile</th>
                      
                  </tr>
              </thead>
              
              

              <tbody>
                <tr>
                    <td class="center">{{$order_by_id->customer_name}}</td>
                    <td class="center">{{$order_by_id->mobile_number}}</td>
                    
                </tr>
                
              </tbody>

              
          </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->

<div class="row-fluid sortable">		
    <div class="box span5">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Shipping Details</h2>
            
        </div>
        <div class="box-content">

            
            <table class="table ">
              <thead>
                  <tr>
                      
                      <th>Shipping Name</th>
                      <th>Mobile</th>
                      <th>Address</th>
                      
                  </tr>
              </thead>
              

              <tbody>
                <tr>
                    <td class="center">{{$order_by_id->shipping_name}}</td>
                    <td class="center">{{$order_by_id->mobile_number}}</td>
                    <td class="center">{{$order_by_id->address}}</td>
                    
                </tr>
                
              </tbody>

            
          </table>            
        </div>
    </div><!--order_by_id/span-->

</div><!--/row-->

</div>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Order Details</h2>
            
        </div>
        <div class="box-content">

        

            <table class="table">
              <thead>
                  <tr>
                      <th>Order ID</th>
                      <th>Product Name</th>
                      <th>Product Price</th>
                      <th>Quantity</th>
                      <th>Subtotal</th>
                  </tr>
              </thead>
            
              <tbody>
                      
                
                <tr>
                    <td>{{$order_by_id->order_id}}</td>
                    <td class="center">{{$order_by_id->product_name}}</td>
                    <td class="center">{{$order_by_id->product_price}}</td>
                    <td class="center">{{$order_by_id->product_sales_quantity}}</td>
                    <td class="center">{{$order_by_id->order_total}}</td>
                    
                    
                </tr>
                
              </tbody>

            
          </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->


@endsection