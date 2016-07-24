
	@extends('template.layout-main')
	@section('content')

		@include('template.nav-admin')

	    <div id="page-wrapper">
	    	<div class="row">
	    		<h3 class="lg-margin-top md-margin-left lg-margin-bottom">Cluster Management</h3>
	    		@if ($message)
	    			<div class="alert alert-success">
		    			<i class="fa fa-check"></i> {{ $message }}
		    		</div>
	    		@endif

    			<div class="col-sm-12">

	    			<div class="row">
	    				<div class="col-sm-5">
	    					<a href="{{ url(Request::segment(1).'/create') }}" class="btn btn-success btn-50">Create Cluster</a>
	    				</div>
		    			<div class="col-sm-5 pull-right">
		    				<form>
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search" name="q">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
									</span>
								</div>
							</form>
		    			</div>
	    			</div>

	    			<div class="row lg-margin-top">
	    				<div class="col-sm-12">
	    					@if (isset($_GET['q']))
	    						@if ($_GET['q'])
	    							<p class="text-center"><small><a href="{{ url('cluster') }}"><i class="fa fa-trash"></i> Clear Search</a></small></p>
	    						@endif
	    					@endif
	    					<table class="table table-striped table-advisory">
	    						<tr>
	    							<th><i class="fa fa-folder-open"></i></th>
	    							<th>Date Created</th>
	    							<th>Cluster Name</th>
	    							<th>Cluster Code</th>
	    						</tr>
	    						@foreach ($results as $cluster)
	    							<tr>
	    								<td><i class="fa fa-folder-open"></i></td>
	    								<td>{{ \Carbon\Carbon::parse($cluster->created_at)->format('m/j/Y h:i:s A') }}</td>
	    								<td>{{ $cluster->name }}</td>
	    								<td>{{ $cluster->cluster_code }}</td>
	    							</tr>
	    						@endforeach
	    					</table>
	    					{!! $results->render(); !!}
	    				</div>
	    			</div>
    			</div>

	    	</div>
	    </div>

	@stop