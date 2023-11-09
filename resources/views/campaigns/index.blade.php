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
                        <h4>Campañas</h4>
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
                        <h5>Campañas</h5>
                        <div class="card-header-right">
                            <a href="{{ route('campaigns.create') }}" class="btn btn-primary">Crear</a>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Porcentaje de administración</th>
                                        <th>Valor</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($campaigns as $campaign)
                                    <tr>
                                        <td>{{ $campaign->id }}</td>
                                        <td>{{ $campaign->name }}</td>
                                        <td>{{ number_format($campaign->percent, 0)  }} %</td>
                                        <td>{{ number_format($campaign->value, 0) }} {{ $campaign->currency }}</td>
                                        <td>
                                            <div class="icon-btn">
                                                <a href="{{ route('campaigns.edit', $campaign) }}" class="btn btn-info btn-icon"><i class="icofont icofont-ui-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection