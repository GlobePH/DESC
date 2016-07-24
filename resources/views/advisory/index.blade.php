
	@extends('template.layout-main')
	@section('content')

		@include('template.nav-admin')

	    <div id="page-wrapper">
	    	<div class="row">
	    		<h3 class="lg-margin-top md-margin-left lg-margin-bottom">Public Advisory</h3>
	    		@if ($message)
	    			<div class="alert alert-success">
		    			<i class="fa fa-check"></i> {{ $message }}
		    		</div>
	    		@endif
	    		<div class="col-sm-2">
		    		<div class="row">
		    			<a href="{{ url('advisory/create') }}" class="btn btn-success btn-100">Create Advisory</a>
		    			<br />
		    			<div class="legend-list lg-margin-top">
		    				<h5 class="sm-margin-left"><i class="fa fa-cubes"></i> Cluster Codes</h5>
		    				<hr class="sm-margin-bottom no-margin-top" />
		    				@foreach ($clusters->data as $cluster)
		    					@if (Auth::user()->user_type_id >  1)
			    					@if (Auth::user()->cluster_id == $cluster->id)
				    				<div class="legend-item">
					    				<a href="javascript:void">
					    					<span style="color: #3D4175; margin-right: 10px;">
					    						<i class="fa fa-square"></i>
					    					</span>
					    					{{ $cluster->cluster_code }}
					    				</a>
				    				</div>
				    				@endif
		    					@else
		    						<div class="legend-item">
					    				<a href="javascript:void">
					    					<span style="color: #3D4175; margin-right: 10px;">
					    						<i class="fa fa-square"></i>
					    					</span>
					    					{{ $cluster->cluster_code }}
					    				</a>
				    				</div>
		    					@endif
		    				@endforeach
		    			</div>
		    		</div>
	    		</div>
	    		<div class="col-sm-10">
	    			<div class="col-sm-12">

		    			<div class="row">
		    				<div class="col-sm-5">
	    						<h3 class="no-margin-top">MMDA Advisories</h3>
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
		    							<p class="text-center"><small><a href="{{ url('advisory') }}"><i class="fa fa-trash"></i> Clear Search</a></small></p>
		    						@endif
		    					@endif
		    					<table class="table table-striped table-advisory">
		    						<tr>
		    							<th><i class="fa fa-folder-open"></i></th>
		    							<th>Date Published</th>
		    							<th>Date Title</th>
		    							<th>Created By</th>
		    							<th>Cluster</th>
		    						</tr>
		    						@foreach ($results as $advisory)
		    							<tr>
		    								<td><i class="fa fa-folder-open"></i></td>
		    								<td>{{ \Carbon\Carbon::parse($advisory->created_at)->format('m/j/Y h:i:s A') }}</td>
		    								<td>{{ $advisory->name }}</td>
		    								<td>{{ $advisory->user->email }}</td>
		    								<td>{{ $advisory->cluster->cluster_code }}</td>
		    							</tr>
		    						@endforeach
		    					</table>
		    					{!! $results->render(); !!}
		    				</div>
		    			</div>
	    			</div>
	    		</div>
	    	</div>
	    </div>

	@stop