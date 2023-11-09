<li data-jstree='{"opened":true}'>
	{{ $children_referred->to->name }} - ({{ $children_referred->to->phone }})
	@if($level < 3 && $children_referred->referrals()->where('campaign_id', $s)->count())
		<ul>
			@foreach($children_referred->referrals()->where('campaign_id', $s)->get() as $children_referreds)
				@include('networks.children-referred', ['children_referred' => $children_referreds, 's' => $s, 'level' => $level+1])
			@endforeach
		</ul>
	@endif
</li>