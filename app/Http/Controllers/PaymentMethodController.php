<?php

namespace App\Http\Controllers;

use App\Models\{Country, PaymentMethod};
use Illuminate\Http\Request;
use App\Http\Requests\{StorePaymentMethodPost, UpdatePaymentMethodPut};

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('has_permissions', ['Métodos de pago', 'Acceder']);

        return view('payment-methods.index')
        ->with('countries', Country::where('enabled', 'E')->orderBy('name')->get())
        ->with('paymentMethods', PaymentMethod::orderBy('name')->get());
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
    public function store(StorePaymentMethodPost $request)
    {
        $pm = PaymentMethod::create($request->validated());
        $request->session()->flash('success', "¡Método de pago creado con éxito!");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        $this->authorize('has_permissions', ['Métodos de pago', 'Editar']);
        return view('payment-methods.edit')
        ->with('countries', Country::where('enabled', 'E')->orderBy('name')->get())
            ->with('paymentMethods', PaymentMethod::where('id','!=',$paymentMethod->id)->orderBy('name')->get())
            ->with('paymentMethodEdit', $paymentMethod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentMethodPut $request, PaymentMethod $paymentMethod)
    {
        $paymentMethod->update($request->validated());
        $request->session()->flash('success', "¡Método de pago modificado con éxito!");
        return redirect()->route('payment-methods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        //
    }
}
