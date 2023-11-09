<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Campaign, CampaignInvitation, CampaignReferral, Payment, User};
use Illuminate\Support\Facades\{Auth,DB, Mail};
use App\Mail\CampaignEntry;

class HomeController extends Controller
{
    public function index($campaign = null)
    {
        if(auth()->user()->role_id <= 2){
            return view('home-admin')
                ->with('countCampaigns', Campaign::count())
                ->with('countPaymentsR', Payment::count())
                ->with('countPaymentsC', Payment::where('status', 1)->count())
                ->with('countUsers', User::count() - 1)
                ->with('recentsPayments', Payment::orderBy('id', 'DESC')->limit(5)->get());
        }else{
            //return view('home');
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
        
    }

    public function join($code)
    {
        $invitation = CampaignInvitation::where([
            ['code', $code],
            ['used', false]
        ])->first();
        if(is_null($invitation)){
            abort(404);
        }

        $user = User::where('email', $invitation->email)->first();
        if(is_null($user)){
            abort(404);
        }

        if (Auth::check() && Auth::id() != $user->id) {
            //request()->session()->flash('error', '¡Te has registrado en la campaña!');
            return redirect()->route('home');
        }




        DB::beginTransaction();
        try {

            $referral = CampaignReferral::create([
                'campaign_id'    => $invitation->campaign_id,
                'referred_id'    => $user->id,
                'referred_by_id' => $invitation->user_id,
                'start_date'     => now(),
                'level'          => CampaignReferral::where([
                    ['campaign_id',$invitation->campaign_id],
                    ['referred_id', $invitation->user_id]
                ])->first()->level + 1,
            ]);

            $invitation->used = true;
            $invitation->save();

            Mail::to($user->email)->send(new CampaignEntry($user, $referral));
            DB::commit();

            Auth::login($user,true);
            request()->session()->flash('success', '¡Te has registrado en la campaña!');
            return redirect()->route('home');

        } catch (\Exception $e) {
            DB::rollBack();
            //request()->session()->flash('error', '¡Error al hacer registro!');
            //return redirect()->back()->withInput();
            abort(500);
        }
    }
}
