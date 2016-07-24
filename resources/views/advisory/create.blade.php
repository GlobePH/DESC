
	@extends('template.layout-main')
	@section('content')

		<script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>

		@include('template.nav-admin')

	    <div id="page-wrapper">
	    	<div class="row">
	    		<h3 class="lg-margin-top md-margin-left lg-margin-bottom">Create {{ ucwords(Request::segment(1)) }}</h3>
	    		<div class="col-sm-12">
					<ol class="breadcrumb">
						<li><a href="{{ url(Request::segment(1)) }}">{{ ucwords(Request::segment(1)) }}</a></li>
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
    				{!! Form::open(array('route' => 'advisory.store')) !!}
    					<div class="alert alert-info">
    						<i class="fa fa-info-circle"></i> Publishing this advisory will automatically send and sms advisory to all mobile numbers that have originated using the selected cluster code.
    					</div>
    					<div class="form-group">
    						<label>Advisory Title</label>
							<input type="text" class="form-control" name="name" placeholder="Title" />
    					</div>
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
    					<div class="form-group">
    						<label>Summary</label>
    						<textarea class="form-control no-resize" name="summary" placeholder="Summary"></textarea>
    					</div>
						<div class="form-group">
							<label>Content</label>
							<textarea id="content" name="content"></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
							<a href="{{ url('advisory') }}" class="btn btn-warning"><i class="fa fa-close"></i> Cancel</a>
						</div>
    				{!! Form::close() !!}
	    		</div>
    		</div>
		</div>	

		<script type="text/javascript">
			$(document).ready(function() {
				// CKEditor
				CKEDITOR.replace('content');
			});
		</script>
	@stop