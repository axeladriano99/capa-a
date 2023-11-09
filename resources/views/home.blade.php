@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>{{ __('Welcome') }} {{ Auth::user()->full_name }}</h4>
                        <span>{{ __('Here you will find a summary of your management') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="page-body">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="text-white">3</h4>
                                <h6 class="text-white m-b-0">Pagos confirmados</h6>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="feather icon-credit-card f-50 text-c-yellow"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p class="text-white m-b-0"><i class="feather icon-credit-card text-white f-14 m-r-10"></i>Ver pagos confirmados</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-c-green update-card">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="text-white">12</h4>
                                <h6 class="text-white m-b-0">pagos reportados</h6>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="feather icon-list f-50 text-c-green"></i>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <p class="text-white m-b-0"><i class="feather icon-list text-white f-14 m-r-10"></i>Ver pagos reportados</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-c-pink update-card">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="text-white">15</h4>
                                <h6 class="text-white m-b-0">Pagos vencidos</h6>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="feather icon-clock f-50 text-c-pink"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Ver pagos vencidos</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-c-lite-green update-card">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="text-white">5</h4>
                                <h6 class="text-white m-b-0">Usuarios activos</h6>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="feather icon-user-check f-50 text-c-blue"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p class="text-white m-b-0"><i class="feather icon-user-check text-white f-14 m-r-10"></i>Ir</p>
                    </div>
                </div>
            </div>




            <div class="col-xl-8 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Últimos pagos confirmados</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="feather icon-maximize full-card"></i></li>
                                <li><i class="feather icon-minus minimize-card"></i></li>
                                <li><i class="feather icon-trash-2 close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover  table-borderless">
                                <thead>
                                    <tr>
                                        <th>
                                        Cliente</th>
                                        <th>F. confirmación</th>
                                        <th>F. pago</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <span>Ashton Cox</span>
                                                <p class="text-muted m-b-0">Ciudad - telefono</p>
                                            </div>
                                        </td>
                                        <td>12/12/2022</td>
                                        <td>12/12/2022</td>
                                        <td class="text-c-blue">$15,652</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <span>Bradley Greer</span>
                                                <p class="text-muted m-b-0">Ciudad - telefono</p>
                                            </div>
                                        </td>
                                        <td>12/12/2022</td>
                                        <td>12/12/2022</td>
                                        <td class="text-c-blue">$18,785</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <span>Brielle Williamson</span>
                                                <p class="text-muted m-b-0">Ciudad - telefono</p>
                                            </div>
                                        </td>
                                        <td>12/12/2022</td>
                                        <td>12/12/2022</td>
                                        <td class="text-c-blue">$9,652</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <span>Cedric Kelly</span>
                                                <p class="text-muted m-b-0">Ciudad - telefono</p>
                                            </div>
                                        </td>
                                        <td>12/12/2022</td>
                                        <td>12/12/2022</td>
                                        <td class="text-c-blue">$7,856</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <a href="#!" class=" b-b-primary text-primary">Ver todos los pagos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-md-12">
                <div class="card user-activity-card">
                    <div class="card-header">
                        <h5>Última actividad</h5>
                    </div>
                    <div class="card-block">
                        <div class="row m-b-25">
                            <div class="col-auto p-r-0">
                                <div class="u-img">
                                    <img src="{{ asset('assets/images/breadcrumb-bg.jpg') }}" alt="user image" class="img-radius cover-img">
                                    <img src="{{ asset('assets/images/avatar-2.jpg') }}" alt="user image" class="img-radius profile-img">
                                </div>
                            </div>
                            <div class="col">
                                <h6 class="m-b-5">John Deo</h6>
                                <p class="text-muted m-b-0">Lorem Ipsum is simply dummy text.</p>
                                <p class="text-muted m-b-0"><i class="feather icon-clock m-r-10"></i>2 min ago</p>
                            </div>
                        </div>
                        <div class="row m-b-25">
                            <div class="col-auto p-r-0">
                                <div class="u-img">
                                    <img src="{{ asset('assets/images/breadcrumb-bg.jpg') }}" alt="user image" class="img-radius cover-img">
                                    <img src="{{ asset('assets/images/avatar-2.jpg') }}" alt="user image" class="img-radius profile-img">
                                </div>
                            </div>
                            <div class="col">
                                <h6 class="m-b-5">John Deo</h6>
                                <p class="text-muted m-b-0">Lorem Ipsum is simply dummy text.</p>
                                <p class="text-muted m-b-0"><i class="feather icon-clock m-r-10"></i>2 min ago</p>
                            </div>
                        </div>
                        <div class="row m-b-25">
                            <div class="col-auto p-r-0">
                                <div class="u-img">
                                    <img src="{{ asset('assets/images/breadcrumb-bg.jpg') }}" alt="user image" class="img-radius cover-img">
                                    <img src="{{ asset('assets/images/avatar-2.jpg') }}" alt="user image" class="img-radius profile-img">
                                </div>
                            </div>
                            <div class="col">
                                <h6 class="m-b-5">John Deo</h6>
                                <p class="text-muted m-b-0">Lorem Ipsum is simply dummy text.</p>
                                <p class="text-muted m-b-0"><i class="feather icon-clock m-r-10"></i>2 min ago</p>
                            </div>
                        </div>
                        <div class="row m-b-5">
                            <div class="col-auto p-r-0">
                                <div class="u-img">
                                    <img src="{{ asset('assets/images/breadcrumb-bg.jpg') }}" alt="user image" class="img-radius cover-img">
                                    <img src="{{ asset('assets/images/avatar-2.jpg') }}" alt="user image" class="img-radius profile-img">
                                </div>
                            </div>
                            <div class="col">
                                <h6 class="m-b-5">John Deo</h6>
                                <p class="text-muted m-b-0">Lorem Ipsum is simply dummy text.</p>
                                <p class="text-muted m-b-0"><i class="feather icon-clock m-r-10"></i>2 min ago</p>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="#!" class="b-b-primary text-primary">Ver todo</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@push('scripts')
<!-- Chart js -->
<script type="text/javascript" src="{{asset('bower_components/chart.js/js/Chart.js') }}"></script>
<!-- amchart js -->
<script src="{{ asset('assets/pages/widget/amchart/amcharts.js') }}"></script>
<script src="{{ asset('assets/pages/widget/amchart/serial.js') }}"></script>
<script src="{{ asset('assets/pages/widget/amchart/light.js') }}"></script>
<!--script src="libraries/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="libraries/assets/js/SmoothScroll.js"></script-->


<script type="text/javascript" src="{{ asset('assets/js/views/home.js') }}"></script>

@endpush