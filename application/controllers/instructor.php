<?php
class Instructor_Controller extends Base_Controller {

  public function get_index() {
    return View::make('instructor.index');
  }

  public function get_add_course() {
    return View::make('instructor.add_course');
  }

  public function post_add_course() {
    $input = Input::all();

    $rules = array(
      'name' => 'required',
      'school' => 'required',
      'dept' => 'required',
      'course' => 'required',
      'section' => 'required'
    );

    $validation = Validator::make($input, $rules);

    if($validation->fails()) {
      return Redirect::to_action('instructor@add_course')->with_input()->with_errors($validation);
    }

    $sections_in = Input::get('section');

    if(count($sections_in) == 0) {
      return Redirect::to_action('instructor@add_course')->with_input()->with_errors(
        array('At least one section is required'));
    }

    $course = Course::where('school_num', '=', $input['school'])->
      where('dept_num', '=', $input['dept'])->
      where('course_num', '=', $input['course'])->first();

    if(is_null($course)) {
      $course = new Course();
      $course->name = $input['name'];
      $course->school_num = $input['school'];
      $course->dept_num = $input['dept'];
      $course->course_num = $input['course'];
      $course->save();
    }

    $sects = $course->sects()->get();
    var_dump($sects);die;

    $exists = array();
    $to_add = array();

    foreach($sects as $sect) {
      $section_num = $sect->course_id;

      if(in_array($section_num, $sections_in)) {
        array_push($exists, $section_num);
      } else {
        array_push($to_add, $section_num);
      }
    }

    if(count($exists) > 0) {
      return Redirect::to_action('instructor@add_course')->with_input()->with_errors(
        array('Section(s) already exist: ' . implode(",", $exists)));
    }

    $failed_to_save = array();

    foreach($to_add as $sect_num) {
      $num_stud = $input['num_students'.$to_add];
      $capacity = $input['capacity'.$to_add];
      $course_index = $sect_num;

      $course_id = $course->id;
      $instructor_id = Session::get('user');

      $section = new Sect();
      $section->num_students = $num_stud;
      $section->capacity = $capacity;
      $section->course_index = $course_index;
      $section->course_id = $course_id;
      $section->instructor_id = $instructor_id;
      $section->save();

      if(is_null($section)) {
        array_push($failed_to_save, $sect_num);
      }
    }

    if(count($failed_to_save) > 0) {
      return Redirect::to_action('instructor@add_course')->with_input()->with_errors(
        array('Section(s) failed to save: ' . implode(",", $failed_to_save)));
    }

    return Redirect::to_action('instructor@index');
  }

}
