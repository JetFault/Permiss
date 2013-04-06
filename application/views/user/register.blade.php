<!DOCTYPE html>
<!--[if IE 8]>      <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
<title>Course Permission Thing</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/kyle.css" />
    <script src="js/vendor/custom.modernizr.js"></script>
    <script src="js/jquery.min.js"></script>
</head>
<body>
   
    <div class="row">
        @if (Session::has('error'))
            <div class="alert alert-box">
                <a href="" class="close">&times;</a>
            </div>
        @endif

        <form method="POST" action="/register">
            <fieldset>
                <legend>Register</legend>

                <div class="row">
                    <div class="small-4 large-4 columns">
                    @if (Session::has('errors') && Session::get('errors')->has('ruid'))
                        <div class="alert alert-box">
                          {{ Session::get('errors')->first('ruid') }}
                          <a href="" class="close">&times;</a>
                        </div>
                    @endif
                        <label for="ruid">RUID:</label>
                        <input type="text" id="ruid" name="ruid">
                    </div>
                    <div class="small-4 large-4 columns">
                    @if (Session::has('errors') && Session::get('errors')->has('netid'))
                        <div class="alert alert-box">
                          {{ Session::get('errors')->first('netid') }}
                          <a href="" class="close">&times;</a>
                        </div>
                    @endif
                        <label for="netid">NetID:</label>
                        <input type="text" id="netid" name="netid">
                    </div>
                    <div class="small-4 large-4 columns">
                    @if (Session::has('errors') && Session::get('errors')->has('name'))
                        <div class="alert alert-box">
                          {{ Session::get('errors')->first('name') }}
                          <a href="" class="close">&times;</a>
                        </div>
                    @endif
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name">
                    </div>
                </div>
                <div class="row">
                    <div class="small-6 large-6 columns">
                    @if (Session::has('errors') && Session::get('errors')->has('email'))
                        <div class="alert alert-box">
                          {{ Session::get('errors')->first('email') }}
                          <a href="" class="close">&times;</a>
                        </div>
                    @endif
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email">
                    </div>
                    <div class="small-6 large-6 columns">
                    @if (Session::has('errors') && Session::get('errors')->has('email_confirmation'))
                        <div class="alert alert-box">
                          {{ Session::get('errors')->first('email_confirmation') }}
                          <a href="" class="close">&times;</a>
                        </div>
                    @endif
                        <label for="vemail">Verify Email:</label>
                        <input type="text" id="email_confirmation" name="email_confirmation">
                    </div>
                </div>
                <div class="row">
                    <div class="small-6 large-6 columns">
                    @if (Session::has('errors') && Session::get('errors')->has('password'))
                        <div class="alert alert-box">
                          {{ Session::get('errors')->first('password') }}
                          <a href="" class="close">&times;</a>
                        </div>
                    @endif
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="small-6 large-6 columns">
                    @if (Session::has('errors') && Session::get('errors')->has('password_confirmation'))
                        <div class="alert alert-box">
                          {{ Session::get('errors')->first('password_confirmation') }}
                          <a href="" class="close">&times;</a>
                        </div>
                    @endif
                        <label for="vpassword">Verify Password:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
                <div class="row">
                    <div class="small-4 large-4 columns pad-bot">
                        <label for="affiliationDropdown">Affiliation:</label>
                        <select id="affiliationDropdown" name="affiliation">
                            <option>Student</option>
                            <option>Faculty</option>
                        </select>
                    </div>
                </div>
                <div id="affiliation">
                </div>
                <div class="row">
                    <div class="small-4 large-4 columns">
                        <input type="submit" value="Register" class="register-button radius button">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
 
    <script src="js/foundation.min.js"></script>
    <script type="htmltemplate" id="student-display">
        <div class="row">
            <div class="small-2 large-2 columns">
                <label for="termDropdown">Grad Semester:</label>
                <select id="termDropdown" name="gradsemester">
                    <option>Fall</option>
                    <option>Spring</option>
                    <option>Summer</option>
                    <option>Winter</option>
                </select>
            </div>
            <div class="small-2 large-2 left columns">
                <label for="gradyear">Grad Year:</label>
                <input type="text" id="gradyear" name="gradyear">
            </div>
        </div>
        <div id="major-div">
            <div class="row">
                <div class="small-4 large-4 columns">
                    <label>Major:</label>
                    <input type="text" name="major[]">
                </div>
                <div class="small-4 large-4 columns left plus-button">
                    <input type="button" id="major-add-row" value="Add" class="tiny round button">
                </div>
            </div>
        </div>
    </script>
    <script type="htmltemplate" id="major-div-sub-row">
        <div class="row">
            <div class="small-4 large-4 columns">
                <input type="text" name="major[]">
            </div>
            <div class="small-4 large-4 columns left plus-button2">
                <input type="button" value="Sub" class="tiny round button alert major-sub-row">
            </div>
        </div>
    </script>
    <script src="js/register.js"></script>
</body>
</html>
