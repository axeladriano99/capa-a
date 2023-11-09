<div class="card">
    <div class="card-header">
        <h5>Roles</h5>
    </div>
    <div class="card-block">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>
                            <div class="icon-btn">
                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-info btn-icon"><i class="icofont icofont-ui-edit"></i></a>
                            </div>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>