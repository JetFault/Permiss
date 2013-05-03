<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
<title>Course Permission Thing</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/kyle.css" />
    <script src="js/vendor/custom.modernizr.js"></script>
</head>
<body>
    <div class="row">
        <div class="small-6 large-6 small-centered large-centered columns">
            <h1>Permiss</h1>
            @if (Session::has('error'))
              <div class="alert alert-box">{{ Session::get('error') }}
                <a href="" class="close">&times;</a>
              </div>
            @endif
            <form method="POST" action="/login" class="login-form custom">
                <label for="username">NetID:</label>
                <input type="text" id="netid" name="netid">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <label for="affiliationDropdown">Affiliation:</label>
                <select id="affiliationDropdown" name="affiliation">
                    <option value="student">Student</option>
                    <option value="faculty">Faculty</option>
                </select>
                <input type="submit" value="Login" class="radius button">
                <div class="register-link"><a href="/register">Register</a></div>
            </form> 
        </div>
    </div>

    <script src="js/foundation.min.js"></script>
</body>
</html>
