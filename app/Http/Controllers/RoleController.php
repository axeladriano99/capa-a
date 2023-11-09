<?php

namespace App\Http\Controllers;
use App\Models\{
    Component,
    Permission,
    Role
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\{StoreRolePost, UpdateRolePut};

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('has_permissions', ['Roles', 'Acceder']);
        return view('roles.index')
        ->with('roles', Role::orderBy('name')->get())
        ->with('components', Component::where('enabled', 'E')->orderBy('name')->get())
        ->with('permissions', Permission::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRolePost $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::create($request->validated());
            foreach ($request->permissions as $component_id => $permissions) {
                foreach ($permissions as $permission_id => $on) {
                    $role->permissions()->attach($permission_id, ['component_id' => $component_id]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $request->session()->flash('error', '¡Error al crear el rol!');
            return redirect()->back()->withInput();
        }

        $request->session()->flash('success', '¡Rol creado con éxito!');
        return redirect()->route('roles.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('has_permissions', ['Roles', 'Editar']);
        return view('roles.edit')
        ->with('roleEd', $role)
        ->with('roles', Role::where('id', '!=', $role->id)->orderBy('name')->get())
        ->with('components', Component::where('enabled', 'E')->orderBy('name')->get())
        ->with('permissions', Permission::get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolePut $request, Role $role)
    {
        DB::beginTransaction();
        try {
            $role->permissions()->detach();
            $role->update($request->validated());
            foreach ($request->permissions as $component_id => $permissions) {
                foreach ($permissions as $permission_id => $on) {
                    $role->permissions()->attach($permission_id, ['component_id' => $component_id]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $request->session()->flash('error', '¡Error al modificar el rol');
            return redirect()->back()->withInput();
        }

        $request->session()->flash('success', '¡Rol modificado con éxito!');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
