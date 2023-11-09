@extends('layouts.guest')
@section('title', __('Login'))
@section('content')
<section class="login-block">
	<!-- Container-fluid starts -->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<!-- Authentication card start -->
				<form class="md-float-material form-material" method="POST" action="{{ route('login') }}">
					@csrf
					<div class="text-center">
						<img src="{{ asset('assets/images/logo.png') }}" alt="logo.png" width="300">
					</div>
					<div class="auth-box card">
						<div class="card-block">
							<div class="row m-b-20">
								<div class="col-md-12">
									<h4 class="text-center">Bienvenido</h4>
								</div>
							</div>

							@if ($errors->any())
							<div class="row">
								<div class="col-md-12">
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
											<li>{{ __($error) }}</li>
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
							<div class="form-group form-primary">
								<input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required>
							</div>
							<div class="row m-t-25 text-left">
								<div class="col-12">
									<div class="checkbox-fade fade-in-primary d-">
										<label>
											<input type="checkbox" value="1" name="remember">
											<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
											<span class="text-inverse">{{ __('Remember me')}}</span>
										</label>
									</div>
									<div class="forgot-phone text-right f-right">
										<a href="{{ route('password.request') }}" class="text-right f-w-600">{{ __('Forgot your password?') }}</a>
									</div>
								</div>
							</div>
							<div class="row m-t-30">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Ingresar</button>
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
				<!-- end of form -->
			</div>
			<!-- end of col-sm-12 -->
		</div>
		<!-- end of row -->
	</div>
	<!-- end of container-fluid -->
</section>
@endsection