@extends('admin_layout')
@section('admin_content')


<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Categories</h2>
            
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
                      <th>Category ID</th>
                      <th>Category Name</th>
                      <th>Category Description</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              
              @foreach ($all_category_info as $category)
                  
              

              <tbody>
                <tr>
                    <td>{{$category->category_id}}</td>
                    <td class="center">{{$category->category_name}}</td>
                    <td class="center">{{$category->category_description}}</td>
                    <td class="center">
                        @if ($category->publication_status=='1')
                            <span class="label label-success">Active</span>
                    
                        @else
                        <span class="label label-danger">Inactive</span>
                        
                    @endif

                </td>

                    <td class="center">
                        @if ($category->publication_status=='1')
                        <a class="btn btn-warning" href="{{URL::to('/inactive_category/'.$category->category_id)}}">
                            <i class="halflings-icon white thumbs-down"></i>  
                        </a>
                        @else
                        <a class="btn btn-success" href="{{URL::to('/active_category/'.$category->category_id)}}">
                            <i class="halflings-icon white thumbs-up"></i>  
                        </a>    
                        @endif
                        
                        <a class="btn btn-info" href="{{URL::to('/edit_category/'.$category->category_id)}}">
                            <i class="halflings-icon white edit"></i>  
                        </a>
                        <a class="btn btn-danger" id="delete" href="{{URL::to('/delete_category/'.$category->category_id)}}">
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