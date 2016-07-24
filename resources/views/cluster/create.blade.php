
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
    				{!! Form::open(array('route' => 'cluster.store')) !!}
    					<div class="form-group">
    						<label>Cluster Name</label>
							<input type="text" class="form-control" name="cluster_name" placeholder="Cluster Name" />
    					</div>
    					<div class="form-group">
    						<label>Cluster Code</label>
							<input type="text" class="form-control btn-25" name="cluster_code" placeholder="Cluster Code" />
    					</div>
    					<div class="form-group">
    						<label>Description</label>
    						<textarea class="form-control no-resize" name="description" placeholder="Description"></textarea>
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