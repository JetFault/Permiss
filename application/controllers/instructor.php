<?php
class Instructor_Controller extends Base_Controller {
  /**
   * HELPERS
   */
  private function is_self_sect($sect_id) {
    $user = Session::get('user');
    $sect = Sect::where('id', '=', $sect_id)->where('instructor_id', '=', $user->id)->first();

    if(is_null($sect)) {
      return false;
    }
    return true;
  }
  /* End Helpers */


  public function get_index() {
    $instructor = Session::get('user');

    $sects = Sect::where('instructor_id', '=', $instructor->id)->get();

    //var_dump($instructor);die;

    return View::make('instructor.index')->with('sects', $sects);
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
      $course->prereqs = $input['prereq'];
      $course->save();
    }

    $sects = $course->sects;

    $exists = array();
    $to_add = array();

    foreach($sections_in as $sect_in) {
      if(in_array($sect_in, $sects)) {
        array_push($exists, $sect_in);
      } else {
        array_push($to_add, $sect_in);
      }
    }

    if(count($exists) > 0) {
      return Redirect::to_action('instructor@add_course')->with_input()->with_errors(
        array('Section(s) already exist: ' . implode(",", $exists)));
    }

    $failed_to_save = array();
    $instructor = Session::get('user');

    foreach($to_add as $sect_num) {
      //$num_stud = $input['num_students'.$to_add];
      //$capacity = $input['capacity'.$to_add];
      $course_index = $sect_num;

      $course_id = $course->id;

      $section = new Sect();
      //$section->num_students = $num_stud;
      //$section->capacity = $capacity;
      $section->course_index = $course_index;
      $section->course_id = $course_id;
      $section->instructor_id = $instructor->id;

      $section = $instructor->sects()->insert($section);

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

  function get_view_course($course_id) {
    $instructor = Session::get('user');

    /*
    $sects = Sect::where('course_id', '=', $course_id)
    ->where('instructor_id', '=', $instructor->id)->get();
     */

    //$sects = Course::find($course_id)->sects;

    $reqs = DB::table('sects')->join('reqs', 'reqs.sect_id', '=', 'sects.id')
      ->where('instructor_id', '=', $instructor->id)->get();

    $course = Course::find($course_id);

    return View::make('instructor.view_course')->with('reqs', $reqs)->with('course', $course);
  }

  function get_view_request($request_id) {
    $req = Req::with(array('student', 'sect', 'sect.course'))->find($request_id);

    if(!$this->is_self_sect($req->sect->id)) {
      return Response::error('404');
    }

    return View::make('instructor.view_request')->with('req', $req);
  }

  function post_send_review() {
    $input = Input::all();

    $request_id = $input['request_id'];
    $req = Req::with(array('student', 'sect', 'sect.course'))->find($request_id);

    if(!$this->is_self_sect($req->sect->id)) {
      return Response::error('404');
    }

    $status = $input['status'];
    if($status === 'deny') {
      $req->status = 'accepted';
    } else if($status === 'accept') {
      $req->status = 'accepted';
    }

    $req->save();

    $email = new Email();
    $email->to = $req->student->user->email;
    $email->from = $req->sect->instructor->user->email;
    $email->subject = $req->status;
    $email->body = $input['comment'];
    $email->save();

    return View::make('instructor.view_request')->with('req', $req);
  }

  function get_accept_request($request_id) {
    $req = Req::with(array('student', 'sect', 'sect.course'))->find($request_id);

    if(!$this->is_self_sect($req->sect->id)) {
      return Response::error('404');
    }

    $req->status = 'accepted';
    $req->save();

    return View::make('instructor.view_request')->with('req', $req);
  }

  function get_deny_request($request_id) {
    $req = Req::with(array('student', 'sect', 'sect.course'))->find($request_id);

    if(!$this->is_self_sect($req->sect->id)) {
      return Response::error('404');
    }

    $req->status = 'denied';
    $req->save();

    return View::make('instructor.view_request')->with('req', $req);
  }

  function get_view_section($sect_id) {
    if(!$this->is_self_sect($sect_id)) {
      return Response::error('404');
    }

    $sect = Sect::with(array('course'))->find($sect_id);

    $reqs = $sect->reqs;

    return View::make('instructor.view_section')->with('sect', $sect)->with('reqs', $reqs);
  }

  function get_view_student($student_id) {
    $instructor = Session::get('user');

    $student = Student::find($student_id);
    if(is_null($student)) {
      return Response::error('404');
    }

    // LEFT OUTER JOIN, stud->req, instr->sect, on sect.id = req.sect_id

    $derp = DB::table('reqs')->where('student_id', '=', $student->id)
      ->left_join('sects', function($join) {
        $join->on('reqs.sect_id', '=', 'sects.id');
      })->where('instructor_id', '=', $instructor->id)
      ->get();

    print_r($derp);

   

    //$reqs = $student->reqs()->with(array('sect', 'sect.course'))->where('
      //->where('instructor_id', '=', $instructor->id)->get();

    return View::make('instructor.view_student')->with('student', $student)->with('reqs', $derp);
  }

}
