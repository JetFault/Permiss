<?php
class Student_Controller extends Base_Controller {

  public function get_index() {
    return View::make('student.index');
  }

  public function get_request() {
    return View::make('student.request_course');
  }

  public function post_request() {
    $input = Input::all();

    $rules = array(
      'school' => 'required|exists:courses,school_num',
      'dept' => 'required|exists:courses,dept_num',
      'course' => 'required|exists:courses,course_num',
      'section' => 'exists_array:sects, course_index'
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

    $course = Course::where('school_num', '=', $input->school)->
      where('dept_num', '=', $input->dept)->
      where('course_num', '=', $input->course)->first();

    $sects = $course->sects();
    var_dump($sects);die;

    foreach($sects as $sect) {
      $req = new Req();
    }


    if (is_null($user) || is_null($role_user)) {
      return Redirect::to_action('student@request')->with_input->with_errors(
        array('Failed to save user'));
    }

    return Redirect::to_route('student@index');
  }

}
