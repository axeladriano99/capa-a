<?php

namespace App\Http\Controllers;

use App\Models\{PaymentMethod, Role, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Gate, Hash};
use App\Http\Requests\{StoreUserPost, UpdateUserPut};

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('has_permissions', ['Usuarios', 'Acceder']);
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('has_permissions', ['Usuarios', 'Crear']);
        return view('users.create')
        ->with('roles', Role::where('id', '>', 1)->orderBy('name')->get())
        ->with('paymentMethods', PaymentMethod::select('id','name')->orderBy('name')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $u = User::create($data);
        $request->session()->flash('success', '¡Usuario creado con éxito!');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('has_permissions', ['Usuarios', 'Editar']);
        return view('users.edit')
        ->with('user', $user)
        ->with('roles', Role::orderBy('name')->get())
        ->with('paymentMethods', PaymentMethod::select('id','name')->orderBy('name')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPut $request, User $user)
    {
        $data = $request->validated();
        if(!is_null($request->password)){
            $data['password'] = Hash::make($request->password);
        }else{
            unset($data['password']);
        }
        $user->update($data);
        $request->session()->flash('success', '¡Usuario modificado con éxito!');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function list(Request $request)
    {
        $this->authorize('has_permissions', ['Usuarios', 'Acceder']);
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $draw = isset($request->draw) ? intval($request->draw) : 1;
        $users = User::with('role')->where('role_id', '>', 1)->filter(['search' => $request->search['value']]);
        $rf = $users->count();

        //Ordenar
        if(!is_null($request->order)){
            $order = $request->order[0];

            switch ($order['column']) {
                case '0':
                    $users->orderBy('id',$order['dir']);
                    break;

                case '2':
                    $users->orderBy('email',$order['dir']);
                    break;

                default:
                    $users->orderBy('name',$order['dir']);
                    break;
            }
        }

        $canEdit = Gate::allows('has_permissions', ['Usuarios', 'Editar']);
        $usersGet = $users->offset($start)->limit($length)->get()->transform(fn ($user, $index) => [
            'id'      => $index+1,
            'name'    => $user->name,
            'email'   => $user->email,
            'phone'   => $user->phone,
            'role'    => $user->role->name,
            'actions' => $canEdit ? '<a href="'.route('users.edit', $user->id).'" class="btn btn-info btn-icon"> <i class="icofont icofont-ui-edit"></i> </a>' : '',
        ]);
        


        $resp = [
            "draw"            => $draw,
            "recordsTotal"    => User::count(),
            "recordsFiltered" => $rf,
            "data"            => $usersGet,
        ];
        return response()->json($resp,200);
    }
}
