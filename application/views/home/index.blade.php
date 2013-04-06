<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Laravel: A Framework For Web Artisans</title>
	<meta name="viewport" content="width=device-width">
	{{ HTML::style('laravel/css/style.css') }}
</head>
<body>
	<div class="wrapper">
		<header>
			<h1>Permiss</h1>
			<h2>Special Permission Number Handler</h2>

      <p class="intro-text" style="margin-top: 45px;">Welcome {{ Auth::user()->name }}</p>

      <div class="logout">
        <a href="/logout">Logout</a>
      </div>
    </header>
	</div>
</body>
</html>
