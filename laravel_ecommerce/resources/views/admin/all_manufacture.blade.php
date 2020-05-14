@extends('admin_layout')
@section('admin_content')


<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Manufacturers</h2>
            
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
                      <th>Manufacture ID</th>
                      <th>Manufacture Name</th>
                      <th>Manufacture Description</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              
              @foreach ($all_manufacture_info as $manufacture)
                  
              

              <tbody>
                <tr>
                    <td>{{$manufacture->manufacture_id}}</td>
                    <td class="center">{{$manufacture->manufacture_name}}</td>
                    <td class="center">{{$manufacture->manufacture_description}}</td>
                    <td class="center">
                        @if ($manufacture->publication_status=='1')
                            <span class="label label-success">Active</span>
                    
                        @else
                        <span class="label label-danger">Inactive</span>
                        
                    @endif

                </td>

                    <td class="center">
                        @if ($manufacture->publication_status=='1')
                        <a class="btn btn-warning" href="{{URL::to('/inactive_manufacture/'.$manufacture->manufacture_id)}}">
                            <i class="halflings-icon white thumbs-down"></i>  
                        </a>
                        @else
                        <a class="btn btn-success" href="{{URL::to('/active_manufacture/'.$manufacture->manufacture_id)}}">
                            <i class="halflings-icon white thumbs-up"></i>  
                        </a>    
                        @endif
                        
                        <a class="btn btn-info" href="{{URL::to('/edit_manufacture/'.$manufacture->manufacture_id)}}">
                            <i class="halflings-icon white edit"></i>  
                        </a>
                        <a class="btn btn-danger" id="delete" href="{{URL::to('/delete_manufacture/'.$manufacture->manufacture_id)}}">
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