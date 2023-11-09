<?php

namespace App\Http\Controllers;

use App\Models\{Campaign, CampaignReferral, Country, PaymentMethod};
use Illuminate\Http\Request;
use App\Http\Requests\{StoreCampaignPost, UpdateCampaignPut};

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('has_permissions', ['Campañas', 'Acceder']);
        return view('campaigns.index')
        ->with('campaigns', Campaign::orderBy('name')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('has_permissions', ['Campañas', 'Crear']);
        return view('campaigns.create')
        ->with('countries', Country::where('enabled', 'E')->orderBy('name')->get())
        ->with('paymentMethods', PaymentMethod::where('enabled', 'E')->orderBy('name')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaignPost $request)
    {
        
        $campaign = Campaign::create($request->validated());
        $ref = CampaignReferral::create([
            'campaign_id' => $campaign->id,
            'referred_id' => $request->user()->id,
            'start_date'  => date('Y-m-d'),
            'level'       => 0,
        ]);

        $request->session()->flash('success', '¡Campaña creada con éxito!');
        return redirect()->route('campaigns.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        $this->authorize('has_permissions', ['Campañas', 'Editar']);
        return view('campaigns.edit')
        ->with('campaign', $campaign)
        ->with('countries', Country::where('enabled', 'E')->orderBy('name')->get())
        ->with('paymentMethods', PaymentMethod::where('enabled', 'E')->orderBy('name')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCampaignPut $request, Campaign $campaign)
    {
        $campaign->update($request->validated());
        $request->session()->flash('success', '¡Campaña modificada con éxito!');
        return redirect()->route('campaigns.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
