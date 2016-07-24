
	@extends('template.layout-main')
	@section('content')

		@include('template.nav-admin')

        <script src="https://cdn.socket.io/socket.io-1.0.0.js"></script>
		<script>
			$(document).ready(function() {
				var socket = io('https://descdev-dyleenwilard.c9users.io:8082', {query:"user_id=1"});
				socket.on('notification.1', function (refNum) {
					$.get('{{ url("api/modules/ticket/reference/") }}/'+refNum, function(result) {
						var response = result;
						$('.ticket-placeholder').prepend('<div class="col-sm-3"><div class="ticket-item"><div class="ti-header">'+response.inbound.number+'<span class="pull-right"><small>'+response.inbound.time_received+'</small></span></div><div class="ti-body"><p class="no-padding no-margin">'+response.inbound.message+'</p></div><div class="ti-footer"><textarea class="form-control tif-reply-area" placeholder="Reply"></textarea></div></div>');
					});
				});

				$('.tif-reply-area').val('');
				
				$(".tif-reply-area").keyup(function(event){
					if (event.keyCode == 13) {
				        var content = this.value;          
				        if(event.shiftKey){

				        } else {
				        	$.post('{{ url("close-ticket") }}', {
				        		'ticket_id' : $(this).attr('id'),
				        		'message'	: content
				        	}, function(data) {
			        			$('#ticket-item-holder-'+data.ticket_id).remove();
				        	});
				        }
				    }
				});

				$(".tif-reply-area").keyup(function(event){
					event.preventDefault();
				});

			});
		</script>

	    <div id="page-wrapper">
	    	<div class="row">
	    		<!-- <h1>Dashboard</h1>
	    		<hr /> -->
	    		<br />
	    		<div class="col-sm-12">

	    			<div class="row ticket-placeholder">
	    				@foreach ($tickets as $ticket)
				    		<div class="col-sm-3" id="ticket-item-holder-{{ $ticket->id }}">
				    			<div class="ticket-item">
				    				<div class="ti-header">
				    					{{ $ticket->inbound->number }}
				    					<span class="pull-right">
				    						<small>{{ $ticket->created_at }}</small>
				    					</span>
				    				</div>
				    				<div class="ti-body">
				    					<p class="no-padding no-margin">
				    					{{ $ticket->inbound->message}}
				    					</p>
				    				</div>
				    				<div class="ti-footer">
				    					<textarea class="form-control tif-reply-area" id="{{ $ticket->id }}" placeholder="Reply"></textarea>
				    				</div>
				    			</div>
				    		</div>
	    				@endforeach
			    		
	    			</div>
	    		</div>
	    	</div>
	    </div>

	@stop