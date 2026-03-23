<h3>{{ $details['greeting'] }}</h3>

<p>{{ $details['body'] }}</p>

@if(isset($details['action_text']) && isset($details['action_url']))
<a href="{{ $details['action_url'] }}" style="background:blue;color:white;padding:10px;text-decoration:none;">
    {{ $details['action_text'] }}
</a>
@endif

<p>{{ $details['end_line'] }}</p>
