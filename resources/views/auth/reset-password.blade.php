@extends('layouts.guest')
@section('title', __('Reset Password'))
@section('content')
<section class="login-block">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<!-- Authentication card start -->

				<form class="md-float-material form-material" action="{{ route('password.update') }}" method="POST">
					@csrf
					<input type="hidden" name="token" value="{{ $request->route('token') }}">
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
								<input type="email" name="email" class="form-control" placeholder="Your Email Address" value="{{ old('email', $request->email) }}" readonly required>
							</div>

							<div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group form-primary">
                                        <input type="password" name="password" class="form-control @error('password') form-control-danger @enderror" placeholder="{{ __('Password') }}" minlength="8" required>
                                        @error('password')
                                        <span class="messages"><p class="text-danger error">{{ $message }}</p></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-primary">
                                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') form-control-danger @enderror" placeholder="{{ __('Confirm Password') }}" minlength="8" required>
                                        @error('password_confirmation')
                                        <span class="messages"><p class="text-danger error">{{ $message }}</p></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">{{ __('Reset Password') }}</button>
								</div>
							</div>
							<p class="f-w-600 text-right">{{ __('Back to') }} <a href="auth-normal-sign-in.htm">{{ __('Login') }}.</a></p>
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