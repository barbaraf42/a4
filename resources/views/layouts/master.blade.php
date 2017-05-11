<!DOCTYPE html>
<html>
<head>
	<title>
        @yield('title', 'My Favorite Places')
    </title>

	<meta charset='utf-8'>
    <link rel="stylesheet" href="css/places.css" />

    @stack('head')

</head>
<body>

	<h1>My Favorite Places</h1>

	<section>
		@yield('content')
	</section>

	<footer>
		&copy; {{ date('Y') }}
	</footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    @stack('body')

</body>
</html>
