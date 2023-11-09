<?php

namespace App\Http\Controllers;

use App\Models\CampaignInvitation;
use Illuminate\Http\Request;

class CampaignInvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CampaignInvitation  $campaignInvitation
     * @return \Illuminate\Http\Response
     */
    public function show(CampaignInvitation $campaignInvitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CampaignInvitation  $campaignInvitation
     * @return \Illuminate\Http\Response
     */
    public function edit(CampaignInvitation $campaignInvitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CampaignInvitation  $campaignInvitation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CampaignInvitation $campaignInvitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CampaignInvitation  $campaignInvitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CampaignInvitation $campaignInvitation)
    {
        if ($campaignInvitation->user_id != auth()->id()) {
            abort(403);
        }

        $campaignInvitation->delete();
        request()->session()->flash('success', '¡Invitación eliminada!');
        return back();
    }
}
