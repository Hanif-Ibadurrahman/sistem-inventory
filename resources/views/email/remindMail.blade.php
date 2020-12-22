@component('mail::message')
# {{$title}}

{{$message}}

@component('mail::button', ['url' => $url, 'color' => 'primary'])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
