<!DOCTYPE html>
<html>
<head>
	<title>Kelionių Agentūra</title>
	<link rel="stylesheet" type="text/css" href="<?php echo asset('/css/style.css')?>" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:500" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<header>

<span><a href="http://localhost:8000/">
    <div class="headerImg">
    </div></a></span>
</header>
@include('layouts.navbar')
<div class="content">

@yield('content')
</div>

<footer>
	<p>2017 &copy; Yoga Cats</p>
</footer>
</body>
</html>