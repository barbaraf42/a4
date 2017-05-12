<!DOCTYPE html>
<html>
<head>
	<title>
        @yield('title', 'Your Favorite Places')
    </title>

	<meta charset='utf-8'>
    <link rel="stylesheet" href="/css/places.css" />

    @stack('head')

</head>
<body>

    <div class="content">

        <h1>Your Favorite Places</h1>

    	<section>
    		@yield('content')
    	</section>

	</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    @stack('body')

</body>
</html>
