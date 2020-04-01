@component('mail::message')
<H1>Testing for IP:{{$IP}}</H1>


<h2>headers</h2>
<div class="no-gutters border rounded overflow-hidden flex-md-row shadow-sm position-relative  p-2 row">
<ul>
@foreach($headers as  $head=> $head_value)
<li>{{$head}}</li>
<ul>
@foreach($head_value as $he=> $x_value)
@if(strlen($he)>3)
<li>{{$he}}: {{$x_value}}</li>
@endif
@if(strlen($he)<=3)
<li>{{$x_value}}</li>
@endif
@endforeach
</ul>
@endforeach
</ul>
</div>

<h2>handShakes</h2>
<div class="no-gutters border rounded overflow-hidden flex-md-row shadow-sm position-relative  p-2 row">
<ul>
@foreach($handShakes as $handShake)
@if(strlen($handShake)>2)
<pre>{{$handShake}}</pre>
@endif
@endforeach
</ul>
</div>

<h2>SecurityVulnerabilities</h2>
<div  class="no-gutters border rounded overflow-hidden flex-md-row shadow-sm position-relative  p-2 row">
<ul>
@foreach($SecurityVulnerabilities as $SecurityVulnerabiliti)
@if(strlen($SecurityVulnerabiliti)>2)
<pre>{{$SecurityVulnerabiliti}}</pre>
@endif
@endforeach
</ul>
</div>

<h2>handShakes</h2>
<div class="no-gutters border rounded overflow-hidden flex-md-row shadow-sm position-relative  p-2 row">
<ul>
@foreach($ConnectionProtocols as $ConnectionProtocol)
@if(strlen($ConnectionProtocol)>2)
<pre>{{$ConnectionProtocol}}</pre>
@endif
@endforeach
</ul>
</div>


<h2>handShakes</h2>
<div class="no-gutters border rounded overflow-hidden flex-md-row shadow-sm position-relative  p-2 row">
<ul>
@foreach($ServerHello as $ServerH)
@if(strlen($ServerH)>2)
<pre>{{$ServerH}}</pre>
@endif
@endforeach
</ul>
</div>


<h2>handShakes</h2>
<div class="no-gutters border rounded overflow-hidden flex-md-row shadow-sm position-relative  p-2 row">
<ul>
@foreach($CyphersPherProtocole as $CyphersPherPro)
@if(strlen($CyphersPherPro)>2)
<pre>{{$CyphersPherPro}}</pre>
@endif
@endforeach
</ul>
</div>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
