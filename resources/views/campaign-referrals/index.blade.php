@extends('layouts.app')
@section('title', 'Referidos')
@push('styles')
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
@endpush
@section('content')
<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Referidos</h4>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-block">
                        <ul>
                            @foreach($campaigns as $campaign)
                            @if($campaign->invitations()->where('user_id', Auth::id())->count() < 2)
                            <li>{{ $campaign->name}} - {{ url('join-me/'.md5($campaign->id).'/'.md5(Auth::id())) }}</li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Invitaciones</h5>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table" id="inv-table" url="{{ route('users.list') }}">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Campaña</th>
                                        <th>Correo</th>
                                        <th>Enviada</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invitations as $invitation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $invitation->campaign->name }}</td>
                                        <td>{{ $invitation->email }}</td>
                                        <td>{{ $invitation->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="icon-btn">
                                                @if(!$invitation->used)
                                                <a href="{{ route('campaign-invitations.destroy', $invitation) }}" class="btn btn-danger btn-icon del-inv"><i class="icofont icofont-ui-edit"></i></a>
                                                @endif
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                        <form method="POST" id="form-del-inv">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Invitar</h5>
                    </div>
                    <div class="card-block">
                        <form method="POST" action="{{ route('campaign-referrals.store') }}" id="form-campaing-ref">
                            @csrf
                            <div class="form-group">
                                <label>Campaña</label>
                                <select name="campaign_id" @class(["form-control", 'form-control-danger' => $errors->has('campaign_id')])>
                                    <option value="">Seleccione</option>
                                    @foreach($campaigns as $campaign)
                                    @if($campaign->invitations()->where('user_id', Auth::id())->count() < 2)
                                    <option value="{{ $campaign->id }}" @selected(old('campaign_id') == $campaign->id)>{{ $campaign->name }}</option>
                                    @endif
                                    
                                    @endforeach
                                </select>
                                @error('campaign_id')
                                <span class="messages"><p class="text-danger error">{{ $message }}</p></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <input type="email" name="email" id="email" @class(["form-control", 'form-control-danger' => $errors->has('email')]) value="{{ old('email') }}">
                                @error('email')
                                <span class="messages"><p class="text-danger error">{{ $message }}</p></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btn-send">
                                    <span id="btn-text">Enviar</span>
                                    <div class="preloader3 loader-block d-none" style="height: 20px; padding-top: 20px;">
                                        <div class="circ1 bg-white"></div>
                                        <div class="circ2 bg-white"></div>
                                        <div class="circ3 bg-white"></div>
                                        <div class="circ4 bg-white"></div>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Mis referidos</h5>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table" id="inv-table" url="{{ route('users.list') }}">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Campaña</th>
                                        <th>Registrado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($referrals as $referred)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $referred->to->name }}</td>
                                        <td>{{ $referred->to->email }}</td>
                                        <td>{{ $referred->campaign->name }}</td>
                                        <td>
                                            {{ $referred->created_at->diffForHumans() }}
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                        <form method="POST" id="form-del-inv">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <!-- data-table js -->
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/campaigns/campaign-invitations-index.js') }}"></script>
@endpush
