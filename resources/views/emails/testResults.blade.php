@component('mail::message')
<div style="position: relative; border-radius: 0.25rem 0.25rem 0 0; display: flex; flex-direction: column; min-width: 0; height: null; word-wrap: break-word; background-color:  #fff; background-clip: border-box; border: 1px solid rgba(0, 0, 0, 0.13);" >
<div style="padding: .75rem 1.25rem;  margin-bottom: 0; color: null; background-color: rgba(0, 0, 0, 0.03); border-bottom: 1px solid rgba(0, 0, 0, 0.13);">
<H1>Test of {{$IP}}</H1>
</div>
<div style="flex: 1 1 auto; min-height: 1px; padding: 1.25rem; color: null;">

@if(count($arrayWithHeadders)>0)
<div style="position: relative; border-radius: 0.25rem 0.25rem 0 0; margin-bottom: 10px; display: flex; flex-direction: column; min-width: 0; height: null; word-wrap: break-word; background-color:  #fff; background-clip: border-box; border: 1px solid rgba(0, 0, 0, 0.13);" >
<div style="padding: .75rem 1.25rem; margin-bottom: 0; color: null; background-color: rgba(0, 0, 0, 0.03); border-bottom: 1px solid rgba(0, 0, 0, 0.13);">

<H4>Security headers</H4>
</div>
<div style="flex: 1 1 auto; min-height: 1px; padding: 1.25rem; color: null;">
<h4>Present</h4>
@foreach($arrayWithHeadders as $hello) 
<li style="position: relative; list-style: none; display: block; color: null; background-color: #fff; border: 1px solid rgba(0, 0, 0, 0.13); padding-top: 0.05rem;padding-bottom: 0.05rem;">
<pre style="margin: 0;"><span style="color:#00cd00; font-family: monospace; "> {{$hello}}</span></pre>
</li>
@endforeach
<h4>Missing</h4>
@foreach($arrayNoHeadders as $hello)
<li style="position: relative; list-style: none; display: block; color: null; background-color: #fff; border: 1px solid rgba(0, 0, 0, 0.13); padding-top: 0.05rem;padding-bottom: 0.05rem;">
<pre style="margin: 0;"><span style="color:#cd8000; font-family: monospace;"> {{$hello}}</span></pre>
</li>
@endforeach
</div>
</div>
@endif

@if(count($handShakes)>0)
<div style="position: relative; border-radius: 0.25rem 0.25rem 0 0; margin-bottom: 10px; display: flex; flex-direction: column; min-width: 0; height: null; word-wrap: break-word; background-color:  #fff; background-clip: border-box; border: 1px solid rgba(0, 0, 0, 0.13);" >
<div style="padding: .75rem 1.25rem; margin-bottom: 0; color: null; background-color: rgba(0, 0, 0, 0.03); border-bottom: 1px solid rgba(0, 0, 0, 0.13);">
<H4>Handshake Simulation</H4>
</div>
<div style="flex: 1 1 auto; min-height: 1px; padding: 1.25rem; color: null;">
@foreach($handShakes as $hello)
<li style="position: relative; list-style: none; display: block; color: null; background-color: #fff; border: 1px solid rgba(0, 0, 0, 0.13); padding-top: 0.05rem;padding-bottom: 0.05rem;">
<pre style="margin: 0; font-family: monospace ;">{!! $hello !!}</pre>
</li>
@endforeach
</div>
</div>
@endif

@if(count($SecurityVulnerabilities)>0)
<div style="position: relative; border-radius: 0.25rem 0.25rem 0 0; margin-bottom: 10px; display: flex; flex-direction: column; min-width: 0; height: null; word-wrap: break-word; background-color:  #fff; background-clip: border-box; border: 1px solid rgba(0, 0, 0, 0.13);" >
<div style="padding: .75rem 1.25rem; margin-bottom: 0; color: null; background-color: rgba(0, 0, 0, 0.03); border-bottom: 1px solid rgba(0, 0, 0, 0.13);">
<H4>Security breaches</H4>
</div>
<div style="flex: 1 1 auto; min-height: 1px; padding: 1.25rem; color: null;">
@foreach($SecurityVulnerabilities as $hello)
<li style="position: relative; list-style: none; display: block; color: null; background-color: #fff; border: 1px solid rgba(0, 0, 0, 0.13); padding-top: 0.05rem;padding-bottom: 0.05rem;">
<pre style="margin: 0; font-family: monospace ;">{!! $hello !!}</pre>
</li>
@endforeach
</div>
</div>
@endif

@if(count($ConnectionProtocols)>0)
<div style="position: relative; border-radius: 0.25rem 0.25rem 0 0; margin-bottom: 10px; display: flex; flex-direction: column; min-width: 0; height: null; word-wrap: break-word; background-color:  #fff; background-clip: border-box; border: 1px solid rgba(0, 0, 0, 0.13);" >
<div style="padding: .75rem 1.25rem; margin-bottom: 0; color: null; background-color: rgba(0, 0, 0, 0.03); border-bottom: 1px solid rgba(0, 0, 0, 0.13);">
<H4>Offered protocols</H4>
</div>
<div style="flex: 1 1 auto; min-height: 1px; padding: 1.25rem; color: null;">
@foreach($ConnectionProtocols as $hello)
<li style="position: relative; list-style: none; display: block; color: null; background-color: #fff; border: 1px solid rgba(0, 0, 0, 0.13); padding-top: 0.05rem;padding-bottom: 0.05rem;">
<pre style="margin: 0; font-family: monospace ;">{!! $hello !!}</pre>
</li>
@endforeach
</div>
</div>
@endif
@if(count($ServerHello)>0)
<div style="position: relative; border-radius: 0.25rem 0.25rem 0 0; margin-bottom: 10px; display: flex; flex-direction: column; min-width: 0; height: null; word-wrap: break-word; background-color:  #fff; background-clip: border-box; border: 1px solid rgba(0, 0, 0, 0.13);" >
<div style="padding: .75rem 1.25rem; margin-bottom: 0; color: null; background-color: rgba(0, 0, 0, 0.03); border-bottom: 1px solid rgba(0, 0, 0, 0.13);">
<H4>Server Hello</H4>
</div>
<div style="flex: 1 1 auto; min-height: 1px; padding: 1.25rem; color: null;">
@foreach($ServerHello as $hello)
<li style="position: relative; list-style: none; display: block; color: null; background-color: #fff; border: 1px solid rgba(0, 0, 0, 0.13); padding-top: 0.05rem;padding-bottom: 0.05rem;">
<pre style="margin: 0; font-family: monospace ;">{!! $hello !!}</pre>
</li>
@endforeach
</div>
</div>
@endif
@if(count($CyphersPherProtocole)>0)
<div style="position: relative; border-radius: 0.25rem 0.25rem 0 0; margin-bottom: 10px; display: flex; flex-direction: column; min-width: 0; height: null; word-wrap: break-word; background-color:  #fff; background-clip: border-box; border: 1px solid rgba(0, 0, 0, 0.13);" >
<div style="padding: .75rem 1.25rem; margin-bottom: 0; color: null; background-color: rgba(0, 0, 0, 0.03); border-bottom: 1px solid rgba(0, 0, 0, 0.13);">
<H4>Ciphers per protocol</H4>
</div>
<div style="flex: 1 1 auto; min-height: 1px; padding: 1.25rem; color: null;">
@foreach($CyphersPherProtocole as $hello)
<li style="position: relative; list-style: none; display: block; color: null; background-color: #fff; border: 1px solid rgba(0, 0, 0, 0.13); padding-top: 0.05rem;padding-bottom: 0.05rem;">
<pre style="margin: 0; font-family: monospace ;"> {!! $hello !!}</pre>
</li>
@endforeach
</div>
</div>
@endif
</div>
<div style="padding: .75rem 1.25rem; background-color: rgba(#000, .03); border-top: 1px solid rgba(#000, .125);">
</div>
</div>
@endcomponent