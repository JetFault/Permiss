<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Permiss</title>
	<meta name="viewport" content="width=device-width">
	{{ HTML::style('laravel/css/style.css') }}
</head>
<body>
	<div class="wrapper">
		<header>
			<h1>Permiss</h1>
			<h2>Special Permission Number Handler</h2>


      @if ( Auth::user())
      <p class="intro-text" style="margin-top: 45px;">Welcome {{ Auth::user()->name }}</p>
      @endif
      <div class="logout">
        <a href="/logout">Logout</a>
      </div>
    </header>
	</div>
</body>
</html>
