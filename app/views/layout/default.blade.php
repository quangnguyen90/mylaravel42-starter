<html>
    <head>
        <title>Layout in Laravel Framework</title>
    </head>
    <body>
    	<div class="sidebar">
			@section('sidebar')
				This is the master sidebar.
			@show
		</div>
        <div class="container">
            @yield('content')
        </div>
        <div class="footer">
            @include('layout.footer')
        </div>
    </body>
</html>