@extends('admin_layout')
@section('admin_content')


<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Products</h2>
            
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
                      <th>Product ID</th>
                      <th>Product Name</th>
                      <th>Product Image</th>
                      <th>Product Price</th>
                      <th>Product quantity</th>
                      <th>Category Name</th>
                      <th>Manufacture Name</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              
              @foreach ($all_product_info as $product)
                  
              

              <tbody>
                <tr>
                    <td>{{$product->product_id}}</td>
                    <td class="center">{{$product->product_name}}</td>
                <td> <img src="{{ URL::to($product->product_image) }}" style="height: 80px;width:80px;" ></td>
                    <td class="center">{{$product->product_price }}</td>
                    <td class="center">{{$product->product_quantity}}</td>
                    <td class="center">{{$product->category_name}}</td>
                    <td class="center">{{$product->manufacture_name}}</td>
                    <td class="center">
                        @if ($product->publication_status=='1')
                            <span class="label label-success">Active</span>
                    
                        @else
                        <span class="label label-danger">Inactive</span>
                        
                    @endif

                </td>

                    <td class="center">
                        @if ($product->publication_status=="1")
                        <a class="btn btn-warning" href="{{URL::to('/inactive_product/'.$product->product_id)}}">
                            <i class="halflings-icon white thumbs-down"></i>  
                        </a>
                        @else
                        <a class="btn btn-success" href="{{URL::to('/active_product/'.$product->product_id)}}">
                            <i class="halflings-icon white thumbs-up"></i>  
                        </a>    
                        @endif
                        
                        <a class="btn btn-info" href="{{URL::to('/edit_product/'.$product->product_id)}}">
                            <i class="halflings-icon white edit"></i>  
                        </a>
                        <a class="btn btn-danger" id="delete" href="{{URL::to('/delete_product/'.$product->product_id)}}">
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