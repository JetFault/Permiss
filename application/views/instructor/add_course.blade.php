<!DOCTYPE html>
<!--[if IE 8]>      <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
<title>Course Permission Thing</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="/css/normalize.css" />
    <link rel="stylesheet" href="/css/foundation.css" />
    <link rel="stylesheet" href="/css/kyle.css" />
    <script src="/js/vendor/custom.modernizr.js"></script>
    <script src="/js/jquery.min.js"></script>
</head>
<body>
   
    <div class="row">
        <form method="POST" action="/instructor/add_course">
            <fieldset>
                <legend>Instructor Add Course</legend>
                <div class="row">
                    <div class="small-3 large-3 columns">
                        <label for="name">Course Name:</label>
                        <input type="text" id="name" name="name">
                    </div>
                    <div class="small-3 large-3 columns">
                        <label for="school">School#:</label>
                        <input type="text" id="school" name="school">
                    </div>
                    <div class="small-3 large-3 columns">
                        <label for="dept">Department#:</label>
                        <input type="text" id="dept" name="dept">
                    </div>
                    <div class="small-3 large-3 columns">
                        <label for="course">Course#:</label>
                        <input type="text" id="course" name="course">
                    </div>
                </div>
                <div id="sections">
                </div>
                <div class="row">
                    <div class="small-12 large-12 columns">
                        <label for="prereq">Prerequisites:</label>
                        <input type="text" id="prereq" name="prereq">
                    </div>
                </div>
                <div class="row">
                    <div class="small-4 large-4 columns">
                        <input type="submit" value="Add Class" class="register-button radius button">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
 
    <script type="htmltemplate" id="section-display">
        <div id="section-div">
            <div class="row">
                <div class="small-4 large-4 columns">
                    <label>Section:</label>
                    <input type="text" name="section[]">
                </div>
                <div class="small-4 large-4 columns left plus-button">
                    <input type="button" id="section-add-row" value="Add" class="tiny round button">
                </div>
            </div>
        </div>
    </script>
    <script type="htmltemplate" id="section-div-sub-row">
        <div class="row">
            <div class="small-4 large-4 columns">
                <input type="text" name="section[]">
            </div>
            <div class="small-4 large-4 columns left plus-button2">
                <input type="button" value="Sub" class="tiny round button alert section-sub-row">
            </div>
        </div>
    </script>
    <script src="/js/foundation.min.js"></script>
    <script src="/js/add_course.js"></script>
</body>
</html>
