@component('mail::message')
# Reset Account

Welcome {{$data['data']->name}}<br>

@component('mail::button', ['url' => aurl('reset/password/'.$data['token'])])
Button Text<br>

@endcomponent
Or copy this link
<a href="{{aurl('reset/password/'.$data['token'])}}">{{aurl('reset/password/'.$data['token'])}}</a><br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
