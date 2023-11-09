@extends('layouts.guest')
@section('title', __('Login'))
@section('content')
<section class="login-block">
	<!-- Container-fluid starts -->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<!-- Authentication card start -->
				<form class="md-float-material form-material" method="POST">
					@csrf
					<div class="text-center">
						<img src="{{ asset('assets/images/logo.png') }}" alt="logo.png" width="300">
					</div>
					<div class="auth-box card">
						<div class="card-block">
							<div class="row m-b-20">
								<div class="col-md-12">
									<h4 class="text-center">Registro</h4>
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
								<input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ old('name') }}" required autofocus>
							</div>
							<div class="form-group form-primary">
								<input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required>
							</div>
							<div class="form-group form-primary">
								<input type="text" name="phone" class="form-control" placeholder="Teléfono" value="{{ old('phone') }}" required>
							</div>
							<div class="form-group form-primary">
								<input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required>
							</div>
							<div class="form-group form-primary">
								<input type="password" name="password_confirmation" class="form-control" placeholder="Confirme su contraseña" required>
							</div>
							
							<div class="row m-t-30">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Registrarme</button>
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