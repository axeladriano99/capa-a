@extends('layouts.app')
@section('title', 'Campañas')
@push('styles')
    <!-- Treeview css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/jstree/css/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/treeview/treeview.css') }}">
@endpush
@section('content')
<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Mi red</h4>
                        <span>Consulte aquí los miembros de su red</span>
                        campaigns
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item">Mi cuenta
                        </li>
                        <li class="breadcrumb-item">Mi red
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
       
    <!-- Page-body start -->
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <!-- Basic Tree card start -->
                <div class="card">
                    <div class="card-header">
                        <h5>Mi red - campaña</h5>
                        <div class="card-header-right">
                            <select class="form-control" id="select_campaing">
                                @foreach($campaigns as $campaign)
                                <option value="{{ $campaign->id }}" @selected($campaign_selected == $campaign->id)>{{ $campaign->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-block tree-view">
                        <div id="new-referrals-tree">
                            <ul>
                                @if(!is_null($cpr->parent?->parent?->parent))
                                
                                <li data-jstree='{"opened":true}'>
                                    {{ $cpr->parent?->parent?->parent->to->name }} - ({{ $cpr->parent?->parent?->parent->to->phone }})
                                    <ul>
                                        @endif

                                        @if(!is_null($cpr->parent?->parent))
                                        
                                        <li data-jstree='{"opened":true}'>
                                            {{ $cpr->parent?->parent->to->name }} - ({{ $cpr->parent?->parent->to->phone }})
                                            <ul>
                                                @endif
                                                @if(!is_null($cpr->parent))
                                                <li data-jstree='{"opened":true}'>
                                                    {{ $cpr->parent->to->name }} - ({{ $cpr->parent->to->phone }})
                                                    <ul>
                                                        @endif
                                                        <li data-jstree='{"opened":true}'>
                                                            {{ $cpr->to->name }} - ({{ $cpr->to->phone }})
                                                            {{-- pendiente por devolver: ${{ $cpr->repayment_pending }} --}}
                                                            ganancias: {{ $cpr->profits }} {{ $cpr->campaign->currency }}

                                                            @if($cpr->children_referrals()->where('campaign_id', $campaign_selected)->count())
                                                                <ul>
                                                                @foreach($cpr->children_referrals()->where('campaign_id', $campaign_selected)->get() as $children_referred)
                                                                    @include('networks.children-referred', ['children_referred' => $children_referred, 's' => $campaign_selected, 'level' => 1])
                                                                @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                        @if(!is_null($cpr->parent))
                                                    </ul> 
                                                </li>
                                                @endif
                                                @if(!is_null($cpr->parent?->parent))
                                            </ul>
                                        </li>
                                        @endif
                                    @if(!is_null($cpr->parent?->parent?->parent))
                                    </ul>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>


                    {{-- <div class="card-block tree-view">
                        <div id="referrals-tree">
                            <ul>
                                @foreach($campaign_referrals as $referred)
                                    <li data-jstree='{"opened":true}'>{{ $referred->to->name }}

                                        @if($referred->children_referrals()->where('campaign_id', $campaign_selected)->count())
                                            <ul>
                                            @foreach($referred->children_referrals()->where('campaign_id', $campaign_selected)->get() as $children_referred)
                                                @include('networks.children-referred', ['children_referred' => $children_referred, 's' => $campaign_selected])
                                            @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div> --}}

                </div>
                <!-- Basic Tree card end -->
            </div>
        </div>
    </div>
    <!-- Page-body end -->
</div>
@endsection
@push('scripts')
    <!-- Tree view js -->
    <script type="text/javascript" src="{{ asset('bower_components\jstree\js\jstree.min.js') }}"></script>
    <!--script type="text/javascript" src="{{ asset('assets\pages\treeview\jquery.tree.js') }}"></script-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#select_campaing').change(function(event) {
                var c = $(this).val()
                window.location.href =  "{{ route('networks.index') }}/"+c;
            });
            
            $('#referrals-tree').jstree({
                'core' : {
                    'themes' : {
                        'responsive': false
                    }
                },
                'types' : {
                    'default' : {
                        'icon' : 'icofont icofont-ui-user'
                    },
                    'file' : {
                        'icon' : 'icofont icofont-file-alt'
                    }
                },
                'plugins' : ['types']
            });
            $('#new-referrals-tree').jstree({
                'core' : {
                    'themes' : {
                        'responsive': false
                    }
                },
                'types' : {
                    'default' : {
                        'icon' : 'icofont icofont-ui-user'
                    },
                    'file' : {
                        'icon' : 'icofont icofont-file-alt'
                    }
                },
                'plugins' : ['types']
            });
        });
    </script>
@endpush


