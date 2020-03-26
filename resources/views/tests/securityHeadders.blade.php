
       @if(isset($headers))
        @if(count($headers)>0)
        <div id="test" class="no-gutters border rounded overflow-hidden flex-md-row shadow-sm position-relative  p-2 row">
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
        @endif
       @endif
       <div id="tests">
         <securityheadders></securityheadders>
      </div >
