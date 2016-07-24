
	@extends('template.layout-main')
	@section('content')

		<script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>

		@include('template.nav-admin')

	    <div id="page-wrapper">
	    	<div class="row">
	    		<h3 class="lg-margin-top md-margin-left lg-margin-bottom">Create {{ ucwords(Request::segment(1)) }}</h3>
	    		<div class="col-sm-12">
					<ol class="breadcrumb">
						<li><a href="{{ url(Request::segment(1)) }}">{{ ucwords(Request::segment(1)) }} Management</a></li>
						<li>Create {{ ucwords(Request::segment(1)) }}</li>
					</ol>
	    			@if ($errors->any())
						<div class="alert alert-danger">
							<p><i class="fa fa-exclamation-triangle"></i>
							@foreach ($errors->all() as $error)
								{{ $error }}
							@endforeach
							</p>
						</div>
					@endif
    				{!! Form::open(array('route' => 'account.store')) !!}
    					<div class="row">
    						<div class="col-sm-6">
    							<div class="form-group">
		    						<label>First Name</label>
									<input type="text" class="form-control" name="first_name" placeholder="First Name" />
		    					</div>
    						</div>
    						<div class="col-sm-6">
    							<div class="form-group">
		    						<label>Last Name</label>
									<input type="text" class="form-control" name="last_name" placeholder="Last Name" />
		    					</div>
    						</div>
    					</div>
						<div class="form-group">
    						<label>Address Line</label>
							<input type="text" class="form-control" name="address" placeholder="Address" />
    					</div>
    					<div class="row">
    						<div class="col-sm-6">
    							<div class="form-group">
		    						<label>Province</label>
									<input type="text" class="form-control" name="province" placeholder="Province" />
		    					</div>
    						</div>
    						<div class="col-sm-6">
    							<div class="form-group">
		    						<label>City</label>
									<input type="text" class="form-control" name="city" placeholder="City" />
		    					</div>
    						</div>
    					</div>
    					<div class="row">
    						<div class="col-sm-6">
    							<div class="form-group">
		    						<label>User Type</label>
		    						<select class="form-control" name="user_type">
		    							<option selected disabled>Select User Type</option>
		    							@foreach ($user_types as $user_type)
		    								<option value="{{ $user_type->id }}">{{ $user_type->user_type_label }}</option>
		    							@endforeach
		    						</select>
		    					</div>
    						</div>
    						<div class="col-sm-6">
    							<div class="form-group">
		    						<label>Cluster</label>
		    						<select class="form-control" name="cluster">
		    							<option selected disabled>Select Cluster</option>
		    							@foreach ($clusters->data as $cluster)
		    								@if (Auth::user()->user_type_id > 1)
		    									@if (Auth::user()->cluster_id == $cluster->id)
		    										<option value="{{ $cluster->id }}">{{ $cluster->name }}</option>
		    									@endif
		    								@else
		    									<option value="{{ $cluster->id }}">{{ $cluster->name }}</option>
		    								@endif
		    							@endforeach
		    						</select>
		    					</div>
    						</div>
    					</div>
    					<div class="row">
    						<div class="col-sm-6">
    							<div class="form-group">
		    						<label>Email</label>
									<input type="email" class="form-control" name="email" placeholder="Email" />
		    					</div>
    						</div>
    					</div>
    					<div class="row">
    						<div class="col-sm-6">
    							<div class="form-group">
		    						<label>Password</label>
									<input type="password" class="form-control" name="password" placeholder="Password" />
		    					</div>
    						</div>
    						<div class="col-sm-6">
    							<div class="form-group">
		    						<label>Confirm Password</label>
									<input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" />
		    					</div>
    						</div>
    					</div>

						<div class="form-group">
							<button class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
							<a href="{{ url('advisory') }}" class="btn btn-warning"><i class="fa fa-close"></i> Cancel</a>
						</div>
    				{!! Form::close() !!}
	    		</div>
    		</div>
		</div>	

	@stop