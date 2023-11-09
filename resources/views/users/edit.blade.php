@extends('layouts.app')
@section('title', 'Usuarios')
@section('content')
<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Editar Usuario</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Widget</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Editar Usuario</h5>
                    </div>
                    <div class="card-block">
                        <form method="POST" action="{{ route('users.update', $user) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
                                        @error('name')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Correo electrónico</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                                        @error('email')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Teléfono</label>
                                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone) }}" maxlength="20">
                                        @error('phone')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reference_method">Referencia</label>
                                        <input type="text" name="reference_method" id="reference_method" class="form-control" value="{{ old('reference_method', $user->reference_method) }}">
                                        @error('reference_method')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_method_id">Método de pago</label>
                                        <select name="payment_method_id" id="payment_method_id" class="form-control">
                                            <option value="">Seleccione</option>
                                            @foreach($paymentMethods as $paymentMethod)
                                            <option value="{{ $paymentMethod->id }}" @selected(old('payment_method_id', $user->payment_method_id) == $paymentMethod->id)>{{ $paymentMethod->name }}</option>
                                            @endforeach
                                            
                                        </select>
                                        @error('payment_method_id')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_data">Tel/Email/Cta paypal/nequi y otros</label>
                                        <input type="text" name="payment_data" id="payment_data" class="form-control" value="{{ old('payment_data', $user->payment_data) }}">
                                        @error('payment_data')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="role_id">Rol</label>
                                        <select name="role_id" id="role_id" class="form-control">
                                            <option value="">Seleccione</option>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id) == $role->id)>{{ $role->name }}</option>
                                            @endforeach
                                            
                                        </select>
                                        @error('role_id')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                        @error('password')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirme contraseña</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                                <a href="{{ route('campaigns.index') }}" class="btn btn-secondary float-right">Cancelar</a>
                            </div>
                            
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection