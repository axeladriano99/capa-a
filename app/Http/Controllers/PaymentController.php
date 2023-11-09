<?php

namespace App\Http\Controllers;

use App\Models\{Campaign,CampaignReferral, Payment, Repayment};
use Illuminate\Http\Request;
use App\Http\Requests\{StorePaymentPost, StoreRepaymentPost};
use Illuminate\Support\Facades\{DB, Mail};
use App\Mail\{PaymentReceived, RepaymentPending, RepaymentReceived };


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('has_permissions', ['Gestionar pagos', 'Acceder']);
        $user = auth()->user();

        $repayments = Repayment::where([
            ['from_user_id', $user->id]
        ])->get();

        $repaymentsCampaignsIds = [];

        $repaymentsPendings= [];

        foreach ($repayments as $repayment) {
            if($repayment->received > 0 && $repayment->repayment < $repayment->total & $repayment->received > $repayment->repayment){
                if(!in_array($repayment->campaign_id, $repaymentsCampaignsIds)){
                    array_push($repaymentsCampaignsIds, $repayment->campaign_id);
                    array_push($repaymentsPendings, $repayment);
                }
            }
            
        }

        $crs = [];
        foreach ($user->campaign_referrals as $cr) {
            if($cr->payments()->sum('amount') < $cr->campaign->value){
                array_push($crs, $cr);
            }
        }

    

        return view('payments.index')
        //->with('pendings', $user->campaign_referrals()->where('level', '>', 0)->doesntHave('payments')->get())
        ->with('pendings', $crs)
        ->with('payments', $user->payments)
        ->with('payments_received', $user->payments_received()->orderBy('id', 'DESC')->get())
        ->with('repaymentsPendings', $repaymentsPendings);
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
    public function store(StorePaymentPost $request)
    {
        //dump($request->validated());
        //dd($request->all());
        $cr = CampaignReferral::findOrFail($request->campaign_referral_id);
        $data = $request->validated();
        $data['evidence'] = $request->evidence->store('evidences');
        $data['user_id'] = auth()->id();
        $data['campaign_id'] = $cr->campaign_id;
        //$data['to_user_id'] = $cr->pay_to()->id;
        //$data['amount'] = $cr->campaign->value;

        $p = Payment::create($data);

        Mail::to($p->to->email)->send(new PaymentReceived($p));
        $request->session()->flash('success', '¡Pago registrado con éxito!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function getInfo(CampaignReferral $campaignReferral)
    {

        $resp = [];
        $pay1 = [
            'user_id' => $campaignReferral->pay_to()?->id,
            'pay_to' => $campaignReferral->pay_to()?->name .' - (' . $campaignReferral->pay_to()?->payment_method->name .' '. $campaignReferral->pay_to()?->payment_data . ')',
            'amount' => $campaignReferral->level > 3 ? ($campaignReferral->campaign->value / 2) : $campaignReferral->campaign->value,
        ];

        if(Payment::where([
            ['campaign_referral_id', $campaignReferral->id],
            ['campaign_id', $campaignReferral->campaign_id],
            ['user_id', $campaignReferral->referred_id],
            ['to_user_id', $campaignReferral->pay_to()?->id],
        ])->count() == 0){
            array_push($resp, $pay1);
        }

        if($campaignReferral->level > 3){
            $pay2 = [
                'user_id' => $campaignReferral->two_pay_to()?->id,
                'pay_to' => $campaignReferral->two_pay_to()?->name .' - (' . $campaignReferral->two_pay_to()?->payment_method->name .' '. $campaignReferral->two_pay_to()?->payment_data . ')',
                'amount' => ($campaignReferral->campaign->value / 2),
            ];

            if(Payment::where([
                ['campaign_referral_id', $campaignReferral->id],
                ['campaign_id', $campaignReferral->campaign_id],
                ['user_id', $campaignReferral->referred_id],
                ['to_user_id', $campaignReferral->two_pay_to()?->id],
            ])->count() == 0){
                array_push($resp, $pay2);
            }
        }

        if (count($resp) == 0) {
            array_push($resp, [
                'user_id' => 0,
                'pay_to' => 'No tiene pagos pendientes',
                'amount' => 0,
            ]);
        }

        /*$resp = [
            'pay_to' => $campaignReferral->pay_to()?->name .' - (' . $campaignReferral->pay_to()?->payment_method->name .' '. $campaignReferral->pay_to()?->payment_data . ')',
            'amount' => $campaignReferral->campaign->value,
        ];*/
        return response()->json($resp);

    }

    public function confirm(Payment $payment)
    {
        //dd($payment);
        if($payment->to_user_id != auth()->id()){
            abort(404);
        }
        //Confirmar pago
        $payment->status = 1;
        $payment->save();

        //Validar si tiene que hacer alguna devolucion si el nivel de campaign_referral es 0 no deve hacer ninguna devolucion
        //Se comenta ya que no va a existir devolucion
        /*
        $campaign_id = $payment->campaign_referral->campaign_id;
        $level = $payment->campaign_referral->level;

        $campaign_referral = auth()->user()->campaign_referrals()->where([
            ['campaign_id', $campaign_id],
            ['level', '<', $level],
        ])->first();
        if($campaign_referral->level > 0){
            $haveRepayment = Repayment::where([
                            ['campaign_id', $campaign_id],
                            ['from_user_id', auth()->id()],
                        ])->count();
            if($haveRepayment == 0){
                $this->createRepayments($campaign_referral);

            }

            $repayments = Repayment::where([
                ['from_user_id', auth()->id()],
                ['campaign_id', $campaign_id],
            ])->orderBy('id')->get();
            $repayment = null;
            foreach ($repayments as $r) {
                if($r->received < $r->total){
                    $repayment = $r;
                    break;
                }
            }

            if(!is_null($repayment)){
                $repayment->received = $repayment->received + ($payment->amount / 2);
                $repayment->save();
                Mail::to(auth()->user()->email)->send(new RepaymentPending($payment,$campaign_referral));
            }
        }
        */

        return response()->json(['status' => 'ok']);
    }

    public function createRepayments(CampaignReferral $campaignReferral)
    {
        $cycles = $campaignReferral->campaign->duration / 11;
        $value  = $campaignReferral->campaign->value * 4;
        for ($i=1; $i <= $cycles; $i++) {
            $repayment = Repayment::create([
                'campaign_id' => $campaignReferral->campaign_id,
                'from_user_id' => auth()->id(),
                'to_user_id' => $campaignReferral->pay_to()->id,
                'cycle' => $i,
                'total' => $value,
                'received' => 0.00,
                'repayment' => 0.00,
                'pending' => $value,
            ]);
            $value = $value * 4;
        }
    }

    public function getRepayment(Repayment $repayment)
    {
        //dd($repayment);
        if(auth()->id() != $repayment->from_user_id){
            return abort(404);
        }
        $res = [
            'label'  => $repayment->to->name .' - (' . $repayment->to->payment_method->name .' '. $repayment->to->payment_data . ')',
            'to'     => $repayment->to,
            'amount' => $repayment->received - $repayment->repayment,
        ];
        return response()->json($res);
    }

    public function sendRepayment(StoreRepaymentPost $request)
    {
        $repayment = Repayment::where([['id', $request->repayment_id],['from_user_id', auth()->id()]])->first();
        if(is_null($repayment)){
            abort(403);
        }
        $cr = CampaignReferral::where([['referred_id', auth()->id()], ['campaign_id', $repayment->campaign_id]])->first();
        


        $data = $request->validated();
        
        $data['evidence'] = $request->evidence->store('evidences');
        $data['user_id'] = auth()->id();
        $data['to_user_id'] = $repayment->to_user_id;
        $data['campaign_referral_id'] = $cr->id;
        $data['type'] = 2;
        

        $p = Payment::create($data);

        $repayment->repayment = $repayment->repayment + $p->amount;
        $repayment->pending = $repayment->pending - $p->amount;
        $repayment->save();
        

        Mail::to($repayment->to->email)->send(new RepaymentReceived($p));

        $request->session()->flash('success', '¡Devolución registrada con éxito!');
        return back();
    }

    public function showPayments(Request $request)
    {
        if(auth()->user()->role_id > 2){
            abort(403);
        }
        return view('payments.admin');
        
    }

    public function getAdmin(Request $request)
    {
        if(auth()->user()->role_id > 2){
            abort(403);
        }
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $draw = isset($request->draw) ? intval($request->draw) : 1;
        $payments = Payment::filter(['search' => $request->search['value']]);
        $rf = $payments->count();



        $paymentsGet = $payments->offset($start)->limit($length)->orderBy('id', 'DESC')->get()->transform(fn ($payment, $index) => [
            'id'     => $index+1,
            'from'   => $payment->from->name,
            'to'     => $payment->to->name,
            'campaign' => $payment->campaign_referral->campaign->name,
            'amount' => $payment->amount,
            'type'   => $payment->type_icon,
            'status' => $payment->status_str,
            'date'   => date('d-m-Y H:i', strtotime($payment->created_at)),
        ]);
        


        $resp = [
            "draw"            => $draw,
            "recordsTotal"    => Payment::count(),
            "recordsFiltered" => $rf,
            "data"            => $paymentsGet,
        ];
        return response()->json($resp,200);
    }

    public function showFile(Payment $payment)
    {
        if($payment->to_user_id != auth()->id()){
            abort(404);
        }
        return response()->file(storage_path('app/'.$payment->evidence));
    }
}






