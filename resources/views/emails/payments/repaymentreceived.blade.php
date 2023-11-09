<x-mail::message>
# Información

El usuario <b>{{ $pay->from->name }}</b> te ha realizado un pago por devolución que esta pendiente por confirmar.
<br>
<p>{{ $pay->comment }}</p>
<br>


Saludos,<br>
{{ config('app.name') }}
</x-mail::message>
