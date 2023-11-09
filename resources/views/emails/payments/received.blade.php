<x-mail::message>
# Información

El usuario <b>{{ $pay->from->name }}</b> te ha realizado un pago de <b> {{ $pay->amount }} {{ $pay->campaign?->currency }} </b> que esta pendiente por confirmar.
<br>
<p>{{ $pay->comment }}</p>
<br>

<x-mail::button :url="url('/')">
Ir a la aplicación
</x-mail::button>

Saludos,<br>
{{ config('app.name') }}
</x-mail::message>
