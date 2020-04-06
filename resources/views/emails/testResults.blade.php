@component('mail::message')
<H1 style="font-family: Nunito">Testing for IP:{{$IP}}</H1>

<h2>Headers</h2>
<div class="no-gutters border rounded overflow-hidden flex-md-row shadow-sm position-relative  p-2 row">
<ul>
@foreach($headers as  $head=> $head_value)
<li style="font-family: Nunito">{{$head}}</li>
<ul>
@foreach($head_value as $he=> $x_value)
@if(strlen($he)>3)
<li style="font-family: Nunito">{{$he}}: {{$x_value}}</li>
@endif
@if(strlen($he)<=3)
<li style="font-family: Nunito">{{$x_value}}</li>
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
<pre style="font-family: Nunito padding-top: 0.05rem;padding-bottom: 0.05rem;">{{$handShake}}</pre>
@endif
@endforeach
</ul>
</div>

<h2>SecurityVulnerabilities</h2>
<div  class="no-gutters border rounded overflow-hidden flex-md-row shadow-sm position-relative  p-2 row">
<ul>
@foreach($SecurityVulnerabilities as $SecurityVulnerabiliti)
@if(strlen($SecurityVulnerabiliti)>2)
<pre style="font-family: Nunito padding-top: 0.05rem;padding-bottom: 0.05rem;">{{$SecurityVulnerabiliti}}</pre>
@endif
@endforeach
</ul>
</div>

<h2>handShakes</h2>
<div class="no-gutters border rounded overflow-hidden flex-md-row shadow-sm position-relative  p-2 row">
<ul>
@foreach($ConnectionProtocols as $ConnectionProtocol)
@if(strlen($ConnectionProtocol)>2)
<pre style="font-family: Nunito padding-top: 0.05rem;padding-bottom: 0.05rem;">{{$ConnectionProtocol}}</pre>
@endif
@endforeach
</ul>
</div>


<h2>handShakes</h2>
<div class="no-gutters border rounded overflow-hidden flex-md-row shadow-sm position-relative  p-2 row">
<ul>
@foreach($ServerHello as $ServerH)
@if(strlen($ServerH)>2)
<pre style="font-family: Nunito padding-top: 0.05rem;padding-bottom: 0.05rem;">{{$ServerH}}</pre>
@endif
@endforeach
</ul>
</div>


<h2>handShakes</h2>
<div class="no-gutters border rounded overflow-hidden flex-md-row shadow-sm position-relative  p-2 row">
<ul>
@foreach($CyphersPherProtocole as $CyphersPherPro)
@if(strlen($CyphersPherPro)>2)
<pre style="font-family: Nunito padding-top: 0.05rem;padding-bottom: 0.05rem;">{{$CyphersPherPro}}</pre>
@endif
@endforeach
</ul>
</div>

<div style="font-family: Nunito">Thanks,</div>
<div style="font-family: Nunito">{{ config('app.name') }}</div>
@endcomponent
