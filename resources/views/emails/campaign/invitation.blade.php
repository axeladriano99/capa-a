<x-mail::message>
# Hola

{{ $invitation->user->name }} te ha invitado a unirte a la campaña {{ $invitation->campaign->name }}.

@if($invitation->is_user)
<x-mail::button :url="url('/join/'.$invitation->code)">
Unirme
</x-mail::button>
@else
<x-mail::button :url="url('/register/'.$invitation->code)">
Unirme
</x-mail::button>
@endif
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
