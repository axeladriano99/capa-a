<x-mail::message>
# Devolución

Ahora que confirmaste la recepcion de un pago por <b>{{ $payment->amount }}</b> debes hacer la devolucion del 50 % {{ $payment->amount / 2 }} a {{ $campaignReferral->pay_to()->name }}

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
