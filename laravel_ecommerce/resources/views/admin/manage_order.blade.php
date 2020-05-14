@extends('admin_layout')
@section('admin_content')


<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Orders</h2>
            
        </div>
        <div class="box-content">

            @if (session('message'))
						
					<p class="alert-danger">
					
						<h3 class="alert alert-dismissible alert-danger">{{session('message')}}</h3>

				</p>
				@endif

            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                  <tr>
                      <th>Order ID</th>
                      <th>Customer Name</th>
                      <th>Order Total</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              
              @foreach ($all_order_info as $order)
                  
              

              <tbody>
                <tr>
                    <td>{{$order->order_id}}</td>
                    <td class="center">{{$order->customer_name}}</td>
                    <td class="center">{{$order->order_total}}</td>
                    
                    <td class="center">
                        @if ($order->order_status=='approved')
                            <span class="label label-success">Approved</span>
                    
                        @else
                        <span class="label label-danger">Pending</span>
                        
                    @endif

                </td>

                <td class="center">
                    @if ($order->order_status=='approved')
                    <a class="btn btn-warning" href="{{URL::to('/inactive_order/'.$order->order_id)}}">
                        <i class="halflings-icon white thumbs-down"></i>  
                    </a>
                    @else
                    <a class="btn btn-success" href="{{URL::to('/active_order/'.$order->order_id)}}">
                        <i class="halflings-icon white thumbs-up"></i>  
                    </a>    
                    @endif
                    
                    <a class="btn btn-info" href="{{URL::to('/view_order/'.$order->order_id)}}">
                        <i class="halflings-icon white edit"></i>  
                    </a>
                    <a class="btn btn-danger" id="delete" href="{{URL::to('/delete_order/'.$order->order_id)}}">
                        <i class="halflings-icon white trash"></i> 
                    </a>
                </td>
                </tr>
                
              </tbody>

              @endforeach

          </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->



@endsection