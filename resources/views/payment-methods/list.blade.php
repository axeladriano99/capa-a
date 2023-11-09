<div class="card">
    <div class="card-header">
        <h5>Métodos de pagos</h5>
    </div>
    <div class="card-block">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Código</th>
                        <th>País</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paymentMethods as $paymentMethod)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $paymentMethod->name }}</td>
                        <td>{{ $paymentMethod->description }}</td>
                        <td>{{ $paymentMethod->code }}</td>
                        <td>{{ $paymentMethod->country->prefix }}</td>
                        <td>
                            <div class="icon-btn">
                                @can('has_permissions', ['Métodos de pago', 'Editar'])
                                <a href="{{ route('payment-methods.edit', $paymentMethod) }}" class="btn btn-info btn-icon"><i class="icofont icofont-ui-edit"></i></a>
                                @endcan
                            </div>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>