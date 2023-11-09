<x-mail::message>
# Información
@if($referral->level < 4)
{{ $user->name }} Bienvenido a la campaña {{ $referral->campaign->name }} ahora debes pagar {{ $referral->campaign->value }} {{ $referral->campaign->currency }} a {{ $referral->pay_to()->name }} por {{ $referral->pay_to()->payment_method->name }} ({{ $referral->pay_to()->payment_data }})
@else

{{ $user->name }} Bienvenido a la campaña {{ $referral->campaign->name }} ahora debes pagar:
<br>
{{ ($referral->campaign->value / 2) }} {{ $referral->campaign->currency }} a {{ $referral->pay_to()->name }} por {{ $referral->pay_to()->payment_method->name }} ({{ $referral->pay_to()->payment_data }})
<br>
{{ ($referral->campaign->value / 2) }} {{ $referral->campaign->currency }} a {{ $referral->two_pay_to()->name }} por {{ $referral->two_pay_to()->payment_method->name }} ({{ $referral->two_pay_to()->payment_data }})
@endif


<x-mail::button :url="url('/')">
Ir a la aplicación
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
