@extends('layouts.app')
@section('title', 'Campañas')
@section('content')
<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Editar Campaña</h4>
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
                        <h5>Editar Campaña</h5>
                    </div>
                    <div class="card-block">
                        <form method="POST" action="{{ route('campaigns.update', $campaign) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $campaign->name) }}">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="percent">Porcentaje de administración</label>
                                        <input type="number" name="percent" id="percent" class="form-control" step="0.01" min="0" value="{{ old('percent', $campaign->percent) }}">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="value">Valor</label>
                                        <input type="number" name="value" id="value" class="form-control" step="0.01" value="{{ old('value', $campaign->value) }}">
                                    </div>
                                </div>

                                <input type="hidden" name="duration" id="duration" value="22">


                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duration">Duración días</label>
                                        <select name="duration" id="duration" @class(["form-control", 'form-control-danger' => $errors->has('duration')]) required>
                                            <option value="11" @selected(old('duration', $campaign->duration) == 11)>11 Días</option>
                                            <option value="22" @selected(old('duration', $campaign->duration) == 22)>22 Días</option>
                                            <option value="33" @selected(old('duration', $campaign->duration) == 33)>33 Días</option>
                                            <option value="44" @selected(old('duration',$campaign->duration) == 44)>44 Días</option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="currency">Divisa</label>
                                        <input type="text" name="currency" id="currency" class="form-control" value="{{ old('currency', $campaign->currency) }}" required>
                                        
                                        @error('currency')
                                        <span class="messages"><p class="text-danger error">{{ $message }}</p></span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6 d-none">
                                    <div class="form-group">
                                        <label for="payment_method_id">Método de pago</label>
                                        <select name="payment_method_id" id="payment_method_id" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            @foreach($paymentMethods as $paymentMethod)
                                            <option value="{{ $paymentMethod->id }}" @selected(old('payment_method_id', $campaign->payment_method_id) == $paymentMethod->id)>{{ $paymentMethod->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6 d-none">
                                    <div class="form-group">
                                        <label for="reference_method">Referencia</label>
                                        <input type="text" name="reference_method" id="reference_method" class="form-control" value="{{ old('reference_method', $campaign->reference_method) }}">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country_id">País</label>
                                        <select name="country_id" id="country_id" class="form-control">
                                            <option value="">Seleccione</option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->id }}" @selected(old('country_id', $campaign->country_id) == $country->id)>{{ $country->name }}</option>
                                            @endforeach
                                            
                                        </select>
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