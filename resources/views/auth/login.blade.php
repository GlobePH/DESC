
	@extends('template.layout-main')
	@section('content')

		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="row">
						<div class="login-container">
							<div class="login-left">
								<div class="avatar-placeholder">
									<img src="{{ asset('images/pages/login/img_user-default.png') }}" />
								</div>
							</div>
							<div class="login-right">
								<p class="sm-margin-bottom no-padding-bottom">Welcome to</p>
								<!-- <h1 class="no-margin-top no-padding-top text-logo">DESC</h1> -->
								<img src="{{ asset('images/pages/login/login_desclogo.png') }}" />
								<div class="clearfix"></div>
								<br />
								<div class="login-inner-content">
									{!! Form::open() !!}
									<div class="form-group">
										<input type="email" class="form-control txtbox" name="email" placeholder="Email" />
									</div>
									<div class="form-group">
										<input type="password" class="form-control txtbox" name="password" placeholder="Password" />
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-100 btn-custom">
											LOGIN
										</button>
									</div>
									{!! Form::close() !!}
									@if ($errors->any())
										<div class="alert alert-danger">
											<p><i class="fa fa-exclamation-triangle"></i>
											@foreach ($errors->all() as $error)
												{{ $error }}
											@endforeach
											</p>
										</div>
									@endif
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	@stop