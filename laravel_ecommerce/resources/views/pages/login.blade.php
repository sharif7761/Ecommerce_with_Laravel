@extends('layout')

@section('content')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h3>Login to your account</h3>
                    @if (session('message'))
						
					<p class="alert-danger">
					
						<h5 class="alert alert-dismissible alert-danger">{{session('message')}}</h5>

				</p>
				@endif

                    <form action="{{url('/customer-login')}}" method="post">
                        @csrf
                        <input type="email" required placeholder="Email Address"  name="customer_email"/>
                        <input type="password" required placeholder="Password" name="password" />
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                <form action="{{url('/customer-registration')}}" method="post">
                        @csrf
                        <input type="text" required placeholder="Full Name" name="customer_name"/>
                        <input type="email" required placeholder="Email Address" name="customer_email"/>
                        <input type="password" required placeholder="Password" name="password"/>
                        <input type="text" required placeholder="Mobile Number" name="mobile_number"/>
                        <input type="text" required placeholder="Address" name="address"/>
                        
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->



@endsection