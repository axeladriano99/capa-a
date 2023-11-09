<?php

namespace App\Http\Controllers;

use App\Models\{CampaignInvitation, CampaignReferral, PaymentMethod, User};
use Illuminate\Http\Request;
use App\Http\Requests\{
    StoreRegisterPost,
    StoreRegisterUrlPost
};
use Illuminate\Support\Facades\{Auth, DB, Hash, Mail};
use App\Mail\CampaignEntry;


class RegisterController extends Controller
{
    public function shoRegisterForm($code)
    {
        $invitation = CampaignInvitation::where([
            ['code', $code],
            ['used', false]
        ])->first();
        if(is_null($invitation)){
            abort(404);
        }


        return view('auth.register-code')->with('invitation', $invitation)
        //->with('payment_methods', PaymentMethod::select('id','name')->get())
        ->with('payment_methods', $invitation->campaign->country->paymentMethods()->select('id','name')->get());
    }
    public function shoRegisterFormUrl($campaignCode, $userCode)
    {

        $user = User::where(DB::raw('md5(id)'), $userCode)->first();
        if(is_null($user)){ abort(404); }
        $campaign = $user->campaigns()->where(DB::raw('md5(campaigns.id)'), $campaignCode)->first();
        if(is_null($campaign)){ abort(404); }
        if($campaign->invitations()->where('user_id', $user->id)->count() > 1){ abort(403); }

        return view('auth.register-link');
    }

    public function register(StoreRegisterPost $request, $code)
    {
        //dd($request->all());
        
        $invitation = CampaignInvitation::where([
            ['code', $code],
            ['used', false]
        ])->first();
        $ref = CampaignReferral::where([
            ['referred_id', $invitation->user_id],
            ['campaign_id', $invitation->campaign_id]
        ])->first();


        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $data['role_id'] = 3;
        
        DB::beginTransaction();
        try {
            $user = User::create($data);
            $referral = CampaignReferral::create([
                'campaign_id'    => $invitation->campaign_id,
                'referred_id'    => $user->id,
                'referred_by_id' => $invitation->user_id,
                'start_date'     => now(),
                'level'          => $ref->level + 1,
            ]);
            
            $invitation->used = true;
            $invitation->save();
            DB::commit();
            Auth::login($user,true);

            Mail::to($user->email)->send(new CampaignEntry($user, $referral));
            
            return redirect()->route('home');

        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage());
            $request->session()->flash('error', '¡Error al hacer registro!');
            return redirect()->back()->withInput();
        }
    }

    public function registerUrl(StoreRegisterUrlPost $request, $campaignCode, $userCode)
    {
        $userI = User::where(DB::raw('md5(id)'), $userCode)->first();
        if(is_null($userI)){ abort(404); }
        $campaign = $userI->campaigns()->where(DB::raw('md5(campaigns.id)'), $campaignCode)->first();
        if(is_null($campaign)){ abort(404); }
        if($campaign->invitations()->where('user_id', $userI->id)->count() > 1){ abort(403); }


        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $data['role_id'] = 3;
        DB::beginTransaction();
        try {
            $user = User::create($data);
            $referral = CampaignReferral::create([
                'campaign_id'    => $campaign->id,
                'referred_id'    => $user->id,
                'referred_by_id' => $userI->user_id,
                'start_date'     => now(),
            ]);

            DB::commit();
            Auth::login($user,true);
            return redirect()->route('home');

        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e);
            $request->session()->flash('error', '¡Error al hacer registro!');
            return redirect()->back()->withInput();
        }
    }
}
