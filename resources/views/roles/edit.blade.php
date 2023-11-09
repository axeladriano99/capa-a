@extends('layouts.app')
@section('title', 'Roles')
@section('content')
<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Editar Roles</h4>
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
                @include('roles.list')
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Editar rol</h5>
                    </div>
                    <div class="card-block">
                        <form method="POST" action="{{ route('roles.update', $roleEd) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $roleEd->name) }}" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description', $roleEd->description) }}</textarea>
                            </div>

                            <div class="form-group row px-4">
                                @error('permissions')
                                <p class="text-danger error">{{ $message }}</p>
                                @enderror
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm" id="components-table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Components') }}</th>
                                                @foreach($permissions as $permission)
                                                <th>{{ $permission->name }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($components as $component)
                                            <tr>
                                                <td>{{ $component->name }}</td>
                                                @if(is_null(old('permissions')))
                                                    @foreach($permissions as $permission)
                                                    <td>
                                                        <input
                                                            type="checkbox"
                                                            name="permissions[{{ $component->id }}][{{ $permission->id }}]"
                                                            @if(null != $roleEd->permissions()->where('id',$permission->id)->wherePivot('component_id',$component->id)->first())
                                                            checked
                                                            @endif
                                                            >
                                                    </td>
                                                    @endforeach
                                                @else
                                                    @foreach($permissions as $permission)
                                                    <td>
                                                        <input
                                                            type="checkbox"
                                                            name="permissions[{{ $component->id }}][{{ $permission->id }}]"

                                                            @if(
                                                                !is_null(old('permissions')) &&
                                                                array_key_exists($component->id, old('permissions')) &&
                                                                array_key_exists($permission->id,old('permissions')[$component->id])

                                                                )
                                                            checked
                                                            @endif
                                                            >
                                                    </td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        
                                    </table>
                                </div>
                                    
                            </div>

                            


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                                <a href="{{ route('roles.index') }}" class="btn btn-secondary float-right">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection