<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{env('LOGO_PATH')}}" class="logo" alt="{{env('APP_NAME')}}">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
