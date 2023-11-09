<div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Enviar devolución</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Ingrese los datos de la devolucion</h5>
                <form method="POST" action="{{ route('repayments.store') }}" enctype="multipart/form-data" id="form-send-rp">
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
                                <label for="repayment_id">Campaña</label>
                                <select class="form-control" name="repayment_id" id="repayment_id">
                                    <option value="">Seleccione</option>
                                    @foreach($repaymentsPendings as $repayment)
                                    <option value="{{ $repayment->id }}">{{ $repayment->campaign->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="repay-to"></div>
                            <div class="form-group">
                                <!--label for="amount">Monto</label-->
                                <input type="number" name="amount" id="rp-amount" class="form-control" value="{{ old('amount') }}">
                            </div>
                            <div class="form-group">
                                <label for="evidence">Adjuntar comprobante</label>
                                <input type="file" name="evidence" id="evidence" class="form-control" accept="image/*" required>
                            </div>

                            <div class="form-group">
                                <label for="comment">Comentario</label>
                                <input type="text" name="comment" id="comment" class="form-control" value="{{ old('comment') }}">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btn-rp-send">
                                    <span id="btn-rp-text">Enviar</span>
                                    <div class="preloader3 loader-block d-none" style="height: 20px; padding-top: 20px;">
                                        <div class="circ1 bg-white"></div>
                                        <div class="circ2 bg-white"></div>
                                        <div class="circ3 bg-white"></div>
                                        <div class="circ4 bg-white"></div>
                                    </div>
                                </button>
                                <button type="button" class="btn btn-default waves-effect float-right" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>