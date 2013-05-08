<?php
class Student_Controller extends Base_Controller {

  public function get_index() {
    $student = Session::get('user');

    $reqs = Req::with(array('sect', 'sect.course'))->where('student_id', '=', $student->id)->get();
    //$reqs = $student->reqs;

    return View::make('student.index')->with('reqs', $reqs);
  }

  public function get_request() {
    return View::make('student.request_course');
  }

  public function post_request() {
    $input = Input::all();

    $student = Session::get('user');

    $rules = array(
      'school' => 'required|exists:courses,school_num',
      'dept' => 'required|exists:courses,dept_num',
      'course' => 'required|exists:courses,course_num',
      'section' => 'exists_array:sects,course_index'
    );

    $validation = Validator::make($input, $rules);

    if($validation->fails()) {
      return Redirect::to_action('student@request')->with_input()->with_errors($validation);
    }

    $sections_in = Input::get('section');

    if(count($sections_in) == 0) {
      return Redirect::to_action('student@request')->with_input()->with_errors(
        array('At least one section is required'));
    }

    $course = Course::where('school_num', '=', $input['school'])
      ->where('dept_num', '=', $input['dept'])
      ->where('course_num', '=', $input['course'])->first();

    $sects = $course->sects()->where_in('course_index', $sections_in)->get();

    foreach($sects as $sect) {
      /*
      if($student->reqs()->join(, 'reqs.sect_id', '=', 'sects.id')->where_in('course_index', $sect->course_index)->first()) {
        
    } else {*/
        $req = new Req();
        $req->comment = $input['comments'];
        $req->sect_id = $sect->id;
        if(array_key_exists('required', $input)) {
          $req->required = true;
        }
        $req->student_id = $student->id;

        try {
          $req = $student->reqs()->insert($req);
        } catch(Exception $e) {
          return Redirect::to_action('student@request')->with_input()->with('error',
            array('Failed to save user, request already exists'));
        }

        if(is_null($req)) {
          return Redirect::to_action('student@request')->with_input()->with('error',
            array('Failed to save user'));
        }
      //}
    }

    return Redirect::to_action('student@index');
  }

}
