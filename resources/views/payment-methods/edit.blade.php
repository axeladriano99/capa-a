@extends('layouts.app')
@section('title', 'Métodos de pago')
@section('content')
<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Métodos de pago</h4>
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
            <div class="col-sm-12 col-md-7">
                @include('payment-methods.list')
            </div>

            <div class="col-sm-12 col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Agregar métodos de pagos</h5>
                    </div>
                    <div class="card-block">
                        <form method="POST" action="{{ route('payment-methods.update', $paymentMethodEdit) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $paymentMethodEdit->name) }}">
                            </div>

                            <div class="form-group">
                                <label for="name">Código</label>
                                <input type="text" name="code" id="code" class="form-control" maxlength="20" value="{{ old('code', $paymentMethodEdit->code) }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description', $paymentMethodEdit->description) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="country_id">País</label>
                                <select name="country_id" id="country_id" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" @selected(old('country_id', $paymentMethodEdit->country_id) == $country->id)>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection