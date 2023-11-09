<?php

namespace App\Http\Controllers;

use App\Models\CampaignReferral;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($campaign = null)
    {
        $user = auth()->user();
        if($campaign == null){
            $r = CampaignReferral::where('referred_id', $user->id)->orderBy('created_at', 'DESC')->first();

        }else{
            $r = CampaignReferral::where([
                ['campaign_id', $campaign],
                ['referred_id', $user->id],
            ])->orderBy('created_at', 'DESC')->first();
            if(is_null($r)){
                abort(404);
            }
        }



        
        $cr = CampaignReferral::where('campaign_id', $r->campaign_id)
        ->whereNull('referred_by_id')
        /*->with('children_referrals')*/
        ->get();



        return view('networks.index')
        ->with('campaign_referrals', $cr)
        ->with('cpr', $r)
        ->with('campaigns', $user->campaigns()->orderBy('created_at', 'DESC')->get())
        ->with('campaign_selected', $r->campaign_id);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
