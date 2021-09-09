<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://echevarnehnos.com/assets/img/EchevarneHnos_Logo.png" class="logo" alt="EH">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
