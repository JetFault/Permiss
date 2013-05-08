@layout('layout.header')

@section('content')
  <? $messages = array(); ?>
  @if (Session::has('errors'))
    <? $messages = Session::get('errors')->all('<span style="margin-right: 15px; background-color:red;">:message</span>'); ?>
  @endif
  @if (Session::has('error'))
    <? $messages = array_merge($messages, Session::get('error')); ?>
  @endif

  @if (count($messages) > 0) 
    <div class="errors">
    @foreach($messages as $message)
      {{ $message }}
    @endforeach
    </div>
  @endif

    <div class="row">
        <form method="POST" action="/student/request">
            <fieldset>
                <legend>Request Course</legend>
                <div class="row">
                    <div class="small-4 large-4 columns">
                        <label for="school">School#:</label>
                        <input type="text" id="school" name="school">
                    </div>
                    <div class="small-4 large-4 columns">
                        <label for="dept">Department#:</label>
                        <input type="text" id="dept" name="dept">
                    </div>
                    <div class="small-4 large-4 columns">
                        <label for="course">Course#:</label>
                        <input type="text" id="course" name="course">
                    </div>
                </div>
                <div id="sections">
                </div>
                <div class="row">
                    <div class="small-6 large-6 columns required-checkbox">
                        <label for="required"><input type="checkbox" id="required" name="required" value="yes"><span class="custom checkbox"></span> Required to Graduate</label>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 large-12 columns">
                        <label for="comments">Reasons/Comments:</label>
                        <textarea id="comments" name="comments" class="comment-box"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="small-4 large-4 columns">
                        <input type="submit" value="Request Course" class="register-button radius button">
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
                    <div class="small-4 large-4 columns">
                        <label for="priority">Priority(1-10):</label>
                        <input type="text" id="priority" name="priority[]">
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
                    <div class="small-4 large-4 columns">
                        <label for="priority">Priority(1-10):</label>
                        <input type="text" id="priority" name="priority[]">
                    </div>
            <div class="small-4 large-4 columns left plus-button2">
                <input type="button" value="Sub" class="tiny round button alert section-sub-row">
            </div>
        </div>
    </script>
    <script src="/js/foundation.min.js"></script>
<script src="/js/request_course.js"></script>

@endsection
