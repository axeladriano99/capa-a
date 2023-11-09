@extends('layouts.app')
@section('title', 'Pagos')
@push('styles')
<!-- weather-icons -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/weather-icons/css/weather-icons.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/weather-icons/css/weather-icons-wind.min.css') }}">
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
                        <h4>Mis pago</h4>
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
                <div class="card">
                    <div class="card-header">
                        <h5>Pagos realizados</h5>
                    </div>
                    <div class="card-block">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Campaña</th>
                                    <th>Pago a:</th>
                                    <th>Monto</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->campaign_referral->campaign->name }}</td>
                                    <td>{{ $payment->to->name }} - ({{ $payment->to->phone }})</td>
                                    <td>{{ number_format($payment->amount, 0) }} {{ $payment->campaign?->currency }}</td>
                                    <td>{!! $payment->type_icon !!}</td>
                                    <td>{{ $payment->status_str }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- <div class="card">
                    <div class="card-header">
                        <h5>Pagos pendientes</h5>
                    </div>
                    <div class="card-block">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Campaña</th>
                                    <th>Monto</th>
                                    <th>Pagar a:</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendings as $referred)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $referred->campaign->name }}</td>
                                    <td>{{ $referred->campaign->value }}</td>
                                    <td>{{ $referred->pay_to()?->name }} - ({{ $referred->pay_to()?->phone }})</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>

            <div class="col-sm-12 col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Realizar pago</h5>
                    </div>
                    <form method="POST" id="form-send-pay" action="{{ route('payments.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-block">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="campaign_referral_id">Campaña</label>
                                <select class="form-control" name="campaign_referral_id" id="campaign_referral_id">
                                    <option value="">Seleccione</option>
                                    @foreach($pendings as $referred)
                                    <option value="{{ $referred->id }}">{{ $referred->campaign->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="to_user_id">Pago a:</label>
                                <select class="form-control" name="to_user_id" id="to_user_id">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="amount">Monto</label>
                                <input type="text" name="amount" id="amount" class="form-control" readonly>
                            </div>

                            <div id="pay-to"></div>
                            <div class="form-group">
                                <label for="evidence">Adjuntar comprobante</label>
                                <input type="file" name="evidence" id="evidence" class="form-control" accept="image/*" required>
                            </div>

                            <div class="form-group">
                                <label for="comment">Comentario</label>
                                <input type="text" name="comment" id="comment" class="form-control" value="{{ old('comment') }}">
                            </div>

                            <div class="form-group">
                                <button type="submit" id="btn-send-pay" class="btn btn-primary">
                                    <span id="btn-text">Enviar</span>
                                    <div class="preloader3 loader-block d-none" style="height: 20px; padding-top: 20px;">
                                        <div class="circ1 bg-white"></div>
                                        <div class="circ2 bg-white"></div>
                                        <div class="circ3 bg-white"></div>
                                        <div class="circ4 bg-white"></div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Pagos recibidos</h5>
                        @if(count($repaymentsPendings))
                        <div class="card-header-right mb-2">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#large-Modal">Enviar devolución</button>
                        </div>
                        @endif
                    </div>
                    <div class="card-block">

                        <table class="table" id="payments-received-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Campaña</th>
                                    <th>Recibido de:</th>
                                    <th>Monto</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Archivo</th>
                                    <th>Confirmar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments_received as $received)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $received->campaign?->name ?? $received->campaign_referral->campaign->name }}</td>
                                    <td>{{ $received->from->name }}</td>
                                    <td>{{ number_format($received->amount, 0) }} {{ $received->campaign?->currency }}</td>
                                    <td>{!! $received->type_icon !!}</td>
                                    <td>{{ $received->created_at->diffForHumans() }}</td>
                                    <td><a href="{{ route('payments.file', $received->id) }}" target="_blank"><i class="ti-image"></i></a></td>
                                    <td>
                                        <input type="checkbox" name="confirmed" class="confirmed" value="{{ $received->id }}" @checked($received->status == 1) @disabled($received->status == 1)>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                
        </div>

        @if(count($repaymentsPendings))
        @include('payments.modal-repayment')
        @endif


    </div>
</div>
@endsection
@push('scripts')
<!-- data-table js -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/payments/index.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#campaign_referral_id').change(function(event) {
            $('#to_user_id').html(`<option value="">Seleccione</option>`);
            var idC = $(this).val();
            if(idC != ''){
                $.ajax({
                    url: '{{ url('/payments/get-info') }}/'+idC,
                    dataType: 'json',
                })
                .done(function(resp) {
                    console.log("success", resp);
                    $.each(resp, function( index, value ) {
                        $('#to_user_id').append(`<option value="${value.user_id}">${value.pay_to}</option>`);
                    });
                    $('#amount').val(resp[0].amount);
                    //$('#pay-to').html(`<label>Pagar a: ${resp.pay_to}</label><br><label>Monto: ${resp.amount}</label>`);
                    
                });
                
            }else{
                $('#pay-to').text('');
            }
            console.log("idC", idC);
        });

        $('.confirmed').click(function(event) {
            $(this).attr('disabled', true);
            var pId = $(this).val();
            if(confirm('¿Seguro quiere confirmar que ya recibio este pago?')){

                $.ajax({
                    url: '{{ url('/payments/confirm') }}/'+pId,
                    dataType: 'json'
                })
                .done(function(resp) {
                    console.log("success", resp);
                    if(resp.status == 'ok'){
                        alert('El pago ha sido confirmado');
                        location.reload();
                    }
                });
                
            }else{
                event.preventDefault();
                $(this).attr('disabled', false);
            }
        });

        $('#repayment_id').change(function(event) {
            var repayment_id = $(this).val();
            if(repayment_id != ''){
                $.ajax({
                    url: '{{ url('/repayments') }}/'+repayment_id,
                    dataType: 'json',
                })
                .done(function(resp) {
                    console.log("success", resp);
                    $('#repay-to').html(`<label>Pagar a: ${resp.label}</label><br><label>Monto sugerido: $ ${resp.amount}</label>`);
                    $('#rp-amount').attr('max', resp.amount);
                });
                
            }else{
                $('#repay-to').text('');
            }
        });

        $('#form-send-pay').submit(function(event) {
            console.log("'voy'", 'voy');
            $('#btn-send-pay').attr('disabled', true);
            $('#btn-text').addClass('d-none');
            $('.preloader3').removeClass('d-none');
            
            //event.preventDefault();
        });

        $('#form-send-rp').submit(function(event) {
            $('#btn-rp-send').attr('disabled', true);
            $('#btn-rp-text').addClass('d-none');
            $('.preloader3').removeClass('d-none');
            
            //event.preventDefault();
        });
    });
</script>
@endpush