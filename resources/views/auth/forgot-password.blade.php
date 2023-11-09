@extends('layouts.guest')
@section('title', 'Login')
@section('content')
<section class="login-block">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<!-- Authentication card start -->

				<form class="md-float-material form-material" action="{{ route('password.email') }}" method="POST">
					@csrf
					<div class="text-center">
						<img src="{{ asset('assets/images/logo.png') }}" alt="logo.png" width="300">
					</div>
					<div class="auth-box card">
						<div class="card-block">
							<div class="row m-b-20">
								<div class="col-md-12">
									<h3 class="text-left">{{ __('Recover your password') }}</h3>
								</div>
							</div>
							@if ($errors->any())
							<div class="row">
								<div class="col-md-12">
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
							@endif

							@if (session('status'))
							<div class="row">
								<div class="col-12">
									<div class="alert alert-success" role="alert">{{ session('status') }}</div>
								</div>
							</div>
							@endif

							<div class="form-group form-primary">
								<input type="email" name="email" class="form-control" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">{{ __('Email Password Reset Link')}}</button>
								</div>
							</div>
							<hr>
							<div class="row">
                                <div class="col-md-6">
                                    <p class="text-inverse text-left m-b-0">{{ __('Terms and conditions') }}</p>
                                </div>
                            </div>
						</div>
					</div>
				</form>
			</div>
			<!-- end of col-sm-12 -->
		</div>
		<!-- end of row -->
	</div>
	<!-- end of container-fluid -->
</section>
@endsection