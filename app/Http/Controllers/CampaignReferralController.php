<?php

namespace App\Http\Controllers;

use App\Models\{CampaignInvitation, CampaignReferral, User};
use Illuminate\Http\Request;
use App\Http\Requests\StoreCampaignReferralPost;
use Illuminate\Support\Facades\Mail;
use App\Mail\CampaignInvitationMail;


class CampaignReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        //dd(auth()->user()->campaigns()->has('invitations', '<', 2)->get());
        $campaigns = auth()->user()->campaigns;
        return view('campaign-referrals.index')
        ->with('campaigns', $campaigns)
        ->with('invitations', $user->invitations()->where('used', false)->get())
        ->with('referrals', $user->referrals);
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
    public function store(StoreCampaignReferralPost $request)
    {
        $user = $request->user();

        $campaign = $user->campaigns()->where('campaigns.id', $request->campaign_id)->first();
        $invitationsSent = $campaign->invitations()->where([
            ['user_id', $user->id],
            ['email', '!=', $request->email],
        ])->count();

        if($invitationsSent > 1){
            return back()
                ->withErrors(['campaign_id' => 'ya enviaste 2 invitaciones a esta campaña'])
                ->withInput();
        }

        if($user->email == trim($request->email)){
            return back()
                ->withErrors(['email' => 'no puedes enviar invitacion a este email'])
                ->withInput();
        }

        $data = $request->validated();
        $data['code'] = uniqid();
        $data['user_id'] = $user->id;
        $data['is_user'] = User::where('email', $request->email)->first() != null;

        $invitation = CampaignInvitation::updateOrCreate(
            ['email' => $data['email'], 'user_id' => $data['user_id'], 'campaign_id' => $data['campaign_id']],
            ['code' => $data['code'], 'is_user' => $data['is_user']]
        );
        Mail::to($request->email)->send(new CampaignInvitationMail($invitation));

        $request->session()->flash('success', '¡Invitación enviada con éxito!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CampaignReferral  $campaignReferral
     * @return \Illuminate\Http\Response
     */
    public function show(CampaignReferral $campaignReferral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CampaignReferral  $campaignReferral
     * @return \Illuminate\Http\Response
     */
    public function edit(CampaignReferral $campaignReferral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CampaignReferral  $campaignReferral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CampaignReferral $campaignReferral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CampaignReferral  $campaignReferral
     * @return \Illuminate\Http\Response
     */
    public function destroy(CampaignReferral $campaignReferral)
    {
        //
    }
}
