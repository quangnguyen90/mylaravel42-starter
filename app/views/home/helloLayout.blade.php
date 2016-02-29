@extends('layout.default')
@section('sidebar')
    <p>This is appended to the master sidebar.</p>
@stop
@section('content')
    <p>This is my body content - extend from default layout.</p>
    Hello {{ $qwerty; }}
    @{{ This will not be processed by Blade }}
    <p>
    	@if ($name == 'Name')
		    My name is Name
		@elseif ($name == 'Quang')
		    My name is Quang
		@else
		    I don't have name.
		@endif
    </p>
    <h4>
    	@for ($i = 0; $i < 10; $i++)
		    The current value is {{ $i }} <br>
		@endfor
    </h4>
    
@stop